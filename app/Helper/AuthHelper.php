<?php


class AuthHelper {

    function __construct () {
        session_start();
    }

    function startSessionVariables ($user) {
        $_SESSION['user'] = $user;
        $_SESSION['logged'] = true;
    }

    function getIsLogged() {
        return true;
    }
}