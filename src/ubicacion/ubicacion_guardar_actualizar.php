<?php
/*
 *  CONTROLADOR ubicacionGuardarActualizar
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$ubicacion->post('/ubicacion/guardar/actualizar', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO

      $registros = array('ubicacion_id'          => $request->get('ubicacion-id'),
                         'ubicacion_nombre'      => $request->get('ubicacion-nombre-h'),
                         'ubicacion_observacion' => $request->get('ubicacion-observacion'));

      //ACTUALIZAR
      $registrosAfectados = $app['ubicacion']->actualizar($registros);

      if($registrosAfectados <= 0){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'No se pudo modificar la Ubicacion'));

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render('ubicacion/ubicacion_datos.twig',
          array('ubicacion_id'          => $registros[ubicacion_id],
                'ubicacion_nombre'      => $registros[ubicacion_nombre],
                'ubicacion_observacion' => $registros[ubicacion_observacion],
                'editar'=>TRUE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'La Ubicacion fue modificada'));

      //REDIRECCIONAR AL FORMULARIO LISTAR
      return $app->redirect($app['url_generator']->generate('ubicacionListar'));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('ubicacionGuardarActualizar');
