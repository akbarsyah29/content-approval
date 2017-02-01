<?php  
	/**
	* 
	*/
	class Login extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->helper('assets');
		}

		public function index()
		{
			$this->load->view('login');
		}
	}