<?php

require_once('./api/Model/apiFoldersModel.php');
require_once('apiController.php');

class apiFoldersController extends apiController{

    function __construct(){

        parent::__construct();
        $this->model = new apiFoldersModel();
        $this->view = new apiView();
    }

    function allFolders(){
        $folders = $this->model->getFolders();
        if (!empty($folders))
            $this->view->response($folders, 200);
        else
            $this->view->response("there are no folders", 404);
    }

    function deleteFolder($params = null) {
    $id_folder = $params[":ID"];
    $resultado = $this->model->deleteFolder($id_folder);

    if ($resultado > 0)
        $this->view->response("Folder deleted successfully", 200);
    else
        $this->view->response("there are no folders with id = $id_folder", 404);
    }

    function addFolder(){
    $body = $this->getData();
    $folder = $this->model->insertFolder($body->name);
    if ($folder == 1)
        $this->view->response("Folder inserted successfully", 200);
    else
        $this->view->response("Could not add folder", 404);
    }

    function getFolder($params = null){
        $id = $params[":ID"];
        $folder = $this->model->getFolderById($id);
        if (!empty($folder))
            $this->view->response($folder, 200);
        else
            $this->view->response("there are no folders with id = $id", 404);
    }
    
}