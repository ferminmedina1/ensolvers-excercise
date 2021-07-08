<?php
require_once 'View.php';

class interfaceView extends View{

    public function __construct($is_logged){
        parent::__construct($is_logged);
    }
    
    function showLogin($message = ""){
        $this->smarty->assign('message', $message);
        $this->smarty->display('templates/login.tpl'); 
    }

    function showFoldersLocation($folders){
        $this->smarty->assign('folders', $folders);
        $this->smarty->display('../templates/folders.tpl');
    }
}