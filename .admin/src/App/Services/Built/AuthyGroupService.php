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


class AuthyGroupService
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
                $this->content['onReadyJs'] .= "sw_message('Saved');";
                return $this->BuilderLayout->renderXHR($this->content);
            case 'delete':
                $this->content = $this->deleteOne();
                return $this->BuilderLayout->renderXHR($this->content);





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
        $Api = new Api('AuthyGroup', $this);

        if (isset($this->customActions[$this->request['a']]) && method_exists($this, $this->customActions[$this->request['a']])) {
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

        $obj = AuthyGroupQuery::create()->findPk(json_decode($this->request['i']));


            if($obj->countClients()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Client'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countBillings()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Billing'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countBillingLines()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Entries'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countPaymentLines()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Payment entry'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countCostLines()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Expense'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countProjects()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Project'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countTimeLines()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Time'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countBillingCategories()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Category billing'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countCurrencies()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Currency'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countSuppliers()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Supplier'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countAuthiesRelatedByIdGroupCreation()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'User'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countCountries()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Country'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countAuthyGroupsRelatedByIdAuthyGroup()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Group'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countConfigs()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Setting'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countApiRbacs()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'API ACL'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countTemplates()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'Template'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countTemplateFiles()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." 'File'. ", '', true,'Group'); die( $error['onReadyJs'] );
            }
            if($obj->countMessageI18ns()){
                $error = handleNotOkResponse(_("This entry cannot be deleted. It is in use in ")." ''. ", '', true,'Group'); die( $error['onReadyJs'] );
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

        $data['i'] = ( $data['IdAuthyGroup'] ) ? $data['IdAuthyGroup'] : $this->request['i'];
        $data['ip'] = urldecode($this->request['data']['ip']);
        $data['pc'] = urldecode($this->request['data']['pc']);
        $this->AuthyGroup['request'] = $this->request;

        if(!empty($data['i'])) {
            ## Save
            if (method_exists($this, 'beforeSave')){ $this->beforeSave($this, $data, false, $messages, $extValidationErr, $error);}
            $e = $this->Form->setUpdateDefaultsAuthyGroup($data);


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

            $e = $this->Form->setCreateDefaultsAuthyGroup($data);

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
        $this->AuthyGroup['request'] = $this->request;
        $this->AuthyGroup['parentId'] = $this->request['data']['ip'];


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
