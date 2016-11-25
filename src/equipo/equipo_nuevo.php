<?php

//CONTROLADOR gerenciaNuevo

use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Constraints as Assert;

$equipo->get('/equipo/nuevo', function() use ($app) {

     //ABRIR FORMULARIO DE DATOS EN BLANCO
    return $app['twig']->render('equipo/equipo_nuevo_elegir_mantenimiento.html.twig');

})
->bind('equipoNuevoElegirMantenimiento');


//ASIGNAR ACTIVIDADES
$equipo->post('/equipo/nuevo', function(Request $request) use ($app) {

    $campos = [
        'equipo_nombre' => mb_strtoupper($request->get('equipo-nombre'),'utf-8'),
        'checklist_so'  => $request->get('equipo-so'),
    ];

    if ($app['equipo']->nuevo($campos)) {

        //ENVIAR LOS DATOS AL FORMULARIO
        return $app['twig']->render(
            'equipo/equipo_nuevo_registrar_mantenimiento.html.twig', [
                'registrosEquipo' => $campos,
                'ubicaciones'     => ($app['ubicacion']->buscar()) ? $app['ubicacion']->getTodas():'',
                'empresas'        => ($app['empresa']->buscar())   ? $app['empresa']->getTodas():'',
                'gerencias'       => ($app['gerencia']->buscar())  ? $app['gerencia']->getTodas():'',
            ]
        );

    } else {//ERROR AL INSERTAR LOS CAMPOS EN TABLA mantenimientos_equipos O mantenimientos_checklist

        //MENSAJE
        $app['session']->getFlashBag()->add(
            'danger', [
                'message' => $app['equipo']->getMensaje(),
            ]
        );

        //REENVIAR AL FORMULÁRIO EQUIPO NUEVO
        return $app['twig']->render(
            'equipo/equipo_nuevo_elegir_mantenimiento.html.twig', [
                'equipo_nombre' => $campos['equipo_nombre'],
            ]
        );

    }

})
->bind('equipoNuevoRegistarMantenimiento');
