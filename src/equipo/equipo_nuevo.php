<?php
/*
 *  CONTROLADOR gerenciaNuevo
 */
use Symfony\Component\Validator\Constraints as Assert;

$equipo->get('/equipo/nuevo', function() use ($app) {
     /*
     *ABRIR FORMULARIO DE DATOS EN BLANCO
     */
    return $app['twig']->render('equipo/equipo_nuevo_elegir_mantenimiento.html.twig',
        array ('editar' => FALSE));

})
->bind('equipoNuevoElegirMantenimiento');
