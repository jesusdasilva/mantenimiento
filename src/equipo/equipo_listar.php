<?php
/*
 *CONTROLADOR equipoListar
 */
$equipo->get('/equipo/listar', function() use ($app) {

  try{

      //BUSCAR TODAS LOS EQUIPOS
      $equipos = $app['equipo']->listar();

      //ENVIAR DATOS A LA PLANTILLA
      return $app['twig']->render('equipo/equipo_listado.html.twig',
          array('equipos'=> $equipos));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }
})
->bind('equipoListar');
