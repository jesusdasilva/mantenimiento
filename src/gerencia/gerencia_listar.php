<?php
/*
 *  CONTROLADOR gerenciaListar
 */
$gerencia->get('/gerencia/listar', function() use ($app) {

  try{

      //BUSCAR GERENCIA
      $gerencias = $app['gerencia']->listar();

      //ENVIAR DATOS A LA PLANTILLA
      return $app['twig']->render('gerencia/gerencia_listado.html.twig',
          array('gerencias'=> $gerencias));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('gerenciaListar');
