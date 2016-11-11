<?php
/*
 * CONTROLADOR empresaBuscar
 */
$empresa->get('/empresa/buscar/{id}',function($id) use($app){

  if($app['empresa']->buscar(['empresa_id'=>$id])){

    //MOSTRAR DATOS
    return $app['twig']->render('empresa/empresa_datos.html.twig',
        ['empresa_id'          => $app['empresa']->getId(),
         'empresa_nombre'      => $app['empresa']->getNombre(),
         'empresa_observacion' => $app['empresa']->getObservacion(),
         'editar' => TRUE]);

  }else{

   //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        array('message' => $this->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('empresaBuscar');
