<?php

require_once ('routerClass.php');
require_once ('api/Controller/apiFoldersController.php');

$r = new Router();

//Ruta por defecto.
$r->setDefaultRoute("apiFoldersController", "allFolders");

//TRAER TODAS LAS CARPETAS
$r->addRoute("folders", "GET", "apiFoldersController", "allFolders");

//INSERTAR CARPETA
$r->addRoute("addFolder", "POST", "apiFoldersController", "addFolder");

//ELIMINAR COMENTARIO
$r->addRoute("folders/:ID", "DELETE", "apiFoldersController", "deleteFolder");

$r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 