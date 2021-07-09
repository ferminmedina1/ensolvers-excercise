<?php


class userHelper {

    function checkUserSession() {
        $this->startSessionFixed();
        if (!isset($_SESSION['user'])) {
            header("Location: ".LOGIN);
            die();
        }else{
            return true;
        }
    }

    function startSessionFixed() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}