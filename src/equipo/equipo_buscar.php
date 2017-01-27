<?php

//CONTROLADOR equipos_buscar

$equipo->get('/equipo/buscar/{id}', function ($id) use ($app) {

    if ($app['equipo']->buscar(['equipo_id' => $id,])) {

      //ENVIAR LOS DATOS AL FORMULARIO
      return $app['twig']->render(
          'equipo/equipo_nuevo_registrar_mantenimiento.html.twig', [
              'registrosEquipo' =>  $app['equipo']->getTodas(),
              'ubicaciones'     => ($app['ubicacion']->buscar()) ? $app['ubicacion']->getTodas() :'',
              'empresas'        => ($app['empresa']->buscar())   ? $app['empresa']->getTodas()   :'',
              'gerencias'       => ($app['gerencia']->buscar())  ? $app['gerencia']->getTodas()  :'',
              'checklist'       => ($app['checklist']->buscar(['equipo_id' => $id,])) ? $app['checklist']->getTodas() :'',
          ]
      );

    } else {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $this->getMessage(),
            ]
        );

        //MOSTRAR MENSAJE ERROR
        return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('equipoBuscar');
