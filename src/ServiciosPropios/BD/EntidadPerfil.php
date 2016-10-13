<?php
/*
* ENTIDAD USUARIO
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadPerfil{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }
  /*
  * LISTADO
  */
  public function listar(){

    //SQL
    $sql  = "SELECT * ";
    $sql .= " FROM usuarios_perfiles ";
    $sql .= " ORDER BY perfil_nombre ";

    //LISTADO DE PERFILES
    $perfiles = $this->app['db']->fetchAll($sql);

    //RETORNAR LOS REGISTROS
    return $perfiles;
  }
}
