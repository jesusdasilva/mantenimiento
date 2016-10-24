<?php
/*
 *  CONTROLADOR gerenciaBuscar
 */
$gerencia->get('/gerencia/buscar/{id}',function($id) use($app){

  try{

      //BUSCAR POR GERENCIA POR ID
      $registros = $app['gerencia']->buscarId($id);

      //MOSTRAR DATOS
      return $app['twig']->render('gerencia/gerencia_datos.html.twig',
        array('gerencia_id'          => $registros['gerencia_id'],
              'gerencia_nombre'      => $registros['gerencia_nombre'],
              'gerencia_observacion' => $registros['gerencia_observacion'],
              'editar'=>TRUE));

  } catch (Exception $e) {

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        array('message' => $e->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('gerenciaBuscar');
