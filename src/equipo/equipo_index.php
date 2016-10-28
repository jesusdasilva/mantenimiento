<?php
/*
*CONTROLADOR PRINCIPAL EQUIPO
*/

//CREAR EL OBJETO
$equipo = $app['controllers_factory'];

//VERIFICAR SI EL USUARIO ESTA LOGEADO
$equipo->before(function() use ($app){

  // VERIFICAR SI LA VARIABLE indicador HA SIDO CREADA EN EL OBJETO SESIÓN
  if($app['session']->get('usuarioIndicador') == null){

    //REDIRECCIONAR AL FORMULARIO LOGIN
	  return $app->redirect($app['url_generator']->generate('login'));
  }
});

//CONTROLADORES
require_once __DIR__.'/equipo_nuevo.php';

//RETORNAR EL OBJETO
return $equipo;
