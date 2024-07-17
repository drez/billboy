<?php

namespace App;


/**
 * Service Class
 * Provide Response for the backend controler
 */
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Utility\BuilderLayout;
use ApiGoat\Utility\BuilderMenus;
use ApiGoat\Handlers\BuilderReturn;
use ApiGoat\Handlers\PropelErrorHandler;
use ApiGoat\Api\ApiResponse;
use ApiGoat\Api\Api;


class SupplierService
{

    /**
     * return abstract
     * @var array
     */
    public $content=['html'=>'', 'onReadyJs'=>'', 'js'=>'', 'json' =>''];
    /**
     *
     * @var BuilderLayout object
     */
    public $BuilderLayout;
    /**
     * legacy variable for all arguments
     * @var array
     */
    public $request=[];
    /**
     *
     * @var PSR-7 response object
     * immutable object
     */
    private $response;

    /**
     * Add custom callable actions
     *
     * @var array
     */
    public $customActions;
    public $rawRequest;
    public $Form;
    public $contentType;
    public $headers;

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function __construct($request, $response, $args )
    {
        $this->rawRequest = $request;
        $this->response = $response;
        $this->BuilderLayout = new BuilderLayout(new BuilderMenus($args));
        // legacy
        $this->request = $args;
    }

    /**
     * Get the proper response
     * @return string
     */
    public function getResponse()
    {
        $this->content = "Unknown method";

        switch($this->request['a']){
            case '':
            case 'list':
                $this->content = $this->list();
            break;
            case 'edit':
            case 'view':
                $this->content = $this->edit();
            break;
            case 'update':
            case 'insert':
                $this->content = $this->saveUpdate();
                return $this->BuilderLayout->renderXHR($this->content);
            case 'delete':
                $this->content = $this->deleteOne();
                return $this->BuilderLayout->renderXHR($this->content);




                /**
                *   Child table
                **/
                case 'CostLine':
                    $this->content = $this->Form->getCostLineList($this->request['i'], $this->request);
                break;


            default:
                if (method_exists($this, $this->customActions[$this->request['a']])) {
                    $callable = $this->customActions[$this->request['a']];
                    $this->content = $this->$callable($this->request);
                }
        }

        if (method_exists($this, 'afterGetResponseSwitch')){ $this->afterGetResponseSwitch(); }

        if($this->request['ui']){
            return $this->BuilderLayout->renderXHR($this->content);
        }else{
            return $this->BuilderLayout->render($this->content);
        }
    }
    
    /**
    * Get the proper api response
    * @return array
    */
    public function getApiResponse()
    {
        $this->body = ['status' => 'failure', 'errors' => ['Unknown method'], 'data' => null, 'messages' => null];
        $Api = new Api('Supplier', $this);

        if (method_exists($this, $this->customActions[$this->request['a']])) {
            $callable = $this->customActions[$this->request['a']];
            $this->body = $this->$callable($Api);
        }else{
            switch($this->request['method']){
                case 'AUTH':
                    $dispatch = $this->request['a'];
                    $this->body = $this->$dispatch();
                    break;
                case 'GET':
                    $this->body = $Api->getJson($this->request);
                    break;
                case 'POST':
                case 'PATCH':
                    if ($this->request['a'] == 'list') {
                        $this->body = $Api->getJson($this->request);
                    } else {
                        $this->body = $Api->setJson($this->request);
                    }
                    break;
                case 'PUT':
                    $this->body = $Api->file($this->request);
                    break;
                case 'DELETE':
                    $this->body = $Api->deleteJson($this->request);
                    break;
            }
        }

        
        
        $ApiResponse = new ApiResponse($this->request, $this->response, $this->body);
        return $ApiResponse->getResponse();
    }






    public function deleteOne()
    {
        $error = [];
        $messages = '';

        $obj = SupplierQuery::create()->findPk(json_decode($this->request['i']));


            if($obj->countCostLines()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Expense'. ", '', true,'Supplier'); die( $error['onReadyJs'] );
            }
        if (method_exists($this, 'beforeDelete')){ $this->beforeDelete($obj, $this->request, $error, $messages);}
        $obj->delete();

        if (method_exists($this, 'afterDelete')){ $this->afterDelete($obj, $this->request, $error, $messages);}

        $BuilderReturn = new BuilderReturn($this->request, $error, $messages);
        return $BuilderReturn->return();
    }

    public function saveUpdate()
    {
        $messages = null;
        $error = null;

        $extValidationErr = false;
        parse_str ($this->request['d'], $data );

        $data['i'] = ( $data['IdSupplier'] ) ? $data['IdSupplier'] : $this->request['i'];
        $data['ip'] = urldecode($this->request['data']['ip']);
        $data['pc'] = urldecode($this->request['data']['pc']);
        $this->Supplier['request'] = $this->request;

        if(!empty($data['i'])) {
            ## Save
            if (method_exists($this, 'beforeSave')){ $this->beforeSave($this, $data, false, $messages, $extValidationErr, $error);}
            $e = $this->Form->setUpdateDefaultsSupplier($data);


            if ($e->validate() && !$extValidationErr) {
                $e->save();
                $this->request['i'] = json_encode($e->getPrimaryKey());
                if (method_exists($this, 'afterSave')){ $this->afterSave($e, $data, false, $messages, $extValidationErr, $error);}

            }else{
                $PropelErrorHandler = new PropelErrorHandler($e, $this->request['data']['ui'],_('Form field'), $extValidationErr, $this->virtualClassName);
                $error = $PropelErrorHandler->getValidationErrors();
            }
        } else {
            ## Create
            if (method_exists($this, 'beforeSave')){ $this->beforeSave($this, $data, true, $messages, $extValidationErr, $error);}

            $e = $this->Form->setCreateDefaultsSupplier($data);

            if ($e->validate() && !$extValidationErr) {
                $e->save();
                $this->request['i'] = json_encode($e->getPrimaryKey());
                if (method_exists($this, 'afterSave')){ $this->afterSave($e, $data, true, $messages, $extValidationErr, $error);}


            }else{
                $PropelErrorHandler = new PropelErrorHandler($e, $this->request['data']['ui'],_('Form field'), $extValidationErr, $this->virtualClassName);
                $error = $PropelErrorHandler->getValidationErrors();
            }
        }

        $BuilderReturn = new BuilderReturn($this->request, $error, $messages);
        return $BuilderReturn->return();
    }



    /**
    * Return the main edit form, including child lists
    * @return string
    */
    private function edit()
    {
        $this->Supplier['request'] = $this->request;
        $this->Supplier['parentId'] = $this->request['data']['ip'];


        $relData = $this->request;
        $output = $this->Form->getEditForm($this->request['i'], $this->request['ui'], $relData, '', $this->request['data']['je'], $this->request['data']['jet']);

        return $output;
    }

    /**
    * Retrun the main list
    * @return string
    */
    private function list()
    {
        $output = $this->Form->getList($this->request);

        return $output;
    }



}
