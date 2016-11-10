<?php
/*
 *  CONTROLADOR empresaListar
 */
$empresa->get('/empresa/listar', function() use ($app) {

  if($app['empresa']->buscar()){

    //ENVIAR DATOS AL FORMULARIO
    return $app['twig']->render('empresa/empresa_listado.html.twig',
        array('empresas'=> $app['empresa']->getTodas()));

  }else{

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
      array('message' => $app['empresa']->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('empresaListar');
