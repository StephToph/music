<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()	{
		if(empty($this->session->userdata('mu_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('mu_user_id');
		}
		
		$data['user'] = $this->session->userdata('mu_user_id');
		$data['title'] = 'Dashboard | '.app_name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('designs/footer', $data);
		
	}

	public function error()	{
		//$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		$data['title'] = 'Error | '.app_name;
		$this->load->view('error_404', $data);
		
	}
}
