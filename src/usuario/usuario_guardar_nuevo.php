<?php
/*
 *  CONTROLADOR usuarioGuardarNuevo
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$usuario->post('/usuario/guardar/nuevo', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('perfil_id'           => $request->get('perfil-id'),
                         'usuario_nombre'      => $request->get('usuario-nombre'),
                         'usuario_indicador'   => $request->get('usuario-indicador'),
                         'usuario_clave'       => $request->get('usuario-clave'),
                         'usuario_observacion' => $request->get('usuario-observacion'));

      //BUSCAR USUARIO POR INDICADOR
      $indicadorEncontrado = $app['usuario']->buscarIndicador($registros['usuario_indicador']);

      if(!$indicadorEncontrado){//NO ESTA REPETIDO EL INDICADOR

        //AGREGAR USUARIO NUEVO
        $registrosAfectados = $app['usuario']->nuevo($registros);

        //ERROR AL AGREGAR USUARIO
        if($registrosAfectados <= 0)
          throw new Exception('Error, No se pudo ingresar al Usuario.');

      }else{//INDICADOR REPETIDO

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'EL Usuario se encuentra repetido'));

        //BUSCAR PERFILES
        $perfiles = $app['perfil']->listar();

        //REENVIAR AL FORMULÁRIO LOS DATOS
        return $app['twig']->render('usuario/usuario_datos.html.twig',
          array('perfil_id'           => $registros['perfil_id'],
                'usuario_nombre'      => $registros['usuario_nombre'],
                'usuario_indicador'   => $registros['usuario_indicador'],
                'clave_usuario'       => $registros['clave_usuario'],
                'usuario_observacion' => $registros['usuario_observacion'],
                'perfiles' => $perfiles,
                'editar' => FALSE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'EL Usuario fue incluido'));

      //REDIRECCIONAR AL FORMULARIO LISTAR
      return $app->redirect($app['url_generator']->generate('usuarioListar'));

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('usuarioGuardarNuevo');
