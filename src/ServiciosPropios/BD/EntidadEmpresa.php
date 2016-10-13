<?php
/*
* ENTIDAD EMPRESA
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadEmpresa{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }
 /*
 * LISTADO DE TODAS LAS EMPRESAS
 */
  public function listar(){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_empresas ";
    $sql .= " ORDER BY empresa_nombre ";

    //BUSCAR TODAS LAS EMPRESAS
    $empresas = $this->app['db']->fetchAll($sql);

    //RETORNAR LOS REGISTROS DE TODAS LAS EMPRESAS
    return $empresas;
  }
 /*
 * BUSCAR UNA EMPRESA POR ID
 */
  public function buscarId($empresaId){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_empresas ";
    $sql .= " WHERE empresa_id = ? ";

    //BUSCAR ID
    $empresa = $this->app['db']->fetchAssoc($sql,
        array($empresaId));

    //RETORNAR LOS REGISTROS DE UNA EMPRESA
    return $empresa;
  }
  /*
  * BUSCAR UNA EMPRESA POR NOMBRE
  */
  public function buscarNombre($empresaNombre){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_empresas ";
    $sql .= " WHERE empresa_nombre = ? ";

    //BUSCAR NOMBRE
    $nombreEncontrado = $this->app['db']->fetchAssoc($sql,
        array($empresaNombre));

    //RETORNAR LOS REGISTROS DE UNA EMPRESA
    return $nombreEncontrado;
  }

  public function Nuevo($registros){

      //GUARDAR NUEVO REGISTRO
      $registrosAfectados = $this->app['db']->insert('mantenimientos_empresas',
          array('empresa_nombre'     =>$registros['empresa_nombre'],
                'empresa_observacion'=>$registros['empresa_observacion']));

      //RETORNAR EL NÚMERO DE REGISTROS INSERTADOS
      return $registrosAfectados;
  }
  /*
  * ACTUALIZAR UNA EMPRESA
  */
  public function actualizar($regitros){

    //ACTUALIZAR
    $registrosAfectados = $this->app['db']->update('mantenimientos_empresas',
          array('empresa_observacion'=> $regitros['empresa_observacion']),
          array('empresa_id'=>$regitros['empresa_id']));

    //RETORNAR EL NÚMERO DE REGISTROS ATUALIZADOS
    return $registrosAfectados;
  }
  /*
  * ELIMINAR UNA EMPRESA
  */
  public function eliminar($empresaId){

    //ELIMINAR
    $registroEliminado = $this->app['db']->delete('mantenimientos_empresas',
        array('empresa_id' => $empresaId));

    //RETORNAR EL NÚMERO DE REGISTROS ELIMINADOS
    return $registroEliminado;
  }

  public function catalogo(){}

}
