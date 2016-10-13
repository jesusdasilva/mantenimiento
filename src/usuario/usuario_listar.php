<?php
/*
 *  CONTROLADOR usuarioListar
 */
$usuario->get('/usuario/listar', function() use ($app) {

  try{

      //LISTAR
      $usuarios = $app['usuario']->listar();

      //ENVIAR DATOS A LA PLANTILLA
      return $app['twig']->render('usuario/usuario_listado.html.twig',
          array('usuarios'=> $usuarios));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('usuarioListar');
