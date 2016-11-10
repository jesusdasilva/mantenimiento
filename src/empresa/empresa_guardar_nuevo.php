<?php
/*
 * CONTROLADOR empresaGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$empresa->post('/empresa/guardar/nuevo', function(Request $request) use ($app) {

      //DATOS DEL FORMULARIO
      $registros = ['empresa_nombre'      => mb_strtoupper($request->get('empresa-nombre'),'utf-8'),
                    'empresa_observacion' => $request->get('empresa-observacion')];

      if($app['empresa']->nuevo($registros)){

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
            array('empresa_nombre'      => $registros['empresa_nombre'],
                  'empresa_observacion' => $registros['empresa_observacion'],
                  'editar' => FALSE));
      }



    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('empresaGuardarNuevo');
