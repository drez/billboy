<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the TemplateService entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */

 use App\Domains\Template\Variables;
class TemplateServiceWrapper extends TemplateService{
    public function __construct($request, $response, $args)
    {
        parent::__construct($request, $response, $args);

        $this->Form = new TemplateFormWrapper($request, $args);

        # add a custom action to the current route
        $this->customActions['viewVar'] = 'viewVar';
    }

    public function viewVar(){
        $Variables = new Variables();
        $content = $Variables->print();
        return [
            'html' => div(
                        div(
                            div('Variables', '', "class='panel-heading'")
                            .div(
                                $content['html']
                            )
                        , '', "class='divStdform'")
                    , '', "class='mainForm'"),
            'onReadyJs' => $content['onReadyJs']
        ];
    }

    public function afterGetResponseSwitch(){}
    public function beforeDelete(&$this, &$request, &$error, &$messages){}
    public function beforeSave(&$this, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr, $error){}
    public function afterSave(&$this, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr, $error){}
    public function afterDelete(&$this, &$request, &$error, &$messages){}
    public function beforeFileUpload($file, $path, $this, $data){}
    public function afterFileUpload($data, $this){}

    
}
