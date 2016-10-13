<?php
/*
 *  CONTROLADOR empresaListar
 */

$empresa->get('/empresa/listar', function() use ($app) {

  try{

      //BUSCAR TODAS LA EMPRESAS
      $empresas = $app['empresa']->listar();

      //ENVIAR DATOS A LA PLANTILLA
      return $app['twig']->render('empresa/empresa_listado.html.twig',
          array('empresas'=> $empresas));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('empresaListar');
