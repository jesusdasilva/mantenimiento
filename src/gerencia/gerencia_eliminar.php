<?php
/*
 *  CONTROLADOR gerenciaEliminar
 */
$empresa->get('gerencia/eliminar/{gerenciaId}', function($gerenciaId) use($app){

  try {

      //ELIMINAR
      $registroEliminado = $app['db']->delete('mantenimientos_gerencias',
          array('gerencia_id' => $gerenciaId));

      //VERIFICAR QUE SE ELIMINÓ
      if( $registroEliminado <= 0 ){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'No se pudo eliminar la Gerencia'));

      }else{

        //MENSAJE
        $app['session']->getFlashBag()->add('success',
            array('message' => 'Se eliminó con éxito la Gerencia'));

      }

      //REDIRECCIONAR AL LISTADO
      return $app->redirect($app['url_generator']->generate('gerenciaListar'));

    //CAPTURAR ERROR
    } catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('gerenciaEliminar');
