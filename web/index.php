<?php

//USAR SOLO FIREFOX
if(!preg_match('/Firefox/i',$_SERVER['HTTP_USER_AGENT'])){
  //header('HTTP/1.0 403 Forbidden');
  exit('Esta aplicación solo funciona con Mozilla Firefox.');
}

ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';

$app->run();
