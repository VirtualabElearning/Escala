<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (
			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "541420399295679", "secret" => "3e9b3024a6cc59994dae3c3e97bdbbfb" ),
			),
			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "rcvoN3tw1T1qu8LmkOnAo41TS", "secret" => "HjRdbUcVa7kvvtZU4CipMXOvwTiihQ9lb0QcbMGbAGytUEvwtH" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => (ENVIRONMENT == 'production'),

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */