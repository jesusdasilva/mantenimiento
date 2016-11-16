<?php

//CONTROLADOR ubicacionListar

$ubicacion->get('/ubicacion/listar', function() use ($app) {

    if (!$app['ubicacion']->buscar()) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message'=>$app['ubicacion']->getMensaje(),
            ]
        );

    }

    //ENVIAR DATOS A LA PLANTILLA
    return $app['twig']->render(
        'ubicacion/ubicacion_listado.html.twig', [
            'ubicaciones' => $app['ubicacion']->getTodas(),
        ]
    );

})
->bind('ubicacionListar');
