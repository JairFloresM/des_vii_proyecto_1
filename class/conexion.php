<?php

require_once('credenciales.php');

class Conexion
{
    protected $_db;

    public function __construct()
    {
        $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


        if ($this->_db->connect_errno) {
            echo 'fallo al conectar a la base de datos ' . $this->_db->connect_errno;
            return;
        }
    }
}
