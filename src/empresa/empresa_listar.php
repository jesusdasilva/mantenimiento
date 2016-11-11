<?php
/*
 *  CONTROLADOR empresaListar
 */
$empresa->get('/empresa/listar', function() use ($app) {

  if($app['empresa']->buscar()){

    //ENVIAR DATOS A LA PLANTILLA
    return $app['twig']->render('empresa/empresa_listado.html.twig',
        ['empresas'=>$app['empresa']->getTodas()]);

  }else{

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        ['message'=>$app['empresa']->getMensaje()]);

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('empresaListar');
