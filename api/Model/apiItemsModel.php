<?php
require_once 'Model.php';

class apiItemsModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    function getItemsByFolder($id){
        $query = $this->db->prepare('SELECT * FROM items WHERE id_folder = ?');
        $query->execute([$id]);
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

    function insertItem($info,$id_folder){
        $query = $this->db->prepare('INSERT INTO items(info,id_folder) VALUES (?,?)');
        return $query->execute([$info,$id_folder]);
    }

    function updateItemCheck($id, $completed) {
        $query = $this->db->prepare("UPDATE items SET completed=? WHERE id_item = ?");
        return $query->execute([$completed, $id]);
    }

    function updateItem($id, $info) {
        $query = $this->db->prepare("UPDATE items SET info=? WHERE id_item = ?");
        return $query->execute([$info, $id]);
    }

}