<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

/*$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;*/

$app->get('/actividad', function () use ($app) {
    return $app['twig']->render('/actividad/actividad_mantenimiento.html.twig', array());
})
->bind('actividad');


//LOGIN
$app->mount('/', include __DIR__.'/../src/login/login_index.php');
//INICIO
$app->mount('/', include __DIR__.'/../src/inicio/inicio_index.php');
//EMPRESA
$app->mount('/', include __DIR__.'/../src/empresa/empresa_index.php');
//GERENCIA
$app->mount('/', include __DIR__.'/../src/gerencia/gerencia_index.php');
//UBICACIÓN
$app->mount('/', include __DIR__.'/../src/ubicacion/ubicacion_index.php');
//MANTENIMIENTO
$app->mount('/', include __DIR__.'/../src/mantenimiento/mantenimiento_index.php');
//EQUIPO
$app->mount('/', include __DIR__.'/../src/equipo/equipo_index.php');

//USUARIO
$app->mount('/', include __DIR__.'/../src/usuario/usuario_index.php');


$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
