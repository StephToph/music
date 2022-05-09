<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tracks extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	/////////////////// Artist Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('mu_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('mu_user_id');
		}
		$data['user'] = $this->session->userdata('mu_user_id');
		
		$table = 'track';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'tracks/index/'.$param1;
		if($param2){$form_url .= '/'.$param2;}
		if($param3){$form_url .= '/'.$param3;}
		$data['form_url'] = $form_url;
		
		// manage record
		if($param1 == 'manage') {
			// prepare for delete
			if($param2 == 'delete') {
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['d_id'] = $e->id;
						}
					}
					
					if($_POST){
						$del_id = $this->input->post('d_id');
						if($this->Crud->delete('id', $del_id, $table) > 0) {
							echo $this->Crud->msg('success', 'Record Deleted' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please Try Later');
						}
						exit;	
					}
				}
			} else {
				// prepare for edit
				if($param2 == 'edit') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_name'] = $e->name;
								$data['e_description'] = $e->description;
								$data['e_album_status'] = $e->album_status;
								$data['e_album'] = $e->album;
								$data['e_track'] = $e->track;
								$data['e_artist'] = $e->artist;
								$data['e_genre'] = $e->genre;
								$data['e_date'] = $e->date;
								$data['e_track_id'] = $e->track_id;
								

							}
						}
					}
				}

				if($param2 == 'view') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_name'] = $e->name;
								$data['e_description'] = $e->description;
								$data['e_album_status'] = $e->album_status;
								$data['e_album'] = $e->album;
								$data['e_track'] = $e->track;
								$data['e_artist'] = $e->artist;
								$data['e_genre'] = $e->genre;
								$data['e_date'] = $e->date;
								$data['e_track_id'] = $e->track_id;
							}
						}
					}
				}

				if($_POST){
					$id = $this->input->post('id');
					$name = $this->input->post('name');
					$artist = $this->input->post('artist');
					$status = $this->input->post('status');
					$genre = $this->input->post('genre');
					$album = $this->input->post('album');
					$music = $this->input->post('music');
					$description = $this->input->post('description');
					
					//check audio upload
					if($_FILES['music']['name']){
						$stamp = time();
						
						$path = 'assets/audio';
						
						if (!is_dir($path))
							mkdir($path, 0755);
			
						$pathMain = './assets/audio';
						if (!is_dir($pathMain))
							mkdir($pathMain, 0755);
			
						$result = $this->Crud->do_upload("music", $pathMain);
			
						if (!$result['status']){
							//echo $this->Crud->msg('danger', 'Can not upload music, try another');
						} else {
							$save_path = $path . '/' . $result['upload_data']['file_name'];
							$img_id = $save_path;
							//echo $this->Crud->msg('success', 'Music Uploaded');
							
						}
					}

					if($id) {
						$upd_data['description'] = $description;
						$upd_data['name'] = $name;
						$upd_data['img_id'] = $img_id;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check('name', $name, $table) > 0) {
							echo $this->Crud->msg('warning', 'Track Already Exist' );
						} else {
							$ins_data['name'] = $name;
							$ins_data['artist'] = $artist;
							$ins_data['genre'] = $genre;
							$ins_data['album_status'] = $status;
							if(!empty($album)){$ins_data['album'] = $album;}
							$ins_data['track'] = $save_path;
							$ins_data['description'] = $description;
							$ins_data['track_id'] = 'TR00';
							$ins_data['music_qr'] = 'TR00';
							$ins_data['date'] = date(fdate);

							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
								$q_img = $this->Crud->generate_qrcode(base_url().'/music/viewer/TR0'.$ins_rec);
								$up_data['track_id'] = 'TR0'.$ins_rec;
								$up_data['music_qr'] = $q_img;
								$this->Crud->update('id', $ins_rec, $table, $up_data);
								echo $this->Crud->msg('success', 'Track Uploaded');
								echo '<script>window.location.replace("'.base_url('tracks').'");</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please Try Later');	
							}	
						}
					}
				die;	
				}
			}
		}



		// record listing
		if($param1 == 'list') {
			// DataTable parameters
			$table = 'track';
			$column_order = array('name', 'description');
			$column_search = array('name', 'description');
			$order = array('name' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$name = $item->name;
				$description = $item->description;
				$artist = $item->artist;
				$album_status = $item->album_status;
				$track = $item->track;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				if (!empty($img_id)) {
                    $image = '<img src="'.base_url($img_id).'" class="d-flex  img-circle" height="100px" width="100px">';
                } else {
                    $image = '<img src="'.base_url('assets/avatar.png').'" class="d-flex inline-block mb-10 img-fluid" height="100px" width="100px">';
                }

                $tra = '<audio src="'.base_url($track).'"></audio>';

				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('tracks/index/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';

				// edit 
				$view_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="View Record" pageName="'.base_url('tracks/index/manage/view/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="VIEW">
						<i class="icon-eye fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('tracks/index/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// add manage buttons
				$all_btn = '
					<div class="text-center">
						'.$del_btn.'&nbsp;
						'.$view_btn.'&nbsp;
						'.$edit_btn.'
					</div>
					'.$script.'
				';
				
				$row = array();
				$row[] = strtoupper($name);
				$row[] = strtoupper($artist);
				$row[] = ucwords($album_status);		
				//$row[] = $tra;		
				
				$row[] = $all_btn;
	
				$data[] = $row;
				$count += 1;

			}
	
			$output = array(
				"draw" => intval($_POST['draw']),
				"recordsTotal" => $this->Crud->datatable_count($table, $where),
				"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
				"data" => $data,
			);
			
			//output to json format
			echo json_encode($output);
			die;
		}

			
		if($param1 == 'manage') {
			$this->load->view('tracks/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'tracks/index/list'; // ajax table url
			$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '2,3'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Tracks | '.app_name;
			$data['page_active'] = 'tracks';
			$this->load->view('designs/header', $data);
			$this->load->view('tracks/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

	public function new(){
		if(empty($this->session->userdata('mu_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('mu_user_id');
		}
		$data['user'] = $this->session->userdata('mu_user_id');
		
		//$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		$data['title'] = 'New Track | '.app_name;
		$data['page_active'] = 'new_track';
		$this->load->view('designs/header', $data);
		$this->load->view('tracks/new', $data);
		//$this->load->view('designs/footer', $data);
		
	}

	public function add(){
		$table = 'track';
		if($_POST){
			$name = $this->input->post('name');
			$artist = $this->input->post('artist');
			$status = $this->input->post('status');
			$genre = $this->input->post('genre');
			$album = $this->input->post('album');
			$music = $this->input->post('music');
			$description = $this->input->post('description');
			
			//check audio upload
			if($_FILES['music']['name']){
				$stamp = time();
				
				$path = 'assets/audio';
				
				if (!is_dir($path))
					mkdir($path, 0755);
	
				$pathMain = './assets/audio';
				if (!is_dir($pathMain))
					mkdir($pathMain, 0755);
	
				$result = $this->Crud->do_upload("music", $pathMain);
	
				if (!$result['status']){
					//echo $this->Crud->msg('danger', 'Can not upload music, try another');
				} else {
					$save_path = $path . '/' . $result['upload_data']['file_name'];
					$img_id = $save_path;
					//echo $this->Crud->msg('success', 'Music Uploaded');
					
				}
			}


			if($this->Crud->check('name', $name, $table) > 0) {
				echo $this->Crud->msg('warning', 'Track Already Exist' );
			} else {
				$ins_data['name'] = $name;
				$ins_data['artist'] = $artist;
				$ins_data['genre'] = $genre;
				$ins_data['album_status'] = $status;
				if(!empty($album)){$ins_data['album'] = $album;}
				$ins_data['track'] = $save_path;
				$ins_data['description'] = $description;
				$ins_data['track_id'] = 'TR00';
				$ins_data['music_qr'] = 'TR00';
				$ins_data['date'] = date(fdate);

							
				$ins_rec = $this->Crud->create($table, $ins_data);
				if($ins_rec > 0) {
					$q_img = $this->Crud->generate_qrcode(base_url().'music/viewer/TR0'.$ins_rec);
					$up_data['track_id'] = 'TR0'.$ins_rec;
					$up_data['music_qr'] = $q_img;
					$this->Crud->update('id', $ins_rec, $table, $up_data);
					echo $this->Crud->msg('success', 'Track Uploaded');
					echo '<script>window.location.replace("'.base_url('tracks').'");</script>';
				} else {
					echo $this->Crud->msg('danger', 'Please Try Later');	
				}	
			}
		die;	
		}
	}
}