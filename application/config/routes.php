<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['login/store_user_register']='login/store_user_register';
$route['map'] = "main/map";
$route['login/validate_user/(:any)/(:any)/(:any)'] = "login/validate_user/$1/$2/$3";
$route['test'] = "main/test";
$route['getUserCity/(:any)'] = 'main/getUserCity/$1';

$route['sms'] = 'main/sms';
$route['main/get_usernames/(:num)'] = 'main/get_usernames/$1';

$route['404_override'] = '';

//end of routes.php
