<?php
/*
 *  CONTROLADOR empresaGuardarActualizar
 */
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

$empresa->post('/empresa/guardar/actualizar', function(Request $request) use ($app) {

  //DATOS DEL FORMULARIO, empresa_nombre_h ES PORQUE NO SE ENVIA EL VALOR CUANDO ESTA BLOQUEADO
  $registros = array('empresa_id'          => $request->get('empresa-id'),
                     'empresa_nombre'      => $request->get('empresa-nombre_h'),
                     'empresa_observacion' => $request->get('empresa-observacion'));

  if($app['empresa']->actualizar($registros)){

    //MENSAJE
    $app['session']->getFlashBag()->add('success',
        array('message' => $app['empresa']->getMensaje()));

    //REDIRECCIONAR AL FORMULARIO LISTAR
    return $app->redirect($app['url_generator']->generate('empresaListar'));

  }else{

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        array('message' => $app['empresa']->getMensaje()));

    //REGRESAR AL FORMULARIO DATOS
    return $app['twig']->render('empresa/empresa_datos.html.twig',
        array('empresa_id'          =>$registros['empresa_id'],
              'empresa_nombre'      =>$registros['empresa_nombre'],
              'empresa_observacion' =>$registros['empresa_observacion'],
              'editar'=>TRUE));
  }

})
->bind('empresaGuardarActualizar');
