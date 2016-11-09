<?php
/*
 *  CONTROLADOR empresaEliminar
 */
$empresa->get('empresa/eliminar/{id}', function($id) use($app){

  if($app['empresa']->eliminar($id)){

    //MENSAJE
    $app['session']->getFlashBag()->add('success',
        array('message' => $app['empresa']->getMensaje()));

    //REDIRECCIONAR AL LISTADO
    return $app->redirect($app['url_generator']->generate('empresaListar'));

  }else{

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $app['empresa']->getMensaje()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }
})
->bind('empresaEliminar');
