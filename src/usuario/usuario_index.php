<?php
/*
*CONTROLADOR PRINCIPAL USUARIO
*/

//CREAR EL OBJETO
$usuario = $app['controllers_factory'];

//VERIFICAR SI EL USUARIO ESTA LOGEADO
$usuario->before(function() use ($app){

  // VERIFICAR SI LA VARIABLE indicador HA SIDO CREADA EN EL OBJETO SESIÓN
  if($app['session']->get('usuarioIndicador') == null){

    //REDIRECCIONAR AL FORMULARIO LOGIN
	  return $app->redirect($app['url_generator']->generate('login'));
  }
});

//CONTROLADORES
require_once __DIR__.'/usuario_nuevo.php';
require_once __DIR__.'/usuario_listar.php';
require_once __DIR__.'/usuario_buscar.php';
require_once __DIR__.'/usuario_eliminar.php';
require_once __DIR__.'/usuario_guardar_actualizar.php';
require_once __DIR__.'/usuario_guardar_nuevo.php';

//RETORNAR EL OBJETO
return $usuario;
