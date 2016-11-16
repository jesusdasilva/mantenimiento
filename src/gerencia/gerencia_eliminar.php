<?php

//CONTROLADOR gerenciaEliminar

$empresa->get('gerencia/eliminar/{id}', function ($id) use ($app) {

    if ($app['gerencia']->eliminar($id)) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'success', [
                'message' => $app['gerencia']->getMensaje(),
             ]
        );

        //REDIRECCIONAR AL LISTADO
        return $app->redirect($app['url_generator']->generate('gerenciaListar'));

    } else {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['gerencia']->getMensaje(),
            ]
        );

        //MOSTRAR MENSAJE ERROR
        return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('gerenciaEliminar');
