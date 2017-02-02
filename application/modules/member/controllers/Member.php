<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		log_message('debug', 'Welcome Controller is have been loaded');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function input()
	{
		$this->load->helper('assets');

		echo "Username: ".$this->input->post('username');
		echo "Password: ".$this->input->post('password');
		
		// $this->load->view('welcome_message');
	}
}
