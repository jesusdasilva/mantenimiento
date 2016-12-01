<?php

//CONTROLADOR empresaListar

$empresa->get('/empresa/listar', function () use ($app) {

    if (!$app['empresa']->buscar(['excluir_nombre' => 'NINGUNA'])) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['empresa']->getMensaje(),
            ]
        );

    }

    //ENVIAR DATOS A LA PLANTILLA
    return $app['twig']->render(
        'empresa/empresa_listado.html.twig', [
            'empresas' => $app['empresa']->getTodas(),
        ]
    );

})
->bind('empresaListar');
