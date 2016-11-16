<?php

//CONTROLADOR empresaGuardarNuevo

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

$ubicacion->post('/ubicacion/guardar/nuevo', function(Request $request) use ($app) {

    //DATOS DEL FORMULARIO
    $campos = [
        'ubicacion_nombre'      => mb_strtoupper($request->get('ubicacion-nombre'),'utf-8'),
        'ubicacion_observacion' => $request->get('ubicacion-observacion'),
    ];

    if ($app['ubicacion']->nuevo($campos)) {

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

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render(
            'ubicacion/ubicacion_datos.html.twig', [
                'ubicacion_nombre'      => $campos['ubicacion_nombre'],
                'ubicacion_observacion' => $campos['ubicacion_observacion'],
                'editar' => FALSE,
             ]
        );

  }

})
->bind('ubicacionGuardarNuevo');
