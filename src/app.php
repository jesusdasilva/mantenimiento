<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\SessionServiceProvider;
//use Silex\Provider\DoctrineServiceProvider;
//use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\FormServiceProvider;
//use Silex\Provider\TranslationServiceProvider;


$app = new Application();
//$app->register(new DoctrineServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
//$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
//$app->register(new MonologServiceProvider());
$app->register(new FormServiceProvider());
//$app->register(new TranslationServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
});

//CONFIGURACIÓN DE BASE DE DATOS
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options'=> [
        'driver'   => 'pdo_pgsql',
        'host'     => 'localhost',
        'dbname'   => 'mantenimientoDB',
        'user'     => 'mantenimiento',
        'password' => '123',
        'charset'  => 'utf8',
        ],
    ]);

//SERVICIOS PROPIOS
$app['empresa'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadEmpresa($app);
};

$app['gerencia'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadGerencia($app);
};

$app['ubicacion'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadUbicacion($app);
};

$app['equipo'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadEquipo($app);
};
$app['checklist'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadChecklist($app);
};

//USUARIOS
$app['usuario'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadUsuario($app);
};

$app['perfil'] = function ()  use ($app) {
    return new ServiciosPropios\BD\EntidadPerfil($app);
};

return $app;
