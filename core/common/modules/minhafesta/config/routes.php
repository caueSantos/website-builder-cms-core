<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');



$route['post/(:any)/(:any)'] = 'post/router';
$route['post/(:any)'] = 'post/router';
$route['post'] = 'post';
$route['adminer'] = 'adminer';


$route['minhafesta/(:any)'] = 'minhafesta/index/$1';
$route['minhafesta'] = 'minhafesta';
$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';
$route['backup'] = 'backup'; 
$route['backup/(:any)'] = 'backup/index/$1';
$route['default_controller'] = "painel/index/$1";
$route['404_override'] = '';

$route['(:any)'] = "painel/index/$1";

$GLOBALS['configs']['routes'] = $route;
/* End of file routes.php */
/* Location: ./application/config/routes.php */