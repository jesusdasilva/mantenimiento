<?php
/*
 *  CONTROLADOR ubicacionEliminar
 */
$ubicacion->get('ubicacion/eliminar/{idUbicacion}', function($idUbicacion) use($app){

  try {

      //ELIMINAR
      $registroEliminado = $app['db']->delete('ubicaciones', array('id_ubicacion' => $idUbicacion));

      //VERIFICAR QUE SE ELIMINÓ
      if( $registroEliminado <= 0 ){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',array('message' => 'No se pudo eliminar la ubicacion'));

      }else{

        //MENSAJE
        $app['session']->getFlashBag()->add('success',array('message' => 'Se eliminó con éxito la ubicacion'));

      }

      //REDIRECCIONAR AL LISTADO
      return $app->redirect($app['url_generator']->generate('ubicacionListar'));

    //CAPTURAR ERROR
    } catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('ubicacionEliminar');
