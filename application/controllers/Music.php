<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Music extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	/////////////////// Album Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		$data['user'] = $this->session->userdata('mu_user_id');
			
		$data['title'] = app_name;
		$data['page_active'] = 'music';
		$this->load->view('designs/header', $data);
		$this->load->view('music/view', $data);
		$this->load->view('designs/footer', $data);
		
	}
	/////////////////////////////End////////////////////////////////////////////


	/////////////////// Album Manage Script Start////////////////////////
	public function viewer($param1='') {

		$data['user'] = $param1;
			
		$data['title'] = 'Music View | '.app_name;
		$data['page_active'] = 'music';
		$this->load->view('designs/header', $data);
		$this->load->view('music/music_view', $data);
		$this->load->view('designs/footer', $data);
		
	}
	/////////////////////////////End////////////////////////////////////////////

	public function search($param1=''){
		$data['search'] = $param1;
		$this->load->view('music/music_search', $data);
		
	}

	public function sash($param1=''){
		$data['search'] = $param1;
		$this->load->view('music/music_sash', $data);
		
	}

}