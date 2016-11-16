<?php

//CONTROLADOR ubicacionBuscar

$ubicacion->get('/ubicacion/buscar/{id}', function ($id) use ($app) {

    if ($app['ubicacion']->buscar(['ubicacion_id' => $id])) {

        //MOSTRAR DATOS
        return $app['twig']->render(
            'ubicacion/ubicacion_datos.html.twig', [
                'ubicacion_id'          => $app['ubicacion']->getId(),
                'ubicacion_nombre'      => $app['ubicacion']->getNombre(),
                'ubicacion_observacion' => $app['ubicacion']->getObservacion(),
                'editar' => TRUE,
            ]
        );

    } else {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['ubicacion']->getMensaje(),
            ]
        );

        //MOSTRAR MENSAJE ERROR
        return $app['twig']->render('mensaje_error.html.twig');

  }


})
->bind('ubicacionBuscar');
