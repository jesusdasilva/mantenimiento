<?php
/*
 *  CONTROLADOR gerenciaBuscar
 */
$gerencia->get('/gerencia/buscar/{id}',function($id) use($app){

  if($app['gerencia']->buscar(['gerencia_id'=>$id])){

    //MOSTRAR DATOS
    return $app['twig']->render('gerencia/gerencia_datos.html.twig',
        ['gerencia_id'          => $app['gerencia']->getId(),
         'gerencia_nombre'      => $app['gerencia']->getNombre(),
         'gerencia_observacion' => $app['gerencia']->getObservacion(),
         'editar'=>TRUE]);
  }else{

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        ['message'=> $app['gerencia']->getMensaje()]);

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');
  }

})
->bind('gerenciaBuscar');
