<?php

//ENTIDAD EMPRESA

namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadChecklist
{

    private $app;

    private $registros = [];
    private $mensaje   = '';

    /*
        CONTRUCTOR
    */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    /*
        AGREGAR LAS ACTIVIDADES A LA TABALA CHECKLIST
        $app['checklist']->nuevo($campos);
    */
    public function nuevo($campos)
    {

        //GUARDAR ACTIVIDAD
        $registrosAfectados = $this->app['db']->nuevo(
            'mantenimientos_checklist',[
                'equipo_id'         => $campos['equipos_id'],
                'cheacklist_nombre' => $campos['checklist_nombre'],
                'checklis_so'       => $campos['checklist_so'],
                'checklist_estatus' => 0,
            ]
        );

          //VERIFICAR QUE SE AGREGÓ LA EMPRESA
          if ($registrosAfectados > 0) {

              $this->mensaje = "La actividad fué agregada con éxito";
              return TRUE;

          } else {

              $this->mensaje = "Error al incluir la Actividad";
              return FALSE;

          }

      }
      /*
          AGREGAR TODAS LAS ACTIVIDADES A LA TABLA CHECKLIST
          $app['checklist']->agregarTodasActividades($equipo_id, $checklis_so);
      */
      public function agregarTodasActividades($equipo_id, $checklis_so)
      {

          $actividades = $this->generarActividades($checklis_so);

          foreach ($actividades as $actividad) {

            $campos = [
                'equipo_id'         => $equipos_id,
                'cheacklist_nombre' => $activida;,
                'checklis_so'       => $checklist_so,
                'checklist_estatus' => 0,

            ];
            //AREGAR LAS ACTIVIDADES A LA TABLA CHECKLIST
            if (!$this->nuevo($campos)) {
                return false;
            }

          }
          return true,
      }
      /*
          ACTIVIDADES
      */
      private function generarActividades($checklist_so)
      {

          //ELEGIR SISTEMA OPERATIVO Y CARGAR LAS ACTIVIDADES
          switch ($checklist_so) {
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

      }

    }
    /*
        CATÁLOGO DE ACTIVIDADES PARA WINDOWS XP 32 BITS
    */
    private function actividadesWXP32()
    {
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
    /*
        CATÁLOGO DE ACTIVIDADES PARA WINDOWS XP 64 BITS
    */
    private function actividadesWXP64(){
        return array( 'prueba1');
    }
    /*
        CATÁLOGO DE ACTIVIDADES PARA WINDOWS 7
    */
    private function actividadesW7(){
        return array( 'prueba2');
    }
    /*
        CATÁLOGO DE ACTIVIDADES PARA LINUX
    */
    private function actividadesLinux(){
        return array( 'prueba3');
    }
    /*
        CATÁLOGO DE ACTIVIDADES PARA SUN
    */
    private function actividadesSun(){
        return array( 'prueba4');
    }

}
