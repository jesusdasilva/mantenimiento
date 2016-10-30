<?php
/*
 *  CONTROLADOR gerenciaNuevo
 */
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints as Assert;

$equipo->get('/equipo/nuevo', function() use ($app) {
     /*
     *ABRIR FORMULARIO DE DATOS EN BLANCO
     */
    return $app['twig']->render('equipo/equipo_nuevo_elegir_mantenimiento.html.twig');

})
->bind('equipoNuevoElegirMantenimiento');


//ASIGNAR ACTIVIDADES
$equipo->post('/equipo/nuevo', function(Request $request) use ($app) {

  try{

      //DATOS DEL FORMULARIO
      $registros = array('equipo_nombre' => mb_strtoupper($request->get('equipo-nombre'),'utf-8'),
                         'equipo_so'     => $request->get('equipo-so'),
                         'empresa_id'    => $app['empresa']->buscarNombreTaerId('NINGUNA'),
                         'gerencia_id'   => $app['gerencia']->buscarNombreTaerId('NINGUNA'),
                         'ubicacion_id'  => $app['ubicacion']->buscarNombreTaerId('NINGUNA'));

      //BUSCAR NOMBRE DEL EQUIPO
      $nombreEncontrado = $app['equipo']->buscarNombre($registros['equipo_nombre']);

      if(!$nombreEncontrado){//NO ESTA REPETIDO EL NOMBRE

        //GUARDAR EQUIPO Y ACTIVIDADES
        $registrosAfectados = $app['equipo']->nuevo($registros);

        //VERIFICAR QUE SE GUARDÓ
        if($registrosAfectados <= 0)

          throw new Exception('Error, No se pudo ingresar el Equipo.');

      }else{//NOMBRE REPETIDO

        //MENSAJE
        $app['session']->getFlashBag()->add('danger',
            array('message' => 'El Equipo se encuentra repetido'));

        //REENVIAR AL FORMULÁRIO DATOS
        return $app['twig']->render('equipo/equipo_nuevo_elegir_mantenimiento.twig',
            array('equipo_nombre' => $registros['equipo_nombre']));
      }

      //MENSAJE
      //$app['session']->getFlashBag()->add('success',
      //    array('message' => 'La Empresa fue incluida'));

      //REDIRECCIONAR AL FORMULARIO LISTAR
      return $app['twig']->render('equipo/equipo_nuevo_registrar_mantenimiento.html.twig');

    //CAPTURAR ERROR
    }catch (Exception $e) {

      //MENSAJE
      $app['session']->getFlashBag()->add('danger',
          array('message' => $e->getMessage()));

      //MOSTRAR MENSAJE ERROR
      return $app['twig']->render('mensaje_error.html.twig');

    }

})
->bind('equipoNuevoRegistarMantenimiento');
