<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/*$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/


//PRODUCTOS
$route['productos/create'] = 'productos/create';
$route['productos/edit'] = 'productos/edit/$1';
$route['productos/delete'] = 'productos/delete/$1';
//aqui tiene que ir la vista de la funcion que llama la consulta
//en ajax.
$route['productos/terms'] = 'productos/getCategoryProductParent';
$route['productos/cat'] = 'productos/getAllTaxtermbyparent';
//$route['productos/(:any)'] = 'productos/view/$1';
$route['productos'] = 'productos';

//TAXONOMYTERMS
$route['taxonomyterms/edit'] = 'taxonomyterms/edit/$1';
$route['taxonomyterms/delete'] = 'taxonomyterms/delete/$1';
$route['taxonomyterms/create'] = 'taxonomyterms/create';
$route['taxonomyterms/terms'] = 'taxonomyterms/getAllTaxtermbyparent';
$route['taxonomyterms'] = 'taxonomyterms';

//TAXONOMY
$route['taxonomy/edit'] = 'taxonomy/edit/$1';
$route['taxonomy/delete'] = 'taxonomy/delete/$1';
$route['taxonomy/create'] = 'taxonomy/create';
$route['taxonomy'] = 'taxonomy';

//MARCAS
$route['marcas/edit'] = 'marcas/edit/$1';
$route['marcas/delete'] = 'marcas/delete/$1';
$route['marcas/create'] = 'marcas/create';
$route['marcas'] = 'marcas';

//UNIDADES
$route['unidades/create'] = 'unidades/create';
$route['unidades/edit'] = 'unidades/edit/$1';
$route['unidades/delete'] = 'unidades/delete/$1';
$route['unidades'] = 'unidades';

//CLIENTES
$route['clientes/create'] = 'clientes/create';
$route['clientes/delete'] = 'clientes/delete/$1';
$route['clientes/edit'] = 'clientes/edit/$1';
$route['clientes/municipios'] = 'clientes/getMunicipiosPorEstado';
$route['clientes'] = 'clientes';


//cotizaciones

$route['cotizaciones/cart'] = 'cotizaciones/cart/$1';
$route['cotizaciones/edit'] = 'cotizaciones/edit/$1';
$route['cotizaciones/delete'] = 'cotizaciones/delete/$1';
$route['cotizaciones/addToCart'] = 'cotizaciones/addToCart';
$route['cotizaciones/cleanCart'] = 'cotizaciones/cleanCart';
$route['cotizaciones/deleteAProductFromCart'] = 'cotizaciones/deleteAProductFromCart';
$route['cotizaciones/getClientId'] = 'cotizaciones/getClientId';
$route['cotizaciones/areaCliente'] = 'cotizaciones/areaCliente';
$route['cotizaciones'] = 'cotizaciones';
$route['default_controller'] = 'welcome/index';
