<?php
/*
* ENTIDAD EQUIPO
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadEquipo{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }

  public function Nuevo($equipo,$sO){

    switch ($sO) {
      case 'Windows XP 32bits':
        $registros = $actividadesWXP32();
        break;
      case 'Windows XP 64bits':
        $registros = $actividadesWXP64();
        break;
      case 'Windows 7 64bits':
        $registros = $actividadesW7();
        break;
      case 'Linux':
        $registros = $actividadesLinux();
        break;
      case 'Solaris':
        $registros = $actividadesSolaris();
        break;
      default:
        # code...
        break;
    }


      //GUARDAR NUEVO REGISTRO
      $registrosAfectados = $this->app['db']->insert('mantenimientos_gerencias',
          array('gerencia_nombre'     =>$registros['gerencia_nombre'],
                'gerencia_observacion'=>$registros['gerencia_observacion']));

      //RETORNAR EL NÚMERO DE REGISTROS INSERTADOS
      return $registrosAfectados;
  }

  private function actividadesWXP32(){
    return array( 'Revisión del nombre del equipo.',
                  'Aplicar las políticas de PDVSA',
                  'Revisión del Estado de Hibernación del equipo',
                  'Setear la memoria virtual a la unidad D:',
                  'Tamaño de la memoria Virtual a 10 GB'

    )
  }
}
