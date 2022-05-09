<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	/////////////////// Album Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('mu_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('mu_user_id');
		}
		$data['user'] = $this->session->userdata('mu_user_id');
		
		$table = 'album';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'album/index/'.$param1;
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
								$data['e_name'] = $e->title;
								$data['e_description'] = $e->description;
								$data['e_img_id'] = $e->img_id;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$name = $this->input->post('name');
					$description = $this->input->post('description');
					$img_id = $this->input->post('img_id');
					
					//check image upload
					if($_FILES['pics']['name']){
						$stamp = time();
						
						$path = 'assets/img/album';
						
						if (!is_dir($path))
							mkdir($path, 0755);
			
						$pathMain = './assets/img/album';
						if (!is_dir($pathMain))
							mkdir($pathMain, 0755);
			
						$result = $this->Crud->do_upload("pics", $pathMain);
			
						if (!$result['status']){
							//echo $this->Crud->msg('danger', 'Can not upload picture, try another');
						} else {
							$save_path = $path . '/' . $result['upload_data']['file_name'];
							$img_id = $save_path;
							//echo $this->Crud->msg('success', 'Picture Changed');
							
						}
					}
					/// end profile picture upload	 
					

					// do create or update
					if($id) {
						$upd_data['description'] = $description;
						$upd_data['title'] = $name;
						if(!empty($img_id)){$upd_data['img_id'] = $img_id;}
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check('title', $name, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['description'] = $description;
							$ins_data['title'] = $name;
							if(!empty($img_id)){$ins_data['img_id'] = $img_id;}
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
								echo $this->Crud->msg('success', 'Record Created');
								echo '<script>location.reload(false);</script>';
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
			$table = 'album';
			$column_order = array('title', 'description');
			$column_search = array('title', 'description');
			$order = array('title' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$name = $item->title;
				$description = $item->description;
				$img_id = $item->img_id;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				if (!empty($img_id)) {
                    $image = '<img src="'.base_url($img_id).'" class="d-flex  img-circle" height="100px" width="100px">';
                } else {
                    $image = '<img src="'.base_url('assets/avatar.png').'" class="d-flex inline-block mb-10 img-fluid" height="100px" width="100px">';
                }

				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('album/index/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('album/index/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// add manage buttons
				$all_btn = '
					<div class="text-center">
						'.$del_btn.'&nbsp;
						'.$edit_btn.'
					</div>
					'.$script.'
				';
				
				$row = array();
				$row[] = $image;
				$row[] = strtoupper($name);
				$row[] = ucwords($description);		
				
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
			$this->load->view('album/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'album/index/list'; // ajax table url
			$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '0,3'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Album | '.app_name;
			$data['page_active'] = 'album';
			$this->load->view('designs/header', $data);
			$this->load->view('album/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

}