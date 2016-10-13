<?php
/*
 *  CONTROLADOR usuarioEliminar
 */
$usuario->get('usuario/eliminar/{usuarioId}', function($usuarioId) use($app){

  try {

      //ELIMINAR
      $registroEliminado = $app['usuario']->eliminar($usuarioId);

      //VERIFICAR QUE SE ELIMINÓ
      if( $registroEliminado <= 0 ){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'No se pudo eliminar el Usuario'));

      }else{

        //MENSAJE
        $app['session']->getFlashBag()->add('success',
            array('message' => 'Se eliminó con éxito el Usuario'));

      }

      //REDIRECCIONAR AL LISTADO
      return $app->redirect($app['url_generator']->generate('usuarioListar'));

    //CAPTURAR ERROR
    } catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('usuarioEliminar');
