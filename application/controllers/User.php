<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	

	public function check_email() {
		$email = $this->input->get('email');
		if($email) {
			if($this->Crud->check('email', $email, 'customer') <= 0) {
				echo '<span class="text-success small">Email Available</span>';
			} else {
				echo '<span class="text-danger small">Email Taken</span>';
			}
			die;
		}
	}

	public function check_password($param1 = '', $param2 = '') {
		if($param1 && $param2) {
			if($param1 == $param2) {
				echo '<span class="text-success small">Password Matched</span>';
			} else {
				echo '<span class="text-danger small">Password Not Matched</span>';
			}
			die;
		}
	}

	public function terms($param1 = '') {
		//echo $param1;
		if($param1) {
			echo '<button type="submit" class="btn btn-warning btn-rounded">sign Up</button>';
		} else {
			echo '<button type="submit" class="btn btn-warning btn-rounded" disabled>sign Up</button>';
		}
	}

	public function login() {
		if(!empty($this->session->userdata('mu_user_id'))) {
			redirect(base_url('dashboard'), 'refresh');
		}

		$table = 'user';
		if($_POST) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if(!$email || !$password) {
				echo $this->Crud->msg('danger', 'All Fields are Required');
			} else {
				$user = $this->Crud->read2('email', $email, 'password', md5($password), $table);
				if(empty($user)) {
					echo $this->Crud->msg('danger', 'Authentication Failed');
				} else {
					
						$user_id = $this->Crud->read_field('email', $email, $table, 'id');
						$up_data['last_log'] = date(fdate);
						$up_data['status'] = 1;
						$this->Crud->update('id', $user_id, $table, $up_data);

						// save user_id in session
						$this->session->set_userdata('mu_user_id', $user_id);
						
						echo $this->Crud->msg('success', 'Login Successful');

						// redirect
						echo '<script>window.location.replace("'.base_url('dashboard').'");</script>';
						
				
				}
			}

			die;
		}

		
		$data['title'] = 'Login | '.app_name;
		$this->load->view('login', $data);
	}

	public function logout() {
		if(!empty($this->session->userdata('mu_user_id'))) {
			$user_id = $this->session->userdata('mu_user_id');
			$up_data['status'] = 0;
			if($this->Crud->update('id', $user_id, 'user', $up_data) > 0) {
				$this->session->set_userdata('mu_user_id', '');
				$this->session->sess_destroy();
				$this->Crud->msg('success', 'Sign Out Successfully');
			}
		}
		//$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		
		$data['title'] = 'Sign Out | '.app_name;
		$this->load->view('login', $data);
	}

	public function dashboard()	{
		if(empty($this->session->userdata('co_customer_id'))) {
			redirect(base_url('customer_login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('co_customer_id');
		}
		$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		$data['title'] = 'Customer Dashboard | '.$name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('customer/dashboard', $data);
		$this->load->view('designs/footer', $data);
		
	}

}