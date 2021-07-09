<?php
require_once 'Controller.php';
require_once './app/View/interfaceView.php';
require_once './app/Model/userModel.php';

class userController extends Controller {


    public function __construct() {
        parent::__construct();
        $this->model = new userModel();
        $this->view = new interfaceView();
    }

    function Log(){
        $this->view->showLog();
    }

     //VERIFICA QUE EL USUARIO EXISTA
     function VerifyUser(){
        $user = $_POST["input_user"];
        $pass = $_POST["input_pass"];

        if(isset($user)){
            $userFromDB = $this->model->GetUser($user);
            if(isset($userFromDB) && $userFromDB){ //PREGUNTAR SOBRE ESTE &&

                if (password_verify($pass, $userFromDB->pass)){ 

                    session_start();    //SE INICIA UNA SESION
                    $_SESSION["user"] = $userFromDB->user;    //SE TRAE EL user DEL USUARIO DESDE LA DB
                    $_SESSION["id_user"] = $userFromDB->id;
                    setcookie("id_user", $userFromDB->id); 

                    session_start();
                    header("Location: ".BASE_URL."folders");
                }
                else{  
                    $this->view->ShowLog("Incorrect password");
                }

            }
            else{      
                $this->view->ShowLog("User doesn't exist"); 
            }
        }
    }

     //CIERRA LA SESION
    function logout(){
        session_start();
        session_destroy();
        if (isset($_COOKIE['id_user']))      
            setcookie("id_user", "", time() - 1 );
        
            header("Location: ".BASE_URL."login");
    }

    private function checkLoggedIn(){
        session_start();                  
        if(!isset($_SESSION["user"])){     
            $_SESSION["admin"] = 0;
        }
    }
}