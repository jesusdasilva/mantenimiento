<?php

//ENTIDAD EMPRESA

namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadEmpresa
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
        BUSCAR EMPRESA
        $app['empresa']->buscar(['campo'=>$valor]);
    */
    public function buscar($condicion = [])
    {
        //SQL BASE
        $sql  = " SELECT empresa_id, ";
        $sql .= "        empresa_nombre, ";
        $sql .= "        empresa_observacion ";
        $sql .= " FROM mantenimientos_empresas ";

        if (empty($condicion)) {

            //CAMBIAR LA TABLA
            $sql = str_replace("mantenimientos", "vista", $sql);
            //BUSCAR
            $this->registros = $this->app['db']->fetchAll($sql);

        } else {

            //BUSCAR CON CONDICIÓN
            switch ($condicion) {
                case (isset($condicion['excluir_nombre'])):{
                    //CAMBIAR LA TABLA
                    $sql = str_replace("mantenimientos", "vista", $sql);
                    //CONDICIÓN
                    $sql .= " WHERE empresa_nombre != '".$condicion['excluir_nombre']."'";
                    //BUSCAR
                    $this->registros = $this->app['db']->fetchAll($sql);
                    break;
                }
                case (isset($condicion['empresa_id'])):{
                    //CONDICIÓN
                    $sql .= " WHERE empresa_id = '".$condicion['empresa_id']."'";
                    //BUSCAR
                    $this->registros = $this->app['db']->fetchAssoc($sql);
                    break;
                }
                case (isset($condicion['empresa_nombre'])):{
                    //CONDICIÓN
                    $sql .= " WHERE empresa_nombre = '".$condicion['empresa_nombre']."'";
                    //BUSCAR
                    $this->registros = $this->app['db']->fetchAssoc($sql);
                    break;
                }
                default:
                    # code...
                    break;
            }

        }

        if (empty($this->registros)) {

            $this->mensaje = "No hay registro que mostrar";
            return false;

        } else {
            return true;
        }

    }
    /*
        AGREGAR UNA NUEVA EMPRESA
        $app['empresa']->nuevo($campo);
    */
    public function nuevo($campos)
    {
        //BUSCAR NOMBRE
        if ($this->buscar(['empresa_nombre' => $campos['empresa_nombre']])) {

            $this->mensaje = "La Empresa se encuentra repetida";
            return FALSE;

        } else {

            //GUARDAR NUEVO REGISTRO
            $registrosAfectados = $this->app['db']->insert(
                'mantenimientos_empresas', [
                    'empresa_nombre'      => $campos['empresa_nombre'],
                    'empresa_observacion' => $campos['empresa_observacion'],
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
    /*
        ACTUALIZAR UNA EMPRESA
        $app['empresa']->actualizar($registros),
    */
    public function actualizar($regitros)
    {
        //ACTUALIZAR
        $registrosAfectados = $this->app['db']->update(
            'mantenimientos_empresas', [
                'empresa_observacion' => $regitros['empresa_observacion'],
            ], [
                'empresa_id' => $regitros['empresa_id'],
            ]
        );

        if ($registrosAfectados > 0 ) {

            $this->mensaje = "La Empresa fué actualizada";
            return TRUE;

        } else {

            $this->mensaje = "La Empresa no pudo ser actualizada";
            return FALSE;

        }
    }
    /*
        ELIMINAR UNA EMPRESA
        $app['empresa']->eliminar($id);
    */
    public function eliminar($id)
    {
        //ELIMINAR
        $registroEliminado = $this->app['db']->delete(
            'mantenimientos_empresas', [
                'empresa_id'=>$id,
            ]
        );

        if ($registroEliminado > 0) {

            $this->mensaje = "Se eliminó con éxito la Empresa";
            return TRUE;

        } else {

            $this->mensaje = "No se pudo eliminar la Empresa";
            return FALSE;

        }
    }
    /*
        NÚMERO TOTAL DE EMPRESA
        $app['empresa']->cantidad();
    */
    public function cantidad()
    {
        return ($this->buscar()) ? count($this->registros) : 0;
    }
    /*
        BUSCAR NOMBRE Y TRAER EL ID
        $app['empresa']->buscarNombreTraerId($nombre_empresa);
    */
    public function buscarNombreTraerId($empresa_nombre)
    {
        if ($this->buscar(['empresa_nombre' => $empresa_nombre])) {

            return TRUE;

        } else {

            $this->mensaje = "El id $empresa_nombre no se encuentra en la BD";
            return FALSE;

        }
    }
    /*
        CAMPO ID
        $app['empresa']->getId();
    */
    public function getId()
    {
        return $this->registros['empresa_id'];
    }
    /*
       GET NOMBRE
       $app['empresa']->getNombre();
    */
    public function getNombre()
    {
        return $this->registros['empresa_nombre'];
    }
    /*
        GET OBSERVACION
        $app['empresa']->getObservacion();
    */
    public function getObservacion()
    {
        return $this->registros['empresa_observacion'];
    }
    /*
        GET MENSAJE
        $app['empresa']->getMensaje();
    */
    public function getMensaje()
    {
        return $this->mensaje;
    }
    /*
        GET TODAS LAS EMPRESAS
        $app['empresa']->getTodas();
    */
    public function getTodas()
    {
        return $this->registros;
    }
}
