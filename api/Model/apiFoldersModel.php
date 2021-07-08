<?php
require_once 'Model.php';

class apiFoldersModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    function getFolders() {
        $query = $this->db->prepare('SELECT * FROM folders');
        $query->execute();
        $folders = $query->fetchAll(PDO::FETCH_OBJ);
        return $folders;
    }

    //ELIMINA CARPETA POR SU ID
    function deleteFolder($id_folder) {
        $query = $this->db->prepare('DELETE FROM folders WHERE id = ?');
        $query->execute([$id_folder]);
        return $query->rowCount();
    }

    function insertFolder($name){
        $query = $this->db->prepare('INSERT INTO folders(name) VALUES (?)');
        return $query->execute([$name]);
    }

}