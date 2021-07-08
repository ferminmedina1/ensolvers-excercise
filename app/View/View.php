<?php
require_once('./libs/smarty/Smarty.class.php');

abstract class View {
    protected $smarty;

    function __construct ($is_logged) {
        $this->smarty = new Smarty();
        $this->smarty->assign('is_logged', $is_logged);
        $this->smarty->assign('base_url', BASE_URL);
    }

}