<?php

//ENTIDAD UBICACIÓN

namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadUbicacion{

    private $app;

    private $registros = [];
    private $mensaje   = '';

    /*
        CONSTRUCTOR
    */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    /*
        BUSCAR UBICACIÓN
        $app['ubicacion']->buscar(array('campo'=> $valor));
    */
    public function buscar($condicion = array())
    {
        //SQL BASE
        $sql  = " SELECT ubicacion_id, ";
        $sql .= "        ubicacion_nombre, ";
        $sql .= "        ubicacion_observacion ";
        $sql .= " FROM mantenimientos_ubicaciones ";

        if (empty($condicion)) {

            //CAMBIAR LA TABLA
            $sql = str_replace("mantenimientos", "vista", $sql);
            //BUSCAR TODAS LAS GUBICACIONES
            $this->registros = $this->app['db']->fetchAll($sql);

        } else {

            //BUSCAR CON CONDICIÓN
            switch ($condicion) {
                case (isset($condicion['ubicacion_id'])):
                    $sql .= " WHERE ubicacion_id = '".$condicion['ubicacion_id']."'";
                    break;
                case (isset($condicion['ubicacion_nombre'])):
                    $sql .= " WHERE ubicacion_nombre = '".$condicion['ubicacion_nombre']."'";
                    break;
                default:
                  # code...
                  break;
            }

            //BUSCAR CON CONDICIÓN
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
        AGREGAR UNA NUEVA ubicacion
        $app['ubicacion']->nuevo($campo);
    */
    public function nuevo($campos)
    {

        //BUSCAR NOMBRE
        if ($this->buscar(['ubicacion_nombre' => $campos['ubicacion_nombre']])) {

            $this->mensaje = "La Ubicación se encuentra repetida";
            return false;

        } else {

            //GUARDAR NUEVO REGISTRO
            $registrosAfectados = $this->app['db']->insert(
                'mantenimientos_ubicaciones', [
                    'ubicacion_nombre'      => $campos['ubicacion_nombre'],
                    'ubicacion_observacion' => $campos['ubicacion_observacion'],
                  ]
            );

            //VERIFICAR QUE SE AGREGÓ LA UBICACIÓN
            if ($registrosAfectados > 0) {

                $this->mensaje = "La Ubicación fué agregada con éxito";
                return true;

            } else {

                $this->mensaje = "Error al incluir la ubicación";
                return false;

            }
        }
    }
    /*
        ACTUALIZAR UNA UBICACIÓN
        $app['ubicacion']->actualizar($registros),
    */
    public function actualizar($regitros)
    {
        //ACTUALIZAR
        $registrosAfectados = $this->app['db']->update(
            'mantenimientos_ubicaciones', [
                'ubicacion_observacion' => $regitros['ubicacion_observacion'],
            ], [
                'ubicacion_id'=>$regitros['ubicacion_id'],
            ]
        );

        if ($registrosAfectados > 0 ) {

            $this->mensaje = "La Ubicación fué actualizada";
            return true;

        } else {

            $this->mensaje = "La Ubicación no pudo ser actualizada";
            return false;

        }
    }
    /*
        ELIMINAR UNA UBICACIÓN
        $app['ubicacion']->eliminar($id);
    */
    public function eliminar($id)
    {
        //ELIMINAR
        $registroEliminado = $this->app['db']->delete(
            'mantenimientos_ubicaciones', [
                'ubicacion_id' => $id,
            ]
        );

        if ($registroEliminado > 0) {

            $this->mensaje = "Se eliminó con éxito la Ubicación";
            return true;

        } else {

            $this->mensaje = "No se pudo eliminar la Ubicación";
            return false;

        }
    }
    /*
        NÚMERO TOTAL DE UBICACIONES
        $app['ubicacion']->cantidad();
    */
    public function cantidad()
    {
        return ($this->buscar()) ? count($this->registros) : 0;
    }
    /*
        BUSCAR NOMBRE Y TRAER EL ID
        $app['ubicacion']->buscarNombreTraerId($nombre_ubicacion);
    */
    public function buscarNombreTraerId($ubicacion_nombre)
    {
        if ($this->buscar(['ubicacion_nombre' => $nombre])) {

            return true;

        } else {

            $this->mensaje = "El id $ubicacion_nombre no se encuentra en la BD";
            return false;

        }
    }
    /*
        CAMPO ID
        $app['ubicacion']->getId();
    */
    public function getId()
    {
        return $this->registros['ubicacion_id'];
    }
    /*
        GET NOMBRE
        $app['ubicacion']->getNombre();
    */
    public function getNombre()
    {
        return $this->registros['ubicacion_nombre'];
    }
    /*
        GET OBSERVACION
        $app['ubicacion']->getObservacion();
    */
    public function getObservacion()
    {
        return $this->registros['ubicacion_observacion'];
    }
    /*
        GET MENSAJE
        $app['ubicacion']->getMensaje();
    */
    public function getMensaje()
    {
        return $this->mensaje;
    }
    /*
        GET TODAS LAS UBICACIONES
        $app['ubicacion']->getTodas();
    */
    public function getTodas()
    {
        return $this->registros;
    }

}
