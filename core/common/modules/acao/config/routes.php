<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');



$route['post/(:any)/(:any)'] = 'post/router';
$route['post/(:any)'] = 'post/router';
$route['post'] = 'post';
$route['adminer'] = 'adminer';


$route['consultar/(:any)'] = 'consultar/index/$1';
$route['consultar'] = 'consultar';

$route['acao/(:any)'] = 'acao/index/$1';
$route['acao'] = 'acao';


$route['minhafesta/(:any)'] = 'restrita/index/$1';
$route['minhafesta'] = 'restrita';

$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';
$route['backup'] = 'backup';
$route['backup/(:any)'] = 'backup/index/$1';
$route['default_controller'] = "restrita/index/$1";
$route['404_override'] = '';

$route['(:any)'] = "consultar/index/$1";

$GLOBALS['configs']['routes'] = $route;
/* End of file routes.php */
/* Location: ./application/config/routes.php */