<?php
/*
 *  CONTROLADOR empresaEliminar
 */
$empresa->get('empresa/eliminar/{id}', function($id) use($app){

  try {

      //ELIMINAR
      $registroEliminado = $app['empresa']->eliminar($id);

      //VERIFICAR QUE SE ELIMINÓ
      if( $registroEliminado <= 0 ){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'No se pudo eliminar la Empresa'));

      }else{

        //MENSAJE
        $app['session']->getFlashBag()->add('success',
            array('message' => 'Se eliminó con éxito la Empresa'));

      }

      //REDIRECCIONAR AL LISTADO
      return $app->redirect($app['url_generator']->generate('empresaListar'));

    //CAPTURAR ERROR
    } catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('empresaEliminar');
