<?php
/*
 *  CONTROLADOR gerenciaListar
 */
$gerencia->get('/gerencia/listar', function() use ($app) {

  if($app['gerencia']->buscar()){

    //ENVIAR DATOS A LA PLANTILLA
    return $app['twig']->render('gerencia/gerencia_listado.html.twig',
        ['gerencias'=>$app['gerencia']->getTodas()]);

  }else{

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        ['message'=>$app['gerencia']->getMensaje()]);

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');
  }

})
->bind('gerenciaListar');
