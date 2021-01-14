<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');



$route['post/(:any)/(:any)'] = 'post/router';
$route['post/(:any)'] = 'post/router';
$route['post'] = 'post';
$route['adminer'] = 'adminer';


$route['restrita/(:any)'] = 'restrita/index/$1';
$route['restrita'] = 'restrita';


$route['minhafesta/(:any)'] = 'restrita/index/$1';
$route['minhafesta'] = 'restrita';

$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';
$route['backup'] = 'backup';
$route['backup/(:any)'] = 'backup/index/$1';
$route['default_controller'] = "restrita/index/$1";
$route['404_override'] = '';

$route['(:any)'] = "restrita/index/$1";

$GLOBALS['configs']['routes'] = $route;
/* End of file routes.php */
/* Location: ./application/config/routes.php */