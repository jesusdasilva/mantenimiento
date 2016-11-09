<?php
/*
 *  CONTROLADOR empresaBuscar
 */
$empresa->get('/empresa/buscar/{id}',function($id) use($app){

  try{

      //BUSCAR POR EMPRESA POR ID
      $registros = $app['empresa']->buscarId($id);

      if($app['empresa']->buscarId($id)){

        //MOSTRAR DATOS
        return $app['twig']->render('empresa/empresa_datos.html.twig',
            array('empresa_id' => $app['empresa']->getID();
        $app['empresa']->getNombre();
        $app['empresa']->getObservacion();

      }else{

        throw new Exception('Error al buscar id');

      }

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
