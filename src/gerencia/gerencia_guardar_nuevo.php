<?php
/*
 *  CONTROLADOR empresaGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;
 use ServiciosPropios\BD\EntidadGerencia;

$gerencia->post('/gerencia/guardar/nuevo', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('gerencia_nombre'=> mb_strtoupper($request->get('gerencia-nombre'),'utf-8'),
                         'gerencia_observacion' => $request->get('gerencia-observacion'));

      //BUSCAR NOMBRE DE GERENCIA
      $nombreEncontrado = $app['gerencia']->buscarNombre($registros['gerencia_nombre']);

      if(!$nombreEncontrado){//NO ESTA REPETIDO EL NOMBRE

        //GUARDAR GERENCIA
        $registrosAfectados = $app['gerencia']->nuevo($registros);

        //VERIFICAR QUE SE GUARDÓ LA GERENCIA
        if($registrosAfectados <= 0)
          throw new Exception('Error, No se pudo ingresar la Gerencia.');

      }else{//NOMBRE REPETIDO

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'La Gerencia se encuentra repetida'));

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render('gerencia/gerencia_datos.html.twig',
            array('gerencia_nombre'      => $registros['gerencia_nombre'],
                  'gerencia_observacion' => $registros['gerencia_observacion'],
                  'editar' => FALSE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'La Gerencia fue incluida'));

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
->bind('gerenciaGuardarNuevo');
