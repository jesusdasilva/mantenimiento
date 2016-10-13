<?php
/*
 *  INICIO_INDEX
 */

 //CREAR EL OBJETO
 $inicio = $app['controllers_factory'];

 //VERIFICAR SI EL USUARIO ESTA LOGEADO
 $inicio->before(function() use ($app){

   // VERIFICAR SI LA VARIABLE usuarioIndicador HA SIDO CREADA EN EL OBJETO SESIÓN
   if($app['session']->get('usuarioIndicador') == null){

     //REDIRECCIONAR AL FORMULARIO LOGIN
 	  return $app->redirect($app['url_generator']->generate('login'));
   }
 });

 //CARGAR EL CONTROLADOR
 require_once __DIR__.'/inicio.php';

 //RETORNAR EL OBJETO
 return $inicio;
