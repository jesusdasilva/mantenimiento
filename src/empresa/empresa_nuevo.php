<?php
/*
 *  CONTROLADOR empresaNuevo
 */
use Symfony\Component\Validator\Constraints as Assert;

$empresa->get('/empresa/nuevo', function() use ($app) {

  //ABRIR FORMULARIO DE DATOS EN BLANCO
  return $app['twig']->render('empresa/empresa_datos.html.twig',
      ['editar'=> FALSE]);

})
->bind('empresaNuevo');
