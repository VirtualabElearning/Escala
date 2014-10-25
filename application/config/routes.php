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
	$route['color.css'] = "color";
	$route['customjs.js'] = "customjs";

	$route['inicio'] = "inicio/publico";
	$route['ciudades'] = "login/publico/ciudades";

	$route['contenidos/informacion/(:any)/(:any).html'] = "contenidos/publico/informacion/$1/$2";
	$route['plataforma/estudio-virtual/(:any)/(:any).html'] = "landings/publico/informacion/$1/$2";
	$route['plataforma/validar.html'] = "landings/publico/validar_landings";


	$route['mipremio/(:any)/(:any)'] = "contenidos/publico/mipremio/$1/$2";

	$route['contenidos/contacto.html'] = "contenidos/publico/contacto";
	$route['contenidos/validar_contacto.html'] = "contenidos/publico/validar_contacto";
	$route['mis_cursos/buscar_mis_cursos'] = "cursos/publico/buscar_mis_cursos";

	$route['cursos/get_oportunidades_ev/(:any)'] = "cursos/publico/get_oportunidades_ev/$1";
	$route['cursos/get_notificaciones_ajax'] = "cursos/publico/get_notificaciones_ajax";
	$route['get_certificado/(:any)'] = "cursos/publico/get_certificado/$1";
	$route['validar_certificado/(:any)'] = "cursos/publico/validar_certificado/$1";


	$route['get_puntos_actual_ajax/(:any)'] = "cursos/publico/get_puntos_actual_ajax/$1";





	$route['cursos/caja_sorpresa/(:any)/(:any)/(:any)'] = "cursos/publico/caja_sorpresa/$1/$2/$3";
	$route['obtener_estatus_barra/(:any)'] = "cursos/publico/gen_estatus/$1";
	$route['cursos/getif_logro/(:any)/(:any)/(:any)'] = "cursos/publico/getif_logro/$1/$2/$3";
	$route['cursos/if_visto_actividad_barra/(:any)'] = "cursos/publico/if_visto_actividad_barra/$1";
	$route['cursos/set_nuevostatus/(:any)/(:any)/(:any)'] = "cursos/publico/set_nuevostatus/$1/$2/$3";
	$route['cursos/mis_certificados'] = "cursos/publico/mis_certificados";


	$route['cursos/set_puntos_curso/(:any)/(:any)'] = "cursos/publico/set_puntos_curso/$1/$2";


	$route['explicacion'] = "generico/explicacion";

	$route['notificaciones/(:any)'] = "login/publico/notificaciones/$1";
	$route['inbox'] = "login/publico/inbox";


	$route['op_notificaciones/(:any)/(:any)'] = "login/publico/op_notificaciones/$1/$2";
	$route['op_inbox/(:any)/(:any)'] = "login/publico/op_inbox/$1/$2";

	$route['get_notificaciones_ajax_list'] = "login/publico/get_notificaciones_ajax_list";
	$route['login/recuperar_contrasena/(:any)'] = "login/publico/recuperar_contrasena/$1";

	$route['login/validar_recuperar_contrasena'] = "login/publico/validar_recuperar_contrasena";



	$route['login/suscripcion'] = "login/publico/suscripcion";
	$route['login/editar_perfil'] = "login/publico/editar_perfil";
	$route['login/editar_perfil/(:any)'] = "login/publico/editar_perfil/$1";
	$route['login/actualizar_perfil'] = "login/publico/actualizar_perfil";
	$route['login/actualizar_perfil/(:any)'] = "login/publico/actualizar_perfil/$1";
	$route['login/cambiar_clave'] = "login/publico/cambiar_clave";
	$route['login/actualizar_clave'] = "login/publico/actualizar_clave";
	$route['login/confirmar/(:any)'] = "login/publico/confirmar/$1";

	$route['olvide_contrasena'] = "login/publico/olvide_contrasena";
	$route['validar_olvide_contrasena'] = "login/publico/validar_olvide_contrasena";

	$route['ingresar'] = "login/publico/ingresar";
	$route['ingresar/(:any)'] = "login/publico/ingresar/$1";



	$route['cursos'] = "cursos/publico";
	$route['cursos/buscar'] = "cursos/publico/buscar";
	$route['cursos/update-tutorial'] = "cursos/publico/update_tutorial";
	$route['cursos/registrarme_al_curso/(:any)'] = "cursos/publico/registrarme_al_curso/$1";
	$route['cursos/registrarme_al_curso_premium/(:any)'] = "cursos/publico/registrarme_al_curso_premium/$1";

	$route['cursos/payu_respuesta'] = "cursos/publico/payu_respuesta";


	
	$route['cursos/buscar_curso'] = "cursos/publico/buscar_curso";
	$route['cursos/descargar/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/descargar/$1/$2/$3/$4";
	$route['cursos/mis_cursos'] = "cursos/publico/mis_cursos";
	$route['cursos/detalle/(:any)/(:any)'] = "cursos/publico/detalle/$1/$2";
	$route['cursos/empezar/(:any)/(:any)'] = "cursos/publico/empezar/$1/$2";
	
	$route['cursos/sendpost'] = "cursos/publico/sendpost";
	$route['cursos/createpost'] = "cursos/publico/createpost";


	


	$route['cursos/dar_meencanta'] = "cursos/publico/dar_meencanta";
	$route['cursos/dar_meencanta_estudiante'] = "cursos/publico/dar_meencanta_estudiante";
	$route['cursos/enviar_pregunta'] = "cursos/publico/enviar_pregunta";
	$route['cursos/set_visto/(:any)/(:any)/(:any)'] = "cursos/publico/set_visto/$1/$2/$3";
	$route['cursos/set_puntos_pregunta_rapida/(:any)/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/set_puntos_pregunta_rapida/$1/$2/$3/$4/$5";
	$route['cursos/set_puntos_pregunta_rapida_ev/(:any)/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/set_puntos_pregunta_rapida_ev/$1/$2/$3/$4/$5";
	$route['cursos/if_first_actividad/(:any)/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/if_first_actividad/$1/$2/$3/$4/$5";
	$route['cursos/set_puntos/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/set_puntos_pregunta_rapida/$1/$2/$3/$4";
	$route['cursos/set_puntos/(:any)/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/set_puntos_pregunta_rapida/$1/$2/$3/$4/$5";
	$route['cursos/if_first_actividad/(:any)/(:any)/(:any)'] = "cursos/publico/if_first_actividad/$1/$2/$3";
	$route['cursos/socialpoint/(:any)/(:any)/(:any)/(:any)'] = "cursos/publico/socialpoint/$1/$2/$3/$4";


	$route['login'] = "login/publico/ingresar";

	$route['registro'] = "login/publico/registro";
	$route['registro_usuario'] = "login/publico/registro_usuario";
	$route['registro_usuario_validar'] = "login/publico/registro_usuario_validar";




	$route['mis_cursos'] = "cursos/publico/mis_cursos";
	$route['ingresar/validar'] = "login/publico/validar";
	$route['facebook_login'] = "login/publico/facebook";
	$route['facebook_login/(:any)'] = "login/publico/facebook/$1";
	$route['salir_sistema'] = "login/publico/salir";


	/* End of file routes.php */
	/* Location: ./application/config/routes.php */