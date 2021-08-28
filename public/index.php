<?php

use App\Lib\Config;
use App\Lib\App;

require_once(__DIR__ . '/../init.php');
require_once(Config::get('ROUTE_PATH', __DIR__ . '/../src/Controllers/route.php'));

App::run();

?>