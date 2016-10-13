<?php
/*
 *  CONTROLADOR empresaGuardarActualizar
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$empresa->post('/empresa/guardar/actualizar', function(Request $request) use ($app) {

  try{
      //DATOS DEL FORMULARIO, empresa_nombre_h ES PORQUE NO SE ENVIA EL VALOR CUANDO ESTA BLOQUEADO
      $registros = array('empresa_id'          => $request->get('empresa-id'),
                         'empresa_nombre'      => $request->get('empresa-nombre_h'),
                         'empresa_observacion' => $request->get('empresa-observacion'));

      $registrosAfectados = $app['empresa']->actualizar($registros);

      if($registrosAfectados <= 0){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
          array('message' => 'No se pudo modificar la Empresa'));

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render('empresa/empresa_datos.html.twig',
            array('empresa_id'          =>$registros['empresa_id'],
                  'empresa_nombre'      =>$registros['empresa_nombre'],
                  'empresa_observacion' =>$registros['empresa_observacion'],
                  'editar'=>TRUE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'La Empresa fue modificada'));

      //REDIRECCIONAR AL FORMULARIO LISTAR
      return $app->redirect($app['url_generator']->generate('empresaListar'));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('empresaGuardarActualizar');
