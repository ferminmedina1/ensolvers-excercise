<?php

require_once ('./api/View/apiView.php');
require_once ('./app/Helper/userHelper.php');

abstract class ApiController {
    protected $view;
    private $data,$helper; 

    public function __construct() {
        $this->view = new apiView();
        $this->helper = new userHelper();
        $this->data = file_get_contents("php://input"); 
        $this->helper->checkUserSession();
    }

 //LO QUE TRAJO DEL FORMULARIO LO CONVIERTE A JSON Y LO RETORNA
    function getData(){ 
        return json_decode($this->data); 
    }  
}