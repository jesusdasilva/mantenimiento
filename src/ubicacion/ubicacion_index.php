<?php
/*
*CONTROLADOR PRINCIPAL UBICACIÓN
*/

//CREAR EL OBJETO
$ubicacion = $app['controllers_factory'];

//VERIFICAR SI EL USUARIO ESTA LOGEADO
$ubicacion->before(function() use ($app){

  // VERIFICAR SI LA VARIABLE indicador HA SIDO CREADA EN EL OBJETO SESIÓN
  if($app['session']->get('usuarioIndicador') == null){

    //REDIRECCIONAR AL FORMULARIO LOGIN
	  return $app->redirect($app['url_generator']->generate('login'));
  }
});

//CONTROLADORES
require_once __DIR__.'/ubicacion_nuevo.php';
require_once __DIR__.'/ubicacion_listar.php';
require_once __DIR__.'/ubicacion_buscar.php';
require_once __DIR__.'/ubicacion_eliminar.php';
require_once __DIR__.'/ubicacion_guardar_actualizar.php';
require_once __DIR__.'/ubicacion_guardar_nuevo.php';

//RETORNAR EL OBJETO
return $ubicacion;
