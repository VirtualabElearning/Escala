<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "inicio/publico";
$route['404_override'] = '';

$route['login/admin'] = "login/root";
$route['admin'] = "login/root";

$route['inicio'] = "inicio/publico";
$route['cursos'] = "cursos/publico";
$route['cursos/buscar'] = "cursos/publico/buscar";
$route['cursos/buscar_curso'] = "cursos/publico/buscar_curso";




$route['ingresar'] = "login/publico/ingresar";

$route['login'] = "login/publico/ingresar";

$route['registro'] = "login/publico/registro";
$route['cursos/mis_cursos'] = "cursos/publico/mis_cursos";
$route['ingresar/validar'] = "login/publico/validar";
$route['facebook_login'] = "login/publico/facebook";
$route['salir_sistema'] = "login/publico/salir";
//$route['ingresar/assets'] = "assets";


#$route['cursos/(:any)/(:any)'] = "cursos/publico/$1/$2";



/* End of file routes.php */
/* Location: ./application/config/routes.php */