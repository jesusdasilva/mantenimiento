<?php
/*
 *  CONTROLADOR inicio
 */
$inicio->get('/inicio', function() use ($app) {

  try{

    //MOSTAR LA PÁGINA DE INICIO
    return $app['twig']->render('inicio/inicio.html.twig',
        array('equipos' => $app['equipo']->listar(),
              'totalEquipos'     => $app['equipo']->getCantidad(),
              'totalEmpresas'    => $app['empresa']->cantidad(),
              'totalGerencias'   => $app['gerencia']->cantidad(),
              'totalUbicaciones' => $app['ubicacion']->cantidad()));

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
