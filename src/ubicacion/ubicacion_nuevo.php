<?php
/*
 *  CONTROLADOR ubicacionNuevo
 */
use Symfony\Component\Validator\Constraints as Assert;

$ubicacion->get('/ubicacion/nuevo', function() use ($app) {
     /*
     *ABRIR FORMULARIO DE DATOS EN BLANCO
     */
    return $app['twig']->render('ubicacion/ubicacion_datos.html.twig',
      array ('idUbicacion'          => '',
             'nombreUbicacion'      => '',
             'observacionUbicacion' => '',
             'editar' => FALSE));

})
->bind('ubicacionNuevo');
