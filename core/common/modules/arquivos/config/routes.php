<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');





$route['arquivos'] = 'arquivos';
$route['arquivos/enviar'] = 'arquivos/enviar/$1';
$route['arquivos/download'] = 'arquivos/download/$1';
$route['arquivos/(:any)'] = 'arquivos/index/$1';
$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';


$route['default_controller'] = "frontend/index/$1";
$route['404_override'] = '';

$route['(:any)'] = "frontend/index/$1";

$GLOBALS['configs']['routes'] = $route;
/* End of file routes.php */
/* Location: ./application/config/routes.php */