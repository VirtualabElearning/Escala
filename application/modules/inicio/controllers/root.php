<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

	/**
	
	 **/
	public function index()
	{
		$this->load->view('root/view_inicio');
	}
}

