<?php
/*
 *  LOGIN INDEX
 */
//CREAR OBJETO login
$login = $app['controllers_factory'];

//CARGAR CONTROLADORES
require_once __DIR__.'/login.php';
require_once __DIR__.'/login_verificar.php';

//RETORNAR OBJETO
return $login;
