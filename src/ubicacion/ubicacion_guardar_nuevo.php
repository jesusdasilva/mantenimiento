<?php
/*
 *  CONTROLADOR empresaGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$ubicacion->post('/ubicacion/guardar/nuevo', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $nombreUbicacion = mb_strtoupper($request->get('nombre-ubicacion'),'utf-8');//CAMBIAR A MAYÚSCULAS EL NOMBRE

      //VERIFICAR SI SE ENVIÓ EL CAMPO OBSERVACIÓN
      if($request->get('observacion-ubicacion')){
        $observacionUbicacion = $request->get('observacion-ubicacion');
      }else{
        $observacionUbicacion = null;
      }

      //VERIFICAR QUE EL NOMBRE NO ESTÉ REPETIDO
      $sql  = " SELECT * ";
      $sql .= " FROM ubicaciones ";
      $sql .= " WHERE nombre_ubicacion = ? ";
      $nombreEncontrado = $app['db']->fetchAssoc($sql, array($nombreUbicacion));

      if(!$nombreEncontrado){//NO ESTA REPETIDO EL NOMBRE

        //INSERTAR
        $registrosAfectados = $app['db']->insert('ubicaciones',
          array('nombre_ubicacion'      => $nombreUbicacion,
                'observacion_ubicacion' => $observacionUbicacion));
        if($registrosAfectados <= 0)
          throw new Exception('Error, No se pudo ingresar la ubicacion.');
      }else{//NOMBRE REPETIDO

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',array('message' => 'La ubicacion se encuentra repetida'));

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render('ubicacion/ubicacion_datos.html.twig',
          array('nombreUbicacion'      => $nombreUbicacion,
                'observacionUbicacion' => $observacionUbicacion,
                'editar' => FALSE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',array('message' => 'La ubicacion fue incluida'));

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
->bind('ubicacionGuardarNuevo');
