<?php

	class User extends CI_Controller
	{

		//////////////////////////////////////////////////////////////////////////////////////////////

		public function __construct()
		{
			parent::__construct();
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		public function index()
		{
//			$this->load->view("home");
			$this->login();
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		public function login()
		{
			$this->load->view('login');
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		public function loginValidation()
		{
			$this->form_validation->set_message('required', 'Ovo polje je obavezno');
			$this->form_validation->set_message('valid_email', 'Unesite ispravnu email adresu');

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run())
			{
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				//model function
				$this->load->model('user_model');
				$arrUserData = $this->user_model->login($email, $password);

				if (is_array($arrUserData) && (count($arrUserData) > 0) && password_verify($password, $arrUserData['password']))
				{
					$this->session->set_userdata($arrUserData);

					redirect(base_url() . 'article/index');
				}
				else
				{
					$this->session->set_flashdata('error', 'Pogrešan email ili lozinka');

					redirect(base_url() . 'user/login');
				}
			}
			else
			{
				$this->login();
			}
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

		function logout()
		{
			$this->session->unset_userdata('email');

			redirect(base_url() . 'user/login');
		}

		//////////////////////////////////////////////////////////////////////////////////////////////

	}
?>
