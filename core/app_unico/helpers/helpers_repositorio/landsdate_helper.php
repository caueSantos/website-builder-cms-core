<?php   if (!defined('BASEPATH'))       exit('No direct script access allowed');   if (!function_exists('hora')) {       function hora() {           $CI = & get_instance();           $CI->load->helper('date');           $time = gmt_to_local(now(), 'UP3'); //now();           $fmt = 'DATE_LANDS';           $formats = array(                   'DATE_LANDS' => '%H:%i:%s'           );           if (!isset($formats[$fmt])) {               return FALSE;           }           return mdate($formats[$fmt], $time);       }   }   if (!function_exists('formata_data')) {       function formata_data($time = '', $fmt = 'DATE_LANDS') {           $CI = & get_instance();           $CI->load->helper('date');           $formats = array(                   'DATE_LANDS' => '%d/%m/%Y'           );           if (!isset($formats[$fmt])) {               return FALSE;           }           return mdate($formats[$fmt], $time);       }   }