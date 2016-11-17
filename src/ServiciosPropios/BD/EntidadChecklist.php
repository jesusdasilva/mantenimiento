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

              $this->mensaje = "La Empresa fué agregada con éxito";
              return TRUE;

          } else {

              $this->mensaje = "Error al incluir la Empresa";
              return FALSE;

          }

      }
    }
}
