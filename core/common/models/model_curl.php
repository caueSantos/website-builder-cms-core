<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_curl extends CI_Model {

    function __construct() {
        parent::__construct();



//            $this->load->helper('lands_model');
    }

    function executa_curl($url, $method = 'GET', $data = false, $headers = false, $returnInfo = true) {
        $ch = curl_init();

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data !== false) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        } else {
            if ($data !== false) {
                if (is_array($data)) {
                    $dataTokens = array();
                    foreach ($data as $key => $value) {
                        array_push($dataTokens, urlencode($key) . '=' . urlencode($value));
                    }
                    $data = implode('&', $dataTokens);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $data);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        if ($headers !== false) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $contents = curl_exec($ch);

        if ($returnInfo) {
            $info = curl_getinfo($ch);
        }

        curl_close($ch);

        if ($returnInfo) {
            return array('contents' => $contents, 'info' => $info);
        } else {
            return $contents;
        }
    }

}

//close:class:standartdb_model

      /* End of file standartdb_model.php	 */
      /* Location: ./application/models/standartdb_model.php */

      