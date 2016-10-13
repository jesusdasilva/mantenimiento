<?php
/*
 *  CONTROLADOR ubicacionBuscar
 */
$ubicacion->get('/ubicacion/buscar/{idUbicacion}',function($idUbicacion) use($app){

  try{

      //SQL
      $sql = 'SELECT * FROM ubicaciones WHERE id_ubicacion = ? ';

      //BUSCAR ID
      $registros = $app['db']->fetchAssoc($sql, array($idUbicacion));

      //MOSTRAR DATOS
      return $app['twig']->render('ubicacion/ubicacion_datos.html.twig',
        array('idUbicacion'          => $registros['id_ubicacion'],
              'nombreUbicacion'      => $registros['nombre_ubicacion'],
              'observacionUbicacion' => $registros['observacion_ubicacion'],
              'editar'=>TRUE));

  } catch (Exception $e) {

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',array('message' => $e->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('ubicacionBuscar');
