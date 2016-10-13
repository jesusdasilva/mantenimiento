<?php
/*
 *  CONTROLADOR inicio
 */
$inicio->get('/inicio', function() use ($app) {

    //MOSTAR LA PÁGINA DE INICIO
    return $app['twig']->render('inicio/inicio.twig');

})
->bind('inicio');
