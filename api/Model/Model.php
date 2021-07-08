<?php


abstract class Model {
    protected $db;

    //Conexion a la base de datos
    function __construct () {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_ensolvers;charset=utf8', 'root', '');
    }
}