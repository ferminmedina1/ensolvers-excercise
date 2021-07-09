<?php
require_once './app/Helper/userHelper.php';

abstract class Controller {
    protected $view;
    protected $model;
    protected $helper;

    function __construct () {
        $this->helper = new userHelper();
    }
}