<?php
require_once './app/Helper/AuthHelper.php';

abstract class Controller {
    protected $view;
    protected $model;
    protected $auth;

    function __construct () {
        $this->auth = new AuthHelper();
    }
}