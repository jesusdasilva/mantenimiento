<?php
/*
 *  CONTROLADOR usuarioGuardarActualizar
 */
 use Symfony\Component\HttpFoundation\Request ;
 use Symfony\Component\HttpFoundation\Response;

$usuario->post('/usario/guardar/actualizar', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('perfil_id'           => $request->get('perfil-id'),
                         'usuario_id'          => $request->get('usuario-id'),
                         'usuario_nombre'      => $request->get('usuario-nombre'),
                         'usuario_indicador'   => $request->get('usuario-indicador'),
                         'usuario_clave'       => $request->get('usuario-clave'),
                         'usuario_observacion' => $request->get('usuario-observacion'));
      //ACTUALIZAR
      $registrosAfectados = $app['usuario']->actualizar($registros);

      if($registrosAfectados <= 0){//NO SE ACTUALIZÓ

        //LISTADO DE PERFILES
        $perfiles = $app['perfil']->listar();

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'No se pudo modificar al Usuario'));

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render('usuario/usuario_datos.html.twig',
          array('perfil_id'           => $registos['perfil_id'],
                'usuario_nombre'      => $registos['usuario_nombre'],
                'usuario_indicador'   => $registos['usuario_indicador'],
                'usuario_clave'       => $registos['usuario_clave'],
                'usuario_observacion' => $registos['usuario_observacion'],
                'perfiles' => $perfiles,
                'editar' => FALSE));
      }

      //MENSAJE
      $app['session']->getFlashBag()->add('success',
          array('message' => 'El Usuario fue modificado'));

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
->bind('usuarioGuardarActualizar');
