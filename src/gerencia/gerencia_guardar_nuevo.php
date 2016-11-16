<?php

//CONTROLADOR empresaGuardarNuevo

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

$gerencia->post('/gerencia/guardar/nuevo', function (Request $request) use ($app) {

    //DATOS DEL FORMULARIO
    $campos = [
        'gerencia_nombre'      => mb_strtoupper($request->get('gerencia-nombre'),'utf-8'),
        'gerencia_observacion' => $request->get('gerencia-observacion'),
    ];

    if ($app['gerencia']->nuevo($campos)) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'success', [
               'message' => $app['gerencia']->getMensaje(),
            ]
        );

        //REDIRECCIONAR AL FORMULARIO LISTAR
        return $app->redirect($app['url_generator']->generate('gerenciaListar'));

    } else {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['gerencia']->getMensaje(),
            ]
        );

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render(
            'gerencia/gerencia_datos.html.twig', [
                'gerencia_nombre'      => $campos['gerencia_nombre'],
                'gerencia_observacion' => $campos['gerencia_observacion'],
                'editar' => FALSE,
             ]
        );
        
    }


})
->bind('gerenciaGuardarNuevo');
