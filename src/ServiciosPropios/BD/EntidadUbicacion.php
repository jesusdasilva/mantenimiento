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
  public function buscarId($ubicacion_id){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_ubicaciones ";
    $sql .= " WHERE ubicacion_id = ? ";

    //BUSCAR ID
    $ubicacion = $this->app['db']->fetchAssoc($sql,
        array($ubicacion_id));

    //RETORNAR LOS REGISTROS DE UNA UBICACIÓN
    return $ubicacion;
  }
  /*
  * BUSCAR UNA UBICACIÓN POR NOMBRE
  */
  public function buscarNombre($ubicacion_nombre){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_ubicaciones ";
    $sql .= " WHERE ubicacion_nombre = ? ";

    //BUSCAR NOMBRE
    $nombreEncontrado = $this->app['db']->fetchAssoc($sql,
        array($ubicacion_nombre));

    //RETORNAR LOS REGISTROS DE UNA ubicacion
    return $nombreEncontrado;
  }

  public function Nuevo($registros){

      //GUARDAR NUEVO REGISTRO
      $registrosAfectados = $this->app['db']->insert('mantenimientos_ubicaciones',
          array('ubicacion_nombre'     =>$registros['ubicacion_nombre'],
                'ubicacion_observacion'=>$registros['ubicacion_observacion']));

      //RETORNAR EL NÚMERO DE REGISTROS INSERTADOS
      return $registrosAfectados;
  }
  /*
  * ACTUALIZAR UNA EMPRESA
  */
  public function actualizar($regitros){

    //ACTUALIZAR
    $registrosAfectados = $this->app['db']->update('mantenimientos_ubicaciones',
          array('ubicacion_observacion'=> $regitros['ubicacion_observacion']),
          array('ubicacion_id'         => $regitros['ubicacion_id']));

    //RETORNAR EL NÚMERO DE REGISTROS ATUALIZADOS
    return $registrosAfectados;
  }
  /*
  * ELIMINAR UNA EMPRESA
  */
  public function eliminar($ubicacion_id){

    //ELIMINAR
    $registroEliminado = $this->app['db']->delete('mantenimientos_ubicaciones',
        array('ubicacion_id' => $ubicacion_id));

    //RETORNAR EL NÚMERO DE REGISTROS ELIMINADOS
    return $registroEliminado;
  }

  public function catalogo(){}

}
