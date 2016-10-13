<?php
/*
 *  CONTROLADOR manteniemientoMostrar
 */
use Symfony\Component\Validator\Constraints as Assert;

$mantenimiento->get('/mantenimiento/mostrar', function() use ($app) {
     /*
     *MOSTRAR MANTENIMIENTOS
     */
    return $app['twig']->render('mantenimiento/mantenimiento_mostrar.html.twig');

})
->bind('mantenimientoMostrar');
