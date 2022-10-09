<?php

require_once('conexion.php');

class Nota extends Conexion
{
    private $id;
    private $titulo;
    private $fechas;
    private $hora;
    private $ubicacion;
    private $correo;
    private $repetir;
    private $tiempo_repetir_horas;
    private $actividad;


    public function __construct()
    {
        parent::__construct();
    }

    public function mostrar_notas()
    {
        $notas = [];
        $query = "CALL sp_mostrar_nota()";
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        $resp = $stmt->get_result();


        while ($nota = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($notas, $nota);
            //print_r($nota);
        }
        return $notas;
    }

    public function eliminar_nota($id)
    {
        $query = "CALL sp_eliminar_nota(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt;
    }
}
