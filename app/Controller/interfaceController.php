<?php
require_once 'Controller.php';
require_once './app/View/interfaceView.php';
require_once './app/Model/foldersModel.php';

class interfaceController extends Controller {


    public function __construct() {
        parent::__construct();
        $this->model = new foldersModel();
        $this->view = new interfaceView($this->auth->getIsLogged());
    }

    function Folders(){
        $this->view->showFoldersLocation();
    }

    function Items(){
        $this->view->showItemsByFolder();
    }

    function editItem(){
        $this->view->showItemEdit();
    }
}