<?php
/*
 * ENTIDAD EMPRESA
 */
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadEmpresa{

  private $app;

  private $empresa = array();
  private $mensaje = '';
  private $error = FALSE;

  public function __construct(Application $app){
    $this->app = $app;
  }
  /*
  *NÚMERO TOTAL DE EMPRESA
  */
  public function cantidad(){

    return count($this->buscar());

  }
 /*
 * BUSCAR UNA EMPRESA POR ID
 */
  public function buscarId($id){

    try{

      //SQL
      $sql  = " SELECT empresa_id          AS id, ";
      $sql .= "        empresa_nombre      AS nombre, ";
      $sql .= "        empresa_observacion AS observacion ";
      $sql .= " FROM mantenimientos_empresas ";
      $sql .= " WHERE empresa_id = ? ";

      //BUSCAR
      $this->empresa = $this->app['db']->fetchAssoc($sql,
          array($id));

      return TRUE;

    }catch(Exception $e){

      //MENSAJE DE ERROR
      $this->message = $e->getMessage();

      return FALSE;
    }

  }
  /*
  *BUSCAR NOMBRE Y TRAER ID
  */
  public function buscarNombreTaerId($empresa_nombre){

    $registros = $this->buscarNombre($empresa_nombre);

    return $registros['empresa_id'];

  }

  public function Nuevo($registros){

    try{

      //BUSCAR NOMBRE
      if($this->buscar(array('nombre' =>$registros['nombre']))){
        if(isset($this->empresa['nombre'])){

          //GUARDAR NUEVO REGISTRO
          $registrosAfectados = $this->app['db']->insert('mantenimientos_empresas',
              array('empresa_nombre'     =>$registros['empresa_nombre'],
                    'empresa_observacion'=>$registros['empresa_observacion']));

          $this->mensaje = 'La Empresa fué agregada con éxito';

          return TRUE;

        }else{
          throw new Exception('El nombre de la Empresa se encuentra repetido');
        }
      }else{
        throw new Exception('Error al buscar el nombre');
      }

    }catch(Exception $e){
      $this->mensaje = $e->getMessage();
      return FALSE;
    }

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
  public function eliminar($id){

    try{

      //ELIMINAR
      $registroEliminado = $this->app['db']->delete('mantenimientos_empresas',
          array('empresa_id' => $id));

      if($registroEliminado > 0){

         //MENSAJE
         $this->mensaje = 'Se eliminó con éxito la Empresa';
         return TRUE;

      }else{

        //ERROR
        throw new Exception('No se pudo eliminar la Empresa');

      }
    }catch(Exception $e){

      $this->mensaje = $e->getMensaje();
      return FALSE;

    }

  }
  /*
  *BUSCAR $app['empresa']->buscar(array('id'=> $id));
  */
  public function buscar($condicion = array()){
    try{

      //SQL BASE
      $sql  = " SELECT empresa_id          AS id, ";
      $sql .= "        empresa_nombre      AS nombre, ";
      $sql .= "        empresa_observacion AS observacion ";
      $sql .= " FROM mantenimientos_empresas ";

      if(empty($condicion)){

        //CAMBIAR LA TABLA
        $sql = str_replace('mantenimientos','vista',$sql);
        //BUSCAR TODAS LAS EMPRESAS
        $this->empresas = $this->app['db']->fetchAll($sql);

      }else{

        switch ($condicion) {
          case (isset($condicion['id'])):{
            $sql .= " WHERE empresa_id = ".$condicion['id'];
            break;
          }
          case (isset($condicion['nombre'])):{
            $sql .= " WHERE empresa_nombre =".$condicion['nombre'];
            break;
          }
          default:
            # code...
            break;
      }

      //BUSCAR
      $this->empresa = $this->app['db']->fetchAssoc($sql);
      return TRUE;

    }

    }catch(Exception $e){

      //MENSAJE DE ERROR
      $this->message = $e->getMessage();
      return FALSE;
    }
  }
  /*
  *CAMPO ID
  */
  public function getId(){
    return $this->empresa['id'];
  }
  /*
  *GET NOMBRE
  */
  public function getNombre(){
    return $this->empresa['nombre'];
  }
  /*
  *GET OBSERVACION
  */
  public function getObservacion(){
    return $this->empresa['observacion'];
  }
  /*
  *GET MENSAJE
  */
  public function getMensaje(){
    return $this->mensaje;
  }
  /*
  *GET TODAS LAS EMPRESAS
  */
  public function getTodas(){
    return $this->empresas;
  }
  public function catalogo(){}

}
