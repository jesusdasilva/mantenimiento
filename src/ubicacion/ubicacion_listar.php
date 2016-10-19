<?php
/*
 *  CONTROLADOR ubicacionListar
 */
$ubicacion->get('/ubicacion/listar', function() use ($app) {

  try{

      //BUSCAR ubicacion
      $ubicaciones = $app['ubicacion']->listar();

      //ENVIAR DATOS A LA PLANTILLA
      return $app['twig']->render('ubicacion/ubicacion_listado.html.twig',
          array('ubicaciones'=> $ubicaciones));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('ubicacionListar');
