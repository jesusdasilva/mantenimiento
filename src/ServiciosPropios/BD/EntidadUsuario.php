<?php
/*
* ENTIDAD USUARIO
*/
namespace ServiciosPropios\BD;

use Silex\Application;

class EntidadUsuario{

  private $app;

  public function __construct(Application $app){
    $this->app = $app;
  }
  /*
  *VERIFICAR USUARIO CON EL INDICADOR Y LA CLAVE
  */
  public function verificar($registros){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM vista_usuarios_perfiles ";
    $sql .= " WHERE usuario_indicador = ? AND  usuario_clave = ?";

    //BUSCAR
    $usuarioValido = $this->app['db']->fetchAssoc($sql,
        array($registros['usuario_indicador'],
              md5($registros['usuario_clave'])));

    return $usuarioValido;
  }
  /*
  * LISTADO DE TODO LOS USUARIOS
  */
  public function listar(){

    //SQL
    $sql  = " SELECT * ";
    $sql .= " FROM vista_usuarios_perfiles ";
    $sql .= " ORDER BY usuario_nombre ";

    //BUSCAR
    $usuarios = $this->app['db']->fetchAll($sql);

    //RETORNAR LOS REGISTROS
    return $usuarios;
  }
  /*
  * BUSCAR UN USUARIO POR ID
  */
   public function buscarId($usuarioId){

     //SQL
     $sql  = "SELECT * ";
     $sql .= " FROM usuarios_datos ";
     $sql .= " WHERE usuario_id = ? ";

     //BUSCAR USUARIO POR ID
     $usuarios = $this->app['db']->fetchAssoc($sql,
        array($usuarioId));

     //RETORNAR LOS REGISTROS DE UN USUARIO
     return $usuarios;
   }
   /*
   *BUSCAR UN USUARIO POR INDICADOR
   */
   public function buscarIndicador($usuarioIndicador){

     //VERIFICAR QUE EL INDICADOR NO ESTÉ REPETIDO
     $sql  = " SELECT usuario_indicador ";
     $sql .= " FROM usuarios_datos ";
     $sql .= " WHERE usuario_indicador = ? ";

     $indicadorEncontrado = $this->app['db']->fetchAssoc($sql,
        array($usuarioIndicador));

     return $indicadorEncontrado;

   }
   /*
   *NUEVO USUARIO
   */
     public function Nuevo($registros){

        //INSERTAR
        $registrosAfectados = $this->app['db']->insert('usuarios_datos',
            array('perfil_id'           => $registros['perfil_id'],
                  'usuario_nombre'      => mb_strtoupper($registros['usuario_nombre'],'utf-8'),
                  'usuario_indicador'   => $registros['usuario_indicador'],
                  'usuario_clave'       => md5($registros['usuario_clave']),
                  'usuario_observacion' => $registros['usuario_observacion']));

         //RETORNAR EL NÚMERO DE REGISTROS INSERTADOS
         return $registrosAfectados;
     }
   /*
   * ACTUALIZAR USUARIO
   */
   public function actualizar($registros){

     //ACTUALIZAR
     if ($registros['usuario_clave']!='123456'){//CLAVE POR DEFECTO

       //ACTUALIZAR Y CAMBIAR LA CLAVE
       $registrosAfectados = $this->app['db']->update('usuarios_datos',
          array('perfil_id'           => $registros['perfil_id'],
                'usuario_nombre'      => mb_strtoupper($registros['usuario_nombre'],'utf-8'),
                'usuario_clave'       => md5($registros['usuario_clave']),
                'usuario_observacion' => $registros['usuario_observacion']),
          array('usuario_id'=>$registros['usuario_id']));

     }else{

       //ACTUALIZAR SIN CAMBIAR LA CLAVE
       $registrosAfectados = $this->app['db']->update('usuarios_datos',
          array('perfil_id'           => $registros['perfil_id'],
                'usuario_nombre'      => mb_strtoupper($registros['usuario_nombre'],'utf-8'),
                'usuario_observacion' => $registros['usuario_observacion']),
          array('usuario_id'=>$registros['usuario_id']));

     }

     //RETORNAR EL NÚMERO DE REGISTROS ATUALIZADOS
     return $registrosAfectados;
   }
   /*
   * ELIMINAR UN USUAERIO
   */
   public function eliminar($usuarioId){

     //ELIMINAR
     $registroEliminado = $this->app['db']->delete('usuarios_datos',
         array('usuario_id' => $usuarioId));

     //RETORNAR EL NÚMERO DE REGISTROS ELIMINADOS
     return $registroEliminado;
   }
}
