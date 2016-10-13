<?php
/*
 *  CONTROLADOR usuarioNuevo
 */
use Symfony\Component\Validator\Constraints as Assert;

$usuario->get('/usuario/nuevo', function() use ($app) {

  //BUSCAR PERFILES
  $perfiles = $app['perfil']->listar();

  //REDIRECCIÓN FORMULARIO DATOS
  return $app['twig']->render('usuario/usuario_datos.html.twig',
      array('registros' => array(),
            'perfiles' => $perfiles,
            'editar'=> FALSE ));

})
->bind('usuarioNuevo');
