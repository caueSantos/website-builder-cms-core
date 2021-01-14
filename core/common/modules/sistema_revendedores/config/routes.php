<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');



$route['post/(:any)/(:any)'] = 'post/router';
$route['post/(:any)'] = 'post/router';
$route['post'] = 'post';
$route['adminer'] = 'adminer';


$route['sistema_revendedores/(:any)'] = 'sistema_revendedores/index/$1';
$route['sistema_revendedores'] = 'sistema_revendedores';


$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';
$route['backup'] = 'backup';
$route['backup/(:any)'] = 'backup/index/$1';
$route['default_controller'] = "sistema_revendedores/index/$1";
$route['404_override'] = '';

$route['(:any)'] = "sistema_revendedores/index/$1";

$GLOBALS['configs']['routes'] = $route;
/* End of file routes.php */
/* Location: ./application/config/routes.php */