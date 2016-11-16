<?php

//CONTROLADOR gerenciaListar

$gerencia->get('/gerencia/listar', function() use ($app) {

    if (!$app['gerencia']->buscar()) {

      //MENSAJE
      $app['session']->getFlashBag()->add(
          'danger', [
              'message'=>$app['gerencia']->getMensaje(),
          ]
      );

    }

    //ENVIAR DATOS A LA PLANTILLA
    return $app['twig']->render(
        'gerencia/gerencia_listado.html.twig', [
            'gerencias' => $app['gerencia']->getTodas(),
        ]
    );

})
->bind('gerenciaListar');
