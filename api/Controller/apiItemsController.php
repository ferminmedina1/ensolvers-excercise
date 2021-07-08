<?php

require_once('./api/Model/apiItemsModel.php');
require_once('apiController.php');

class apiItemsController extends apiController{

    function __construct(){

        parent::__construct();
        $this->model = new apiItemsModel();
        $this->view = new apiView();

    }

    function getItemsByFolder($params = null){
        $id = $params[":ID"];
        $items = $this->model->getItemsByFolder($id);
        if (!empty($items))
            $this->view->response($items, 200);
        else
            $this->view->response("There are no items in this folder or this folder doesn't exists", 404);
    }

    function addItem(){
        $body = $this->getData();
        $item = $this->model->insertItem($body->info,$body->id_folder);
        if ($item == 1)
            $this->view->response("Item inserted successfully", 200);
        else
            $this->view->response("Could not add item", 404);
    }

    function editItemCheck($params = null){
        $id = $params[":ID"];
        $body = $this->getData();
        if(isset($body))
        $result = $this->model->updateItem($id,$body->completed);
        if ($result > 0)
            $this->view->response("Item edit successfully", 200);
        else
            $this->view->response("There are no items with id = $id", 404);
    }
    
}