<?php
/*
* ENTIDAD UBICACIÓN
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadUbicacion{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }
 /*
 * LISTADO DE TODAS LAS UBICACIONES
 */
  public function listar(){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_ubicaciones ";
    $sql .= " ORDER BY ubicacion_nombre ";

    //BUSCAR TODAS LAS UBICACIONES
    $ubicaciones = $this->app['db']->fetchAll($sql);

    //RETORNAR LOS REGISTROS DE TODAS LAS UBICACIONES
    return $ubicaciones;
  }
 /*
 * BUSCAR UNA UBICACIONES POR ID
 */
  public function buscarId($ubicacionId){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_ubicaciones ";
    $sql .= " WHERE ubicacion_id = ? ";

    //BUSCAR ID
    $ubicacion = $this->app['db']->fetchAssoc($sql,
        array($ubicacionId));

    //RETORNAR LOS REGISTROS DE UNA UBICACIÓN
    return $ubicacion;
  }
  /*
  * BUSCAR UNA UBICACIÓN POR NOMBRE
  */
  public function buscarNombre($ubicacionNombre){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_ubicacion ";
    $sql .= " WHERE ubicacion_nombre = ? ";

    //BUSCAR NOMBRE
    $nombreEncontrado = $this->app['db']->fetchAssoc($sql,
        array($ubicacionNombre));

    //RETORNAR LOS REGISTROS DE UNA ubicacion
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
