<?php

require_once('conexion.php');

class actividad extends Conexion
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function mostrar_actividades(){
        $instruccion="CALL sp_mostrar_actividades()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado){
            echo "FAllo al consultar las actividades";
        }
        else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }

    }
}
