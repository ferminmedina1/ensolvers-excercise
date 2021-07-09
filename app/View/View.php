<?php
require_once('./libs/smarty/Smarty.class.php');

abstract class View {
    protected $smarty;

    function __construct () {
        $this->smarty = new Smarty();
        $this->smarty->assign('base_url', BASE_URL);
    }

}