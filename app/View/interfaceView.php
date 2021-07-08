<?php
require_once 'View.php';

class interfaceView extends View{

    public function __construct($is_logged){
        parent::__construct($is_logged);
    }
    
    function showLogin($mensaje = ""){
        $this->smarty->assign('mensaje', $mensaje);
        $this->smarty->display('templates/login.tpl'); 
    }

    function showFoldersLocation(){
        $this->smarty->display('../templates/folders.tpl');
    }
}