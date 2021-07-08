<?php
    require_once('app/Controller/interfaceController.php');
    require_once('routerClass.php');
    
   // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $r = new Router();

   //LAS CARPETAS
    $r->addRoute("folders", "GET", "interfaceController", "Folders");


   //Ruta por defecto.
    $r->setDefaultRoute("interfaceController", "Folders");

 //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>