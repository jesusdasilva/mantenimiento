<?php

//CONTROLADOR inicio

$inicio->get('/inicio', function() use ($app) {

    if (!$app['equipo']->buscar()) {

      //MENSAJE
      $app['session']->getFlashBag()->add(
          'danger', [
              'message' => $app['equipo']->getMensaje(),
          ]
      );

    }

    //MOSTAR LA PÁGINA DE INICIO
    return $app['twig']->render(
        'inicio/inicio.html.twig', [
            'equipos' => $app['equipo']->getTodas(),
            'totalEquipos'     => $app['equipo']->cantidad(),
            'totalEmpresas'    => $app['empresa']->cantidad(),
            'totalGerencias'   => $app['gerencia']->cantidad(),
            'totalUbicaciones' => $app['ubicacion']->cantidad(),
          ]
    );

})
->bind('inicio');
