<?php
/*
*CONTROLADOR PRINCIPAL MANTENIMIENTO
*/

//CREAR EL OBJETO
$mantenimiento = $app['controllers_factory'];

//VERIFICAR SI EL USUARIO ESTA LOGEADO
$mantenimiento->before(function() use ($app){

  // VERIFICAR SI LA VARIABLE indicador HA SIDO CREADA EN EL OBJETO SESIÓN
  if($app['session']->get('usuarioIndicador') == null){

    //REDIRECCIONAR AL FORMULARIO LOGIN
	  return $app->redirect($app['url_generator']->generate('login'));
  }
});

//CONTROLADORES
require_once __DIR__.'/mantenimiento_mostrar.php';

//RETORNAR EL OBJETO
return $mantenimiento;
