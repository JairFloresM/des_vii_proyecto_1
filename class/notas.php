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

    public function agregar_nota($titulo, $fecha, $hora, $ubicacion, $correo, $repetir, $tiempo_repetir, $actividad)
    {
        $query = "CALL sp_crear_nota(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('sssssisi', $titulo, $fecha, $hora, $ubicacion, $correo, $repetir, $tiempo_repetir, $actividad);
        $stmt->execute();

        return $stmt;
    }



    //No me funciono el filtrar, asique me invente una cochinada
    public function filtrar_nota($filtro, $dato)
    {
        $notas = [];
        $query = "SELECT n.id, n.titulo, n.fecha, n.ubicacion, n.correo, n.repetir, n.tiempo_repetir_hora, a.descripcion FROM notas n
                  INNER JOIN actividades a ON n.id_actividad = a.id";

        if ($filtro == "descripcion")
            $query .= " WHERE descripcion = ?";
        else if ($filtro == "day")
            $query .= " WHERE CAST(day(n.fecha) AS CHAR) = ?";
        else if ($filtro == "month")
            $query .= " WHERE CAST(month(n.fecha) AS CHAR) = ?";
        else if ($filtro == "year")
            $query .= " WHERE CAST(year(n.fecha) AS CHAR) = ?";
        else if ($filtro == "week")
            $query .= " WHERE CAST(week(n.fecha) AS CHAR) = ?";

        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('s', $dato);
        $stmt->execute();
        $resp = $stmt->get_result();


        while ($nota = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($notas, $nota);
        }

        return $notas;
    }


    public function notas_hoy()
    {
        $notas = [];
        $query = "CALL sp_notas_hoy()";

        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($nota = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($notas, $nota);
        }

        return $notas;
    }
}
