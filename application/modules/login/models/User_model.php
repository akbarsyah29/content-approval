<?php 
	/**
	* User model for registration and login
	*/
	class User_model extends CI_Model
	{
		public $status;
		public $roles;
		
		function __construct()
		{
			parent::__construct();
			$this->status = $this->config->item('status');
			$this->roles = $this->config->item('roles');
		}

		public function insert_user($data)
		{
			$dt = array(
				'first_name' => $data['first_name'], 
				'last_name' => $data['last_name'], 
				'address' => $data['address'], 
				'country' => $data['country'], 
				'email' => $data['email'], 
				'roles' => $this->roles[0], 
				'status' => $this->status[0] 
			);

			$q = $this->db->insert_string('users', $dt);
			$this->db->query($q);
			return $this->db->insert_id();
		}

		public function is_duplicate($email)
		{
			$this->db->get_where('users', array('email' => $email));
			return $this->db->affected_rows() > 0 ? TRUE : FALSE;
		}

		function insert_token($user_id)
		{
			$token = substr(sha1(rand), 0, 30);
			$date = date('Y-m-d');

			$dt = array(
				'token' => $token,
				'user_id' => $user_id,
				'created' => $date 
			);

			$query = $this->db->insert_string('tokens', $dt);
			$this->db->query($query);

			return $token.$user_id;			
		}
	}