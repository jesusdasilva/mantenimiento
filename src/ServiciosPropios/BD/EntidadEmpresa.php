<?php
/*
 * ENTIDAD EMPRESA
 */
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadEmpresa{

  private $app;

  private $registros = array();
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
  public function buscarNombreTaerId2($empresa_nombre){

    $registros = $this->buscarNombre($empresa_nombre);

    return $registros['empresa_id'];

  }
  /*
  * BUSCAR NOMBRE Y TRAER EL ID
  * $app['empresa']->buscarNombreTraerId($nombre_empresa);
  */
  public function buscarNombreTraerId($empresa_nombre){

    if($this->buscar(array('empresa_nombre' => $nombre))){
        return TRUE;
    }else{
      $this->mensaje = "El id $empresa_nombre no se encuentra en la BD",
      return FALSE;

    }

  }
  /*
  * AGREGAR UNA NUEVA EMPRESA
  * $app['empresa']->nuevo($campo);
  */
  public function nuevo($campos){

    //BUSCAR NOMBRE
    if($this->buscar(array('empresa_nombre' =>$campos['empresa_nombre']))){

      $this->mensaje = 'La Empresa se encuentra repetida';

      return FALSE;

    }else{

      //GUARDAR NUEVO REGISTRO
      $registrosAfectados = $this->app['db']->insert('mantenimientos_empresas',
          array('empresa_nombre'     =>$campos['empresa_nombre'],
                'empresa_observacion'=>$campos['empresa_observacion']));

      //VERIFICAR QUE SE AGREGÓ LA EMPRESA
      if($registrosAfectados > 0){
        $this->mensaje = 'La Empresa fué agregada con éxito';
        return TRUE;
      }else{
        $this->mensaje ='Error  al incluir la empresa';
        return FALSE;
      }
    }
  }
  /*
  * ACTUALIZAR UNA EMPRESA
  * $app['empresa']->actualizar($registros),
  */
  public function actualizar($regitros){

    //ACTUALIZAR
    $registrosAfectados = $this->app['db']->update('mantenimientos_empresas',
          array('empresa_observacion'=> $regitros['empresa_observacion']),
          array('empresa_id'=>$regitros['empresa_id']));

    if($registrosAfectados > 0 ){

      $this->mensaje = 'La Empresa fué actualizada';
      return TRUE;
    }else{
      $this->mensaje = 'La Empresa no pudo ser actualizada';
      return FALSE;
    }
  }
  /*
  * ELIMINAR UNA EMPRESA
  * $app['empresa']->eliminar($id);
  */
  public function eliminar($id){

    //ELIMINAR
    $registroEliminado = $this->app['db']->delete('mantenimientos_empresas',
        array('empresa_id' => $id));

    if($registroEliminado > 0){

       $this->mensaje = 'Se eliminó con éxito la Empresa';
       return TRUE;

    }else{

      $this->mensaje = 'No se pudo eliminar la Empresa';
      return FALSE;
    }

  }
  /*
  * BUSCAR EMPRESA
  * $app['empresa']->buscar(array('campo'=> $valor));
  */
  public function buscar($condicion = array()){

      //SQL BASE
      $sql  = " SELECT empresa_id, ";
      $sql .= "        empresa_nombre, ";
      $sql .= "        empresa_observacion ";
      $sql .= " FROM mantenimientos_empresas ";

      if(empty($condicion)){

        //CAMBIAR LA TABLA
        $sql = str_replace('mantenimientos','vista',$sql);
        //BUSCAR TODAS LAS EMPRESAS
        $this->registros = $this->app['db']->fetchAll($sql);

      }else{

        switch ($condicion) {
          case (isset($condicion['empresa_id'])):{
            $sql .= " WHERE empresa_id = '".$condicion['empresa_id']."'";
            break;
          }
          case (isset($condicion['empresa_nombre'])):{
            $sql .= " WHERE empresa_nombre = '".$condicion['empresa_nombre']."'";
            break;
          }
          default:
            # code...
            break;
        }

      //BUSCAR
      $this->registros = $this->app['db']->fetchAssoc($sql);

    }

    if(empty($this->registros)) return FALSE;
    else return TRUE;

  }
  /*
  *CAMPO ID
  */
  public function getId(){
    return $this->registros['empresa_id'];
  }
  /*
  *GET NOMBRE
  */
  public function getNombre(){
    return $this->registros['empresa_nombre'];
  }
  /*
  *GET OBSERVACION
  */
  public function getObservacion(){
    return $this->registros['empresa_observacion'];
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
    return $this->registros;
  }

}
