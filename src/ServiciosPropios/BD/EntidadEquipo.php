<?php
/*
* ENTIDAD EQUIPO
*/
namespace ServiciosPropios\BD;

use Silex\Application;
use ServiciosPropios\BD\EntidadEquipo;

class EntidadEquipo{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }
 /*
 *CREAR UN NUEVO EQUIPO E INCLUIRLE TODAS SUS ACTIVIDADES EN BLANCO
 */
  public function Nuevo($registros){

    //GUARDAR DATOS DEL EQUIPO
    $registrosAfectados = $this->app['db']->insert('mantenimientos_equipos',
        array('equipo_nombre' => $registros['equipo_nombre'],
              'empresa_id'    => $registros['empresa_id'],
              'gerencia_id'   => $registros['gerencia_id'],
              'ubicacion_id'  => $registros['ubicacion_id']));

    //VERIFICAR QUE SE GUARDÓ EL EQUIPO
    if($registrosAfectados > 0){

      //ELEGIR SISTEMA OPERATIVO
      switch ($registros['equipo_so']) {
        case 'Windows XP 32bits':
          $actividades = $this->actividadesWXP32();
          break;
        case 'Windows XP 64bits':
          $actividades = $this->actividadesWXP64();
          break;
        case 'Windows 7 64bits':
          $actividades = $this->actividadesW7();
          break;
        case 'Linux':
          $actividades = $this->actividadesLinux();
          break;
        case 'Solaris':
          $actividades = $this->actividadesSolaris();
          break;
        default:
          $actividades = '';
          break;
      }

      //BUSCAR EQUIPO POR NOMBRE
      $registros['equipo_id'] = $this->buscarNombreTraerId($registros['equipo_nombre']);

      //INSERTAR LAS ACTIVIDADES
      foreach( $actividades as $actividad){

        //GUARDAR ACTIVIDAD
        $registrosAfectados =$this->app['db']->insert('mantenimientos_checklist',
            array('equipo_id'         => $registros['equipo_id'],
                  'checklist_nombre'  => $actividad,
                  'checklist_so'      => $registros['equipo_so'],
                  'checklist_estatus' => 0));
      }
  }

      //RETORNAR EL NÚMERO DE REGISTROS INSERTADOS
      return $registrosAfectados;
  }
  /*
  *CATÁLOGO DE ACTIVIDADES PARA WINDOWS XP 32 BITS
  */
  private function actividadesWXP32(){
    return array( '1' =>  'Revisión del nombre del equipo.',
                  '2' =>  'Aplicar las políticas de PDVSA',
                  '3' =>  'Revisión del Estado de Hibernación del equipo',
                  '4' =>  'Setear la memoria virtual a la unidad D:',
                  '5' =>  'Tamaño de la memoria Virtual a 10 GB',
                  '6' =>  'Sufijos DNS configurado',
                  '7' =>  'Servidor PLCGUA03 mapeada en unidad G:ppl',
                  '8' =>  'Servidor PLCGUA03 mapeada en unidad I:dataplic',
                  '9' =>  'Programas instalados en la unidad C',
                  '10' => 'Data de usuario en Unidad D',
                  '11' => 'Integridad del Disco Duro',
                  '12' => 'Perfil de usuarios en D:Users',
                  '13' => 'Licencias en Variables de Sistemas',
                  '14' => 'Licencias en Variables de Usuario',
                  '15' => 'Variables de Oracle en el Path del Sistema',
                  '16' => 'Instalar Microsoft Framenwork NET 4',
                  '17' => 'Actualizar el Framenwork NET 4',
                  '18' => 'Revisar el estado del Antivirus');
  }

  private function actividadesWXP64(){
    return array( 'prueba1');
  }

  private function actividadesW7(){
    return array( 'prueba2');
  }

  private function actividadesLinux(){
    return array( 'prueba3');
  }

  private function actividadesSun(){
    return array( 'prueba4');
  }
  /*
  * BUSCAR UN EQUIPO POR NOMBRE
  */
  public function buscarNombre($equipo_nombre){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM mantenimientos_equipos ";
    $sql .= " WHERE equipo_nombre = ? ";

    //BUSCAR NOMBRE
    $nombreEncontrado = $this->app['db']->fetchAssoc($sql,
        array($equipo_nombre));

    //RETORNAR LOS REGISTROS DE UN EQUIPO
    return $nombreEncontrado;
  }
  /*
  * BUSCAR UN EQUIPO POR NOMBRE  Y TRAER EL ID
  */
  private function buscarNombreTraerId($equipo_nombre){

    $registros = $this->buscarNombre($equipo_nombre);

    return $registros['equipo_id'];
  }
  /*
  * LISTADO DE TODOS LOS EQUIPOS
  */
   public function listar(){

     //SQL
     $sql  = " SELECT equipo_id,equipo_nombre,empresa_nombre,checklist_so ";
     $sql .= " FROM vista_equipos ";
     $sql .= " ORDER BY equipo_nombre ";

     //BUSCAR TODAS LOS EQUIPOS
     $equipos = $this->app['db']->fetchAll($sql);

     //RETORNAR LOS REGISTROS DE TODAS LAS EMPRESAS
     return $equipos;
   }



}
