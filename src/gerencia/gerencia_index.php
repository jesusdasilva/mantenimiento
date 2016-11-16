<?php

//CONTROLADOR PRINCIPAL GERENCIA


//CREAR EL OBJETO
$gerencia = $app['controllers_factory'];

//VERIFICAR SI EL USUARIO ESTA LOGEADO
$gerencia->before( function () use ($app) {

    // VERIFICAR SI LA VARIABLE indicador HA SIDO CREADA EN EL OBJETO SESIÓN
    if ($app['session']->get('usuarioIndicador') == null) {

        //REDIRECCIONAR AL FORMULARIO LOGIN
	      return $app->redirect($app['url_generator']->generate('login'));
    }

});

//CONTROLADORES
require_once __DIR__.'/gerencia_nuevo.php';
require_once __DIR__.'/gerencia_listar.php';
require_once __DIR__.'/gerencia_buscar.php';
require_once __DIR__.'/gerencia_eliminar.php';
require_once __DIR__.'/gerencia_guardar_actualizar.php';
require_once __DIR__.'/gerencia_guardar_nuevo.php';

//RETORNAR EL OBJETO
return $gerencia;
