<?php
require_once 'Model.php';

class userModel extends Model{

    public function __construct() {
        parent::__construct();
    }

 //TRAE UN USUARIO MEDIANTE EL user
    function GetUser($user){
        $sentencia = $this->db->prepare("SELECT * FROM users WHERE user=?");
        $sentencia->execute([$user]);
        $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

 //TRAE UN USUARIO MEDIANTE EL ID  
    function getUserByID($id){
        $sentencia = $this->db->prepare("SELECT * FROM users WHERE id=?");
        $sentencia->execute([$id]);
        $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }


 //OBTIENE TODOS LOS USUARIOS
    function getAllUsers(){
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

}

?>