<?php
/*
 *  CONTROLADOR empresaBuscar
 */
$empresa->get('/empresa/buscar/{empresaId}',function($empresaId) use($app){

  try{

      //BUSCAR POR EMPRESA POR ID
      $registros = $app['empresa']->buscarId($empresaId);

      //MOSTRAR DATOS
      return $app['twig']->render('empresa/empresa_datos.html.twig',
          array('empresa_id'          =>$registros['empresa_id'],
                'empresa_nombre'      =>$registros['empresa_nombre'],
                'empresa_observacion' =>$registros['empresa_observacion'],
                'editar'=>TRUE));

  } catch (Exception $e) {

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        array('message' => $e->getMessage()));

    //MOSTRAR MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('empresaBuscar');
