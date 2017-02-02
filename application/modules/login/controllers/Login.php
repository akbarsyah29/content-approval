<?php  
	/**
	* Class member
	*/
	class Login extends MY_Controller
	{
		public $status;
		public $roles;
		
		function __construct()
		{
			parent::__construct();
			$this->load->helper('assets');
			$this->load->model('User_model', 'usr_mdl', TRUE);
			$this->status = $this->config->item('status');
			$this->roles = $this->config->item('roles');
	        // $this->output->cache(10);
		}

		public function index()
		{
			// render view login
			$this->load->view('login');
		}

		public function register()
		{
			if ($this->usr_mdl->is_duplicate('email')) {
				$this->session->set_flashdata('flash_message', 'User email already exists');
				redirect('login/login');
			} else {
				$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));
				$id = $this->usr_mdl->insert_user($clean);
				$token = $this->usr_mdl->insert_token($id);

				$q_string = $this->base64url_encode($token);
				$url = site_url().'login/complete/token/'.$q_string;
				$link = '<a href="'.$url.'">'.$url.'</a>';

				$message = '';
				$message = '<strong>You have signed up with our website</strong></br>';
				$message .= '<strong>Please click: </strong>'.$link;

				echo $message;//send this message onto the registered email
				exit;
			}

		}
		
		public function base64url_encode($data) 
		{ 
			return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
		} 

		public function base64url_decode($data) 
		{ 
			return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
		}
		   
	}