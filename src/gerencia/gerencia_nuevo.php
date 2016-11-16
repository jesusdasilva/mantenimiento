<?php

//CONTROLADOR gerenciaNuevo

use Symfony\Component\Validator\Constraints as Assert;

$gerencia->get('/gerencia/nuevo', function () use ($app) {

    //ABRIR FORMULARIO DE DATOS EN BLANCO
    return $app['twig']->render(
        'gerencia/gerencia_datos.html.twig', [
            'editar' => FALSE,
        ]
    );

})
->bind('gerenciaNuevo');
