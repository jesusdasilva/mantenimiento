<?php

//ENTIDAD EQUIPO

namespace ServiciosPropios\BD;

use Silex\Application;
use ServiciosPropios\BD\EntidadEquipo;
use ServiciosPropios\BD\EntidadEmpresa;
use ServiciosPropios\BD\EntidadGerencia;
use ServiciosPropios\BD\EntidadUbicacion;
use ServiciosPropios\BD\EntidadChecklist;


class EntidadEquipo{

    private $app;

    private $registros = [];
    private $mensaje   = "";

    /*
        CONTRUCTOR
    */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    /*
        BUSCAR EQUIPO
        $app['equipo']->buscar('condicion' => $valor);
    */
    public function buscar($condicion = [])
    {

        //SQL BASE
        $sql  = " SELECT * ";
        $sql .= " FROM mantenimientos_equipos ";

        if (empty($condicion)) {

            //CAMBIAR LA TABLA
            $sql = str_replace("mantenimientos", "vista", $sql);
            //BUSCAR TODOS LOS EQUIPOS
            $this->registros = $this->app['db']->fetchAll($sql);

        } else {

            switch ($condicion) {
                case (isset($condicion['equipo_id'])):
                    $sql .= " WHERE equipo_id = '".$condicion['equipo_id']."'";
                    break;
                case (isset($condicion['equipo_nombre'])):
                    $sql .= " WHERE equipo_nombre = '".$condicion['equipo_nombre']."'";
                    break;
                default:
                    # code...
                    break;
            }

            //BUSCAR
            $this->registros = $this->app['db']->fetchAssoc($sql);

        }

        if (empty($this->registros)) {

            $this->mensaje = "No hay registro que mostrar";
            return false;

        } else {
            return true;
        }

    }
    /*
        NUEVO EQUIPO
        $app['equipo']->nuevo($campos);
    */
    public function nuevo($campos)
    {
        //VERIFICAR SI EL NOMBRE DE EQUIPO ESTÁ REPETIDO
        if ($this->buscar(['equipo_nombre' => $campos['equipo_nombre']])) {

          $this->mensaje = "El Equipo se encuentra repetida";
          return false;

        } else {

            if (!$this->app['empresa']->buscarNombreTraerId('NINGUNA')) {
                $this->mensaje = $this->app['empresa']->getMensaje();
                return false;
            } elseif (!$this->app['gerencia']->buscarNombreTraerId('NINGUNA')) {
                $this->mensaje = $this->app['gerencia']->getMensaje();
                return false;
            } elseif (!$this->app['ubicacion']->buscarNombreTraerId('NINGUNA')) {
                $this->mensaje = $this->app['ubicacion']->getMensaje();
                return false;
            } else {

                //GUARDAR NUEVO REGISTRO EN TABLA mantenimientos_equipos
                $registrosAfectados = $this->app['db']->insert(
                    'mantenimientos_equipos', [
                        'equipo_nombre' => $campos['equipo_nombre'],
                        'empresa_id'    => $this->app['empresa']->getId(),
                        'gerencia_id'   => $this->app['gerencia']->getId(),
                        'ubicacion_id'  => $this->app['ubicacion']->getId(),
                      ]
                );

                //VERIFICAR QUE SE GUARDÓ EL EQUIPO
                if ($registrosAfectados > 0) {

                  //BUSCAR ID DE EQUIPO AGREGADO
                  if ($this->buscar(['equipo_nombre' => $campos['equipo_nombre']])) {

                    if ($this->app['checklist']->agregarTodasActividades($this->registros['equipo_id'], $campos['checklist_so'])) {
                        $this->mensaje = "Las actividades fueron agregadas";
                        return true;
                    } else {
                      $this->mensaje = "Error al guardar las actividades";
                      return false;

                    }

                  } else {
                    $this->mensaje = "Error al buscar el Id";
                    return false;
                  }

                }

            }


        }
    }
    /*
        NÚMERO TOTAL DE EQUIPOS
        $app['equipo']->cantidad();
    */
    public function cantidad()
    {
        return ($this->buscar()) ? count($this->registros) : 0;
    }
    /*
        GET MENSAJE
        $app['equipo']->getMensaje();
    */
    public function getMensaje()
    {
        return $this->mensaje;
    }
    /*
        GET TODAS LAS GERENCIAS
        $app['equipo']->getTodas();
    */
    public function getTodas()
    {
        return $this->registros;
    }

}
