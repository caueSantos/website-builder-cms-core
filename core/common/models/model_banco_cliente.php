<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_banco_cliente extends Model_banco {

    public $db = null;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

}

