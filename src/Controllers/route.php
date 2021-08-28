<?php

use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controllers\EventController;

Router::get('/', function (Request $req, Response $res) {
    (new EventController())->indexAction($req);
});

?>