<?php
/*
 *  CONTROLADOR gerenciaGuardarActualizar
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$gerencia->post('/gerencia/guardar/actualizar', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('gerencia_id'          => $request->get('gerencia-id'),
                         'gerencia_nombre'      => $request->get('gerencia-nombre-h'),
                         'gerencia_observacion' => $request->get('gerencia-observacion'));


      $registrosAfectados = $app['gerencia']->actualizar($registros);

      if($registrosAfectados <= 0){

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'No se pudo modificar la Gerencia'));

        //REGRESAR AL FORMULARIO DATOS
        return $app['twig']->render('gerencia/gerencia_datos.twig',
            array('gerencia_id'          => $registros['gerencia_id'],
                  'gerencia_nombre'      => $registros['gerencia_nombre'],
                  'gerencia_observacion' => $registros['gerencia_observacion'],
                  'editar'=>TRUE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'La Gerencia fue modificada'));

      //REDIRECCIONAR AL FORMULARIO LISTAR
      return $app->redirect($app['url_generator']->generate('gerenciaListar'));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('gerenciaGuardarActualizar');
