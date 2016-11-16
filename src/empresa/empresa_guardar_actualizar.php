<?php

//CONTROLADOR empresaGuardarActualizar

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$empresa->post('/empresa/guardar/actualizar', function (Request $request) use ($app) {

    //DATOS DEL FORMULARIO, empresa_nombre_h ES PORQUE NO SE ENVIA EL VALOR CUANDO ESTA BLOQUEADO
    $campos = [
        'empresa_id'          => $request->get('empresa-id'),
        'empresa_nombre'      => $request->get('empresa-nombre_h'),
        'empresa_observacion' => $request->get('empresa-observacion'),
    ];

    if ($app['empresa']->actualizar($campos)) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'success', [
                'message' => $app['empresa']->getMensaje(),
            ]
        );

        //REDIRECCIONAR AL FORMULARIO LISTAR
        return $app->redirect($app['url_generator']->generate('empresaListar'));

    } else {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['empresa']->getMensaje(),
            ]
        );

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render(
            'empresa/empresa_datos.html.twig', [
                'empresa_id'          => $campos['empresa_id'],
                'empresa_nombre'      => $campos['empresa_nombre'],
                'empresa_observacion' => $campos['empresa_observacion'],
                'editar'=>TRUE,
            ]
        );

  }

})
->bind('empresaGuardarActualizar');
