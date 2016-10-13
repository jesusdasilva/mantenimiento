<?php
/*
 *  CONTROLADOR empresaGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$empresa->post('/empresa/guardar/nuevo', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('empresa_nombre'     => mb_strtoupper($request->get('empresa-nombre'),'utf-8'),
                         'empresa_observacion'=>$request->get('empresa-observacion'));

      //BUSCAR NOMBRE DE EMPRESA
      $nombreEncontrado = $app['empresa']->buscarNombre($registros['empresa_nombre']);

      if(!$nombreEncontrado){//NO ESTA REPETIDO EL NOMBRE

        //GUARDAR NUEVA EMPRESAS
        $registrosAfectados = $app['empresa']->nuevo($registros);

        //VERIFICAR QUE SE GUARDÓ LA EMPRESA
        if($registrosAfectados <= 0)
          throw new Exception('Error, No se pudo ingresar la Empresa.');

      }else{//NOMBRE REPETIDO

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'La Empresa se encuentra repetida'));

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render('empresa/empresa_datos.html.twig',
            array('empresa_nombre'      => $registros['empresa_nombre'],
                  'empresa_observacion' => $registros['empresa_observacion'],
                  'editar' => FALSE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'La Empresa fue incluida'));

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
->bind('empresaGuardarNuevo');
