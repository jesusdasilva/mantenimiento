<?php

//CONTROLADOR ubicacionGuardarActualizar

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

$ubicacion->post('/ubicacion/guardar/actualizar', function(Request $request) use ($app) {

    //DATOS DEL FORMULARIO, ubicacion_nombre_h ES PORQUE NO SE ENVIA EL VALOR CUANDO ESTA BLOQUEADO
    $campos = [
        'ubicacion_id'          => $request->get('ubicacion-id'),
        'ubicacion_nombre'      => $request->get('ubicacion-nombre_h'),
        'ubicacion_observacion' => $request->get('ubicacion-observacion'),
    ];

    if ($app['ubicacion']->actualizar($campos)) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'success', [
                'message' => $app['ubicacion']->getMensaje(),
            ]
        );

        //REDIRECCIONAR AL FORMULARIO LISTAR
        return $app->redirect($app['url_generator']->generate('ubicacionListar'));

    } else {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['ubicacion']->getMensaje(),
            ]
        );

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render(
            'ubicacion/ubicacion_datos.html.twig', [
                'ubicacion_id'          => $campos['ubicacion_id'],
                'ubicacion_nombre'      => $campos['ubicacion_nombre'],
                'ubicacion_observacion' => $campos['ubicacion_observacion'],
                'editar' => TRUE,
            ]
        );

  }

})
->bind('ubicacionGuardarActualizar');
