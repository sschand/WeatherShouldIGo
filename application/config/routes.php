<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['login/register']='Login/store_user_register';

$route['map'] = "main/map";
$route['login/validate_user/(:any)/(:any)'] = "login/validate_user/$1/$2";

$route['sms'] = 'main/sms';

$route['404_override'] = '';

//end of routes.php
