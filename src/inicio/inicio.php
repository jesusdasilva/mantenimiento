<?php
/*
 *  CONTROLADOR inicio
 */
$inicio->get('/inicio', function() use ($app) {

  try{

    //LISTAR TODOS LOS EQUIPOS
    $equipos = $app['equipo']->listar();

    //MOSTAR LA PÁGINA DE INICIO
    return $app['twig']->render('inicio/inicio.twig',
        array('equipos' => $equipos));

  //CAPTURAR ERROR
  }catch (Exception $e) {

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        array('message' => $e->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('inicio');
