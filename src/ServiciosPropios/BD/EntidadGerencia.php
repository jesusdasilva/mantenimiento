<?php
/*
* ENTIDAD GERENCIA
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadGerencia{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }
 /*
 * LISTADO DE TODAS LAS GERENCIAS
 */
  public function listar(){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_gerencias ";
    $sql .= " ORDER BY gerencia_nombre ";

    //BUSCAR TODAS LAS GERENCIAS
    $gerencias = $this->app['db']->fetchAll($sql);

    //RETORNAR LOS REGISTROS DE TODAS LAS EMPRESAS
    return $gerencias;
  }
 /*
 * BUSCAR UNA GERENCIA POR ID
 */
  public function buscarId($gerenciaId){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_gerencias ";
    $sql .= " WHERE gerencia_id = ? ";

    //BUSCAR ID
    $gerencia = $this->app['db']->fetchAssoc($sql,
        array($gerenciaId));

    //RETORNAR LOS REGISTROS DE UNA GERENCIA
    return $gerencia;
  }
  /*
  * BUSCAR UNA GERENCIA POR NOMBRE
  */
  public function buscarNombre($gerenciaNombre){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_gerencias ";
    $sql .= " WHERE gerencia_nombre = ? ";

    //BUSCAR NOMBRE
    $nombreEncontrado = $this->app['db']->fetchAssoc($sql,
        array($gerenciaNombre));

    //RETORNAR LOS REGISTROS DE UNA GERENCIA
    return $nombreEncontrado;
  }

  public function Nuevo($registros){

      //GUARDAR NUEVO REGISTRO
      $registrosAfectados = $this->app['db']->insert('mantenimientos_gerencias',
          array('gerencia_nombre'     =>$registros['gerencia_nombre'],
                'gerencia_observacion'=>$registros['gerencia_observacion']));

      //RETORNAR EL NÚMERO DE REGISTROS INSERTADOS
      return $registrosAfectados;
  }
  /*
  * ACTUALIZAR UNA GERENCIA
  */
  public function actualizar($regitros){

    //ACTUALIZAR
    $registrosAfectados = $this->app['db']->update('mantenimientos_gerencias',
          array('gerencia_observacion'=> $regitros['gerencia_observacion']),
          array('gerencia_id'=>$regitros['gerencia_id']));

    //RETORNAR EL NÚMERO DE REGISTROS ATUALIZADOS
    return $registrosAfectados;
  }
  /*
  * ELIMINAR UNA GERENCIA
  */
  public function eliminar($gerenciaId){

    //ELIMINAR
    $registroEliminado = $this->app['db']->delete('mantenimientos_gerencias',
        array('gerencia_id' => $gerenciaId));

    //RETORNAR EL NÚMERO DE REGISTROS ELIMINADOS
    return $registroEliminado;
  }

  public function catalogo(){}

}
