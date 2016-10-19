<?php
/*
 *  CONTROLADOR empresaGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$ubicacion->post('/ubicacion/guardar/nuevo', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('ubicacion_nombre' => mb_strtoupper($request->get('ubicacion-nombre'),'utf-8'), //CAMBIAR A MAYÚSCULAS EL NOMBRE
                         'ubicacion_observacion' => $request->get('ubicacion-observacion'));

      //BUSCAR NOMBRE DE UBICACION REPETDIDA
      $nombreEncontrado = $app['ubicacion']->buscarNombre($registros['ubicacion_nombre']);

      if(!$nombreEncontrado){//NO ESTA REPETIDO EL NOMBRE

        //INSERTAR
        $registrosAfectados = $app['ubicacion']->nuevo($registros);

        if($registrosAfectados <= 0)
          throw new Exception('Error, No se pudo ingresar la Ubicación.');

      }else{//NOMBRE REPETIDO

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'La Ubicación se encuentra repetida'));

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render('ubicacion/ubicacion_datos.html.twig',
          array('ubicacion_nombre'      => $registros['ubicacion_nombre'],
                'ubicacion_observacion' => $registros['ubicacion_observacion'],
                'editar' => FALSE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'La Ubicación fue incluida'));

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
->bind('ubicacionGuardarNuevo');
