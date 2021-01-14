<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class landspdf {

      function landspdf() {
            $CI = & get_instance();
      }

      function load($mode = '', $format = 'A4', $default_font_size = 0, $default_font = '', $mgl = 15, $mgr = 15, $mgt = 16, $mgb = 16, $mgh = 9, $mgf = 9, $orientation = 'l') {
            include_once COMMONPATH . '/third_party/mpdf60/mpdf.php';
            return new mPDF($mode, $format, $default_font_size, $default_font, $mgl, $mgr, $mgt, $mgb, $mgh, $mgf, $orientation);
      }

}

?>