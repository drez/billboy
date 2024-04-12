<?php

namespace App\Domains\Dashboard;

use Psr\Http\Message\ServerRequestInterface as Request;
//use ApiGoat\Views\View;

class View
{
  
    public $request;
    public $args;
    private $entities = [];

    /**
     * Constructor
     *
     * @param Request $request
     * @param array $args
     */
    function __construct(Request $request, array $args)
    {
        $this->request = $request;
        $this->args = $args;
        $this->model_name = 'DashboardView';
    }

    public function dashboard()
    {
        $return['html'] = swheader() . div(
          
                div(
                    ""
                ) ,
            '',
            "class='mainForm form' style='padding-bottom:50px;'"
        );

        $return['onReadyJs'] = "
   
        ";
        return $return;
    }
}
