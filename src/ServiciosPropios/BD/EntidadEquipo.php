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
        GET TODOS LOS REGISTROS EQUIPOS
        $app['equipo']->getTodas();
    */
    public function getTodas()
    {
        return $this->registros;
    }
    /*
        GET ID DEL EQUIPO
        $app['equipo']->getId();
    */
    public function getId()
    {
        return $this->registros['equipo_id'];
    }
    /*
        GET NOMBRE DEL  EQUIPO
        $app['equipo']->getNombre();
    */
    public function getNombre()
    {
        return $this->registros['equipo_nombre'];
    }
    /*
        GET ETIQUETA PDVSA DEL EQUIPOS
        $app['equipo']->getEtiqueta();
    */
    public function getEtiqueta()
    {
        return $this->registros['equipo_Etiqueta'];
    }
    /*
        GET ID DE LA UBICACIÓN
        $app['equipo']->getUbicacionId();
    */
    public function getUbicacionId()
    {
        return $this->registros['ubicacion_id'];
    }
    /*
        GET NOMBRE DEL USUARIO
        $app['equipo']->getUsuarioNombre();
    */
    public function getUsuarioNombre()
    {
        return $this->registros['equipo_usuario_nombre'];
    }
    /*
        GET INDICADOR DEL USUARIO DEL EQUIPO
        $app['equipo']->getUsuarioIndicador();
    */
    public function getUsuarioIndicador()
    {
        return $this->registros['equipo_usuario_indicador'];
    }
    /*
        GET ID DE LA EMPRESA
        $app['equipo']->getEmpresaId();
    */
    public function getEmpresaId()
    {
        return $this->registros['empresa_id'];
    }
    /*
        GET ID DE LA GERENCIA
        $app['equipo']->getGerenciaId();
    */
    public function getGerenciaId()
    {
        return $this->registros['gerencia_id'];
    }
    /*
        GET OBSERVACIÓN
        $app['equipo']->getObservacion();
    */
    public function getObservacion()
    {
        return $this->registros['equipo_observacion'];
    }
}
