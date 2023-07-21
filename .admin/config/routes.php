<?php

/**
 * Routes definitions
 */

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Handlers\Strategies\RequestHandler;
use GuzzleHttp\Psr7\LazyOpenStream;
use ApiGoat\Utility\BuilderLayout;
use ApiGoat\Utility\BuilderMenus;
use ApiGoat\Routes\RouteHelper;
use App\Services\BuilderService;

return function (App $app) {
    include 'Built/routes.php';

    /* declare new routes here */
};
