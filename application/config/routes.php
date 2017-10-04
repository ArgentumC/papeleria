<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'producto';
$route['venta'] = 'venta';

$route['(:any)'] = 'producto';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
