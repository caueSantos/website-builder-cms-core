<?php

require_once BASEPATH.'libraries/Form_validation.php';
class Validacao extends CI_Form_validation {

    function __construct($rules = array()) {
          
        parent::__construct($rules);
        $this->ci = & get_instance();
       
    }

    public function get_errors_as_array() {
     
        
        return $this->_error_array;
    }
    
     public function get_msg_erro() {

        $i=0;
        $retorno='';
        foreach($this->_error_array as $erro){
            $retorno=$retorno.' '.$erro;
        }
        return $retorno;
//        return $this->_error_array;
    }

    public function get_config_rules() {
        return $this->_config_rules;
    }

    public function get_field_names($form) {
        $field_names = array();
        $rules = $this->get_config_rules();
        $rules = $rules[$form];
        foreach ($rules as $index => $info) {
            $field_names[] = $info['field'];
        }
        return $field_names;
    }
}
?>