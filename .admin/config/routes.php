<?php

namespace App;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Routes\RouteHelper;


/**
 * Routes definitions
 */


return function (App $app) {
    include 'Built/routes.php';

    /* declare new routes here */
    /*$app->post(_SUB_DIR_URL . 'RefreshStats', function (Request $request, Response $response, $args) {
        $RouteHelper = new RouteHelper($request, $args);
        $Service = new \App\StatsService($request, $response, $RouteHelper->getArgs());
        return $Service->getResponse();
    })->setName('RefreshStats');*/

};
