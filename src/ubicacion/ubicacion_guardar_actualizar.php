<?php
/*
 *  CONTROLADOR ubicacionGuardarActualizar
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$ubicacion->post('/ubicacion/guardar/actualizar', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $idUbicacion = $request->get('id-ubicacion');
      $nombreUbicacion = $request->get('nombre-ubicacion-h');

      //VERIFICAR SI SE ENVIÓ EL CAMPO OBSERVACIÓ
      if($request->get('observacion-ubicacion')){
        $observacionUbicacion = $request->get('observacion-ubicacion');
      }else{
        $observacionUbicacion = NULL;
      }

      //ACTUALIZAR
      $registrosAfectados = $app['db']->update('ubicaciones',
        array('observacion_ubicacion'=> $observacionUbicacion),
        array('id_ubicacion'=>$idUbicacion));

      if($registrosAfectados <= 0){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',array('message' => 'No se pudo modificar la ubicacion'));

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render('ubicacion/ubicacion_datos.twig',
          array('idUbicacion'          => $idUbicacion,
                'nombreUbicacion'      => $nombreUbicacion,
                'observacionUbicacion' => $observacionUbicacion,
                'editar'=>TRUE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',array('message' => 'La ubicacion fue modificada'));

      //REDIRECCIONAR AL FORMULARIO LISTAR
      return $app->redirect($app['url_generator']->generate('ubicacionListar'));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('ubicacionGuardarActualizar');
