<?php
/*
* ENTIDAD GERENCIA
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadGerencia{

  private $app;

  private $registros = [];
  private $mensaje = '';

  public function __construct(Application $app){
    $this->app = $app;
  }
  /*
  * BUSCAR GERENCIA
  * $app['gerencia']->buscar(array('campo'=> $valor));
  */
  public function buscar($condicion = array()){

      //SQL BASE
      $sql  = " SELECT gerencia_id, ";
      $sql .= "        gerencia_nombre, ";
      $sql .= "        gerencia_observacion ";
      $sql .= " FROM mantenimientos_gerencias ";

      if(empty($condicion)){

        //CAMBIAR LA TABLA
        $sql = str_replace('mantenimientos','vista',$sql);
        //BUSCAR TODAS LAS gerenciaS
        $this->registros = $this->app['db']->fetchAll($sql);

      }else{

        switch ($condicion) {
          case (isset($condicion['gerencia_id'])):{
            $sql .= " WHERE gerencia_id = '".$condicion['gerencia_id']."'";
            break;
          }
          case (isset($condicion['gerencia_nombre'])):{
            $sql .= " WHERE gerencia_nombre = '".$condicion['gerencia_nombre']."'";
            break;
          }
          default:
            # code...
            break;
        }

      //BUSCAR
      $this->registros = $this->app['db']->fetchAssoc($sql);

    }

    return (empty($this->registros)) ? FALSE : TRUE;

  }
  /*
  * AGREGAR UNA NUEVA GERENCIA
  * $app['gerencia']->nuevo($campo);
  */
  public function nuevo($campos){

    //BUSCAR NOMBRE
    if($this->buscar(['gerencia_nombre'=>$campos['gerencia_nombre']])){

      $this->mensaje = 'La Gerencia se encuentra repetida';

      return FALSE;

    }else{

      //GUARDAR NUEVO REGISTRO
      $registrosAfectados = $this->app['db']->insert('mantenimientos_gerencias',
          ['gerencia_nombre'     =>$campos['gerencia_nombre'],
           'gerencia_observacion'=>$campos['gerencia_observacion']]);

      //VERIFICAR QUE SE AGREGÓ LA gerencia
      if($registrosAfectados > 0){
        $this->mensaje = 'La Gerencia fué agregada con éxito';
        return TRUE;
      }else{
        $this->mensaje ='Error al incluir la Gerencia';
        return FALSE;
      }
    }
  }
  /*
  * ACTUALIZAR UNA gerencia
  * $app['gerencia']->actualizar($registros),
  */
  public function actualizar($regitros){

    //ACTUALIZAR
    $registrosAfectados = $this->app['db']->update('mantenimientos_gerencias',
          ['gerencia_observacion'=>$regitros['gerencia_observacion']],
          ['gerencia_id'=>$regitros['gerencia_id']]);

    if($registrosAfectados > 0 ){
      $this->mensaje = 'La gerencia fué actualizada';
      return TRUE;
    }else{
      $this->mensaje = 'La gerencia no pudo ser actualizada';
      return FALSE;
    }
  }
  /*
  * ELIMINAR UNA gerencia
  * $app['gerencia']->eliminar($id);
  */
  public function eliminar($id){

    //ELIMINAR
    $registroEliminado = $this->app['db']->delete('mantenimientos_gerencias',
        ['gerencia_id'=>$id]);

    if($registroEliminado > 0){
       $this->mensaje = 'Se eliminó con éxito la Gerencia';
       return TRUE;
    }else{
      $this->mensaje = 'No se pudo eliminar la Gerencia';
      return FALSE;
    }

  }
  /*
  * NÚMERO TOTAL DE GERENCIAS
  * $app['gerencia']->cantidad();
  */
  public function cantidad(){
    return ($this->buscar()) ? count($this->registros) : 0;
  }
  /*
  * BUSCAR NOMBRE Y TRAER EL ID
  * $app['gerencia']->buscarNombreTraerId($nombre_gerencia);
  */
  public function buscarNombreTraerId($gerencia_nombre){

    if($this->buscar(['gerencia_nombre'=>$nombre])){
        return TRUE;
    }else{
      $this->mensaje = "El id $gerencia_nombre no se encuentra en la BD";
      return FALSE;
    }

  }
  /*
  * CAMPO ID
  * $app['gerencia']->getId();
  */
  public function getId(){
    return $this->registros['gerencia_id'];
  }
  /*
  * GET NOMBRE
  * $app['gerencia']->getNombre();
  */
  public function getNombre(){
    return $this->registros['gerencia_nombre'];
  }
  /*
  * GET OBSERVACION
  * $app['gerencia']->getObservacion();
  */
  public function getObservacion(){
    return $this->registros['gerencia_observacion'];
  }
  /*
  * GET MENSAJE
  * $app['gerencia']->getMensaje();
  */
  public function getMensaje(){
    return $this->mensaje;
  }
  /*
  * GET TODAS LAS GERENCIAS
  * $app['gerencia']->getTodas();
  */
  public function getTodas(){
    return $this->registros;
  }

}
