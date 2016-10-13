<?php
/*
*CONTROLADOR PRINCIPAL EMPRESA
*/

//CREAR EL OBJETO
$empresa = $app['controllers_factory'];

//VERIFICAR SI EL USUARIO ESTA LOGEADO
$empresa->before(function() use ($app){

  // VERIFICAR SI LA VARIABLE indicador HA SIDO CREADA EN EL OBJETO SESIÓN
  if($app['session']->get('usuarioIndicador') == null){

    //REDIRECCIONAR AL FORMULARIO LOGIN
	  return $app->redirect($app['url_generator']->generate('login'));
  }
});

//CONTROLADORES
require_once __DIR__.'/empresa_nuevo.php';
require_once __DIR__.'/empresa_listar.php';
require_once __DIR__.'/empresa_buscar.php';
require_once __DIR__.'/empresa_eliminar.php';
require_once __DIR__.'/empresa_guardar_actualizar.php';
require_once __DIR__.'/empresa_guardar_nuevo.php';

//RETORNAR EL OBJETO
return $empresa;
