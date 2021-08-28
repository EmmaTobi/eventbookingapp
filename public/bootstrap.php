<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Lib\Config;

$capsule = new Capsule;

$capsule->addConnection([
   "driver" => Config::get('CONNECTION_DRIVER', 'mysql'),
   "host" => Config::get('CONNECTION_HOST', '127.0.0.1'),
   "database" => Config::get('CONNECTION_DATABASE'),
   "username" => Config::get('CONNECTION_USERNAME', 'root'),
   "password" => Config::get('CONNECTION_PASSWORD', '')
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

?>