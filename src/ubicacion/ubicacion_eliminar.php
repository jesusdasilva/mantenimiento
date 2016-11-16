<?php

//CONTROLADOR ubicacionEliminar

$ubicacion->get('ubicacion/eliminar/{id}', function ($id) use ($app) {

    if ($app['ubicacion']->eliminar($id)) {

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'success', [
                'message' => $app['ubicacion']->getMensaje(),
            ]
        );

        //REDIRECCIONAR AL LISTADO
        return $app->redirect($app['url_generator']->generate('ubicacionListar'));

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
->bind('ubicacionEliminar');
