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
	$route['mis_cursos/buscar_mis_cursos'] = "cursos/publico/buscar_mis_cursos";

	$route['login/editar_perfil'] = "login/publico/editar_perfil";
	$route['login/editar_perfil/(:any)'] = "login/publico/editar_perfil/$1";
	$route['login/actualizar_perfil'] = "login/publico/actualizar_perfil";
		$route['login/actualizar_perfil/(:any)'] = "login/publico/actualizar_perfil/$1";
	$route['login/cambiar_clave'] = "login/publico/cambiar_clave";
	$route['login/actualizar_clave'] = "login/publico/actualizar_clave";
	$route['login/confirmar/(:any)'] = "login/publico/confirmar/$1";





	$route['cursos/registrarme_al_curso/(:any)'] = "cursos/publico/registrarme_al_curso/$1";


	$route['cursos/buscar_curso'] = "cursos/publico/buscar_curso";
	$route['cursos/descargar/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/descargar/$1/$2/$3/$4";

	$route['color.css'] = "color";

	$route['ingresar'] = "login/publico/ingresar";
	$route['ingresar/(:any)'] = "login/publico/ingresar/$1";
	$route['cursos/sendpost'] = "cursos/publico/sendpost";
	$route['cursos/dar_megusta'] = "cursos/publico/dar_megusta";
	$route['cursos/dar_megusta_estudiante'] = "cursos/publico/dar_megusta_estudiante";


	$route['login'] = "login/publico/ingresar";

	$route['registro'] = "login/publico/registro";
	$route['registro_usuario'] = "login/publico/registro_usuario";
	$route['registro_usuario_validar'] = "login/publico/registro_usuario_validar";



	$route['cursos/mis_cursos'] = "cursos/publico/mis_cursos";
	$route['cursos/detalle/(:any)/(:any)'] = "cursos/publico/detalle/$1/$2";
	$route['cursos/empezar/(:any)/(:any)'] = "cursos/publico/empezar/$1/$2";





	$route['mis_cursos'] = "cursos/publico/mis_cursos";
	$route['ingresar/validar'] = "login/publico/validar";
	$route['facebook_login'] = "login/publico/facebook";

	$route['facebook_login/(:any)'] = "login/publico/facebook/$1";

	$route['salir_sistema'] = "login/publico/salir";
	//$route['ingresar/assets'] = "assets";


	#$route['cursos/(:any)/(:any)'] = "cursos/publico/$1/$2";



	/* End of file routes.php */
	/* Location: ./application/config/routes.php */