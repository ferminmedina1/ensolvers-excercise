<?php
    require_once('app/Controller/userController.php');
    require_once('app/Controller/interfaceController.php');
    require_once('routerClass.php');
    
   // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');    
    define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');

    $r = new Router();

   //LAS CARPETAS
    $r->addRoute("folders", "GET", "interfaceController", "Folders");

    //LOS ITEMS DE UNA CARPETA
    $r->addRoute("folder/:ID", "GET", "interfaceController", "Items");

    //USER LINKS
    $r->addRoute("log", "GET", "userController", "Log");
    $r->addRoute("logout", "GET", "userController", "logout");
    $r->addRoute("verifyUser", "POST", "userController", "VerifyUser");

   //Ruta por defecto.
    $r->setDefaultRoute("userController", "Log");

 //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>