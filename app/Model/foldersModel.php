<?php
require_once 'Model.php';

class foldersModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    function getFolders() {
        $query = $this->db->prepare('SELECT * FROM folders');
        $query->execute();
        $viandas = $query->fetchAll(PDO::FETCH_OBJ);
        return $viandas;
    }

}