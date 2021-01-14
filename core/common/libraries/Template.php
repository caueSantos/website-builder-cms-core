<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Template {
	
	var $template_data = array();
	
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}
//	function set($name, $value)
//{
//	$this->template_data[$name] = $value;
//}
	function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{
		$this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}

    function show($view, $data = array())
    {		$CI = & get_instance();
    		$CI->load->view("header", $data);
                $CI->load->view("menu", $data);
               
    		$CI->load->view($view, $data);
    		$CI->load->view("footer", $data);
    	}
   
 
    function menu($view,$data = array())    //function menu($nivel)
	{
    	$CI = & get_instance();
    	$CI->load->view('template/menu', array('view' => $view));
    }
    
    function tabelas($tabela,$nivel)
    {
        $CI = & get_instance();
        $i = 0;
        foreach ($tasks as $task) {
            $i++;
            $CI->load->view('template/tabelas', array('i' => $i, 'tabela' => $tabela, 'nivel' => $nivel));
        }
    }
}
