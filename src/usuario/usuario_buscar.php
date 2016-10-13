<?php
/*
 *  CONTROLADOR usuarioBuscar
 */
$usuario->get('/usuario/buscar/{usuarioId}',function($usuarioId) use($app){

  try{

      //BUSCAR USUARIO POR ID
      $registros = $app['usuario']->buscarId($usuarioId);

      //BUSCAR TODOS LOS PERFILES
      $perfiles = $app['perfil']->listar();

      //REDIRECCIÓN FORMULARIO DATOS
      return $app['twig']->render('usuario/usuario_datos.html.twig',
          array('usuario_id'          => $registros['usuario_id'],
                'usuario_nombre'      => $registros['usuario_nombre'],
                'usuario_indicador'   => $registros['usuario_indicador'],
                'usuario_clave'       => $registros['usuario_clave'],
                'usuario_observacion' => $registros['usuario_observacion'],
                'perfil_id'           => $registros['perfil_id'],
                'perfiles' => $perfiles,
                'editar'=>TRUE ));

  } catch (Exception $e) {

    //MENSAJE
    $app['session']->getFlashBag()->add('danger',
        array('message' => $e->getMessage()));

    //MENSAJE ERROR
    return $app['twig']->render('mensaje_error.html.twig');

  }

})
->bind('usuarioBuscar');
