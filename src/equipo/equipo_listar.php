<?php

//CONTROLADOR equipoListar

$equipo->get('/equipo/listar', function() use ($app) {

      //BUSCAR TODAS LOS EQUIPOS
      if (!$app['equipo']->buscar()) {

          //MENSAJE
          $app['session']->getFlashBag()->add(
              'danger', [
                  'message' => $app['equipo']->getMensaje(),
              ]
          );

      }

      //ENVIAR DATOS A LA PLANTILLA
      return $app['twig']->render(
          'equipo/equipo_listado.html.twig', [
              'equipos'=> $app['equipo']->getTodas(),
          ]
      );

})
->bind('equipoListar');
