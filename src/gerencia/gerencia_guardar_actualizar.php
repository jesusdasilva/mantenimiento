<?php

//CONTROLADOR gerenciaGuardarActualizar

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

$gerencia->post('/gerencia/guardar/actualizar', function (Request $request) use ($app) {

    //DATOS DEL FORMULARIO, gerencia_nombre_h ES PORQUE NO SE ENVIA EL VALOR CUANDO ESTA BLOQUEADO
    $campos = [
        'gerencia_id'          => $request->get('gerencia-id'),
        'gerencia_nombre'      => $request->get('gerencia-nombre_h'),
        'gerencia_observacion' => $request->get('gerencia-observacion'),
    ];

    if ($app['gerencia']->actualizar($campos)) {

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

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render(
            'gerencia/gerencia_datos.html.twig', [
                'gerencia_id'          => $campos['gerencia_id'],
                'gerencia_nombre'      => $campos['gerencia_nombre'],
                'gerencia_observacion' => $campos['gerencia_observacion'],
                'editar' => TRUE,
            ]
        );

    }
})
->bind('gerenciaGuardarActualizar');
