<?php
/*
* CONTROLADOR login_verificar
*/
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;


$login->post('/login/verificar',function(Request $request) use ($app){

	try{

			//DATOS DEL FORULARIO
      $registros = array('usuario_indicador' => $request->get('usuario-indicador'),
		                     'usuario_clave'     => $request->get('usuario-clave'));

			$usuarioValido = $app['usuario']->verificar($registros);

			//VERIFICAR AL USUARIO
      if($usuarioValido){

      	//GUARDAR LA SESIÓN
        $app['session']->set('usuarioIndicador',$usuarioValido['usuario_indicador']);
        $app['session']->set('usuarioNombre',$usuarioValido['usuario_nombre']);
				$app['session']->set('perfilNombre',$usuarioValido['perfil_nombre']);


        //REDIRECCIONAR AL INICIO
        return $app->redirect($app['url_generator']->generate('inicio'));

      }else{

      	//MENSAJE
        $app['session']->getFlashBag()->add('danger',
						array('message' => 'Usuario o Clave inválida'));

        //REDIRECCIONAR AL FORMULARIO LOGIN
      	return $app->redirect($app['url_generator']->generate('login'));

      }

	} catch (Exception $e) {

        //MENSAJE
				$app['session']->getFlashBag()->add('danger',
						array('message' => $e->getMessage()));

        //MOSTRAR MENSAJE ERROR
        return $app['twig']->render('mensaje_error.html.twig');

	}
})
->bind('loginVerificar');
