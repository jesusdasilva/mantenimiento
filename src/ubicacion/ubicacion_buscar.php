<?php
/*
 *  CONTROLADOR ubicacionBuscar
 */
$ubicacion->get('/ubicacion/buscar/{id}',function($id) use($app){

  try{

      $registros = $app['ubicacion']->buscarId($id);

      //MOSTRAR DATOS
      return $app['twig']->render('ubicacion/ubicacion_datos.html.twig',
          array('ubicacion_id'          => $registros['ubicacion_id'],
                'ubicacion_nombre'      => $registros['ubicacion_nombre'],
                'ubicacion_observacion' => $registros['ubicacion_observacion'],
                'editar'=>TRUE));

  } catch (Exception $e) {

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',array('message' => $e->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('ubicacionBuscar');
