<?php
/*
 * CONTROLADOR empresaGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;
 use ServiciosPropios\BD\EntidadGerencia;

$empresa->post('/empresa/guardar/nuevo', function(Request $request) use ($app) {

  //DATOS DEL FORMULARIO
  $campos = ['empresa_nombre'      => mb_strtoupper($request->get('empresa-nombre'),'utf-8'),
             'empresa_observacion' => $request->get('empresa-observacion')];

  if($app['empresa']->nuevo($campos)){

    //MENSAJE
    $app['session']->getFlashBag()->add('success',
        array('message' => $app['empresa']->getMensaje()));

    //REDIRECCIONAR AL FORMULARIO LISTAR
    return $app->redirect($app['url_generator']->generate('empresaListar'));

    }else{

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $app['empresa']->getMensaje()));

      //REENVIAR AL FORMULÁRIO DATOS
      return $app['twig']->render('empresa/empresa_datos.html.twig',
          array('empresa_nombre'      => $campos['empresa_nombre'],
                'empresa_observacion' => $campos['empresa_observacion'],
                'editar' => FALSE));
      }

})
->bind('empresaGuardarNuevo');
