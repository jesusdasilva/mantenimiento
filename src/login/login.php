<?php
/*
 *  CONTROLADOR login
 */
$login->get('/login', function() use ($app) {

    //ELIMINAR SESIÓN
    $app['session']->remove('usuarioIndicador');
    $app['session']->remove('usuarioNombre');
    $app['session']->remove('perfilNombre');

    //CARGAR FORMULARIO LOGIN
    return $app['twig']->render('login/login.html.twig');

})
->bind('login');
