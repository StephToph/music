<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function generate_qrcode($data){
        /* Load QR Code Library */
        $this->load->library('ciqrcode');
        
        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data.'.png';

        /* QR Code File Directory Initialize */
        $dir = 'assets/img/track_qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'content' => $data,
            'file'    => $dir. $save_name
        );
        return $return['file'];
    }


    ////////////////// CLEAR CACHE ///////////////////
	public function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
	
	//////////////////// C - CREATE ///////////////////////
	public function create($table, $data) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();	
	}
	
	//////////////////// R - READ /////////////////////////
	public function product_list($table='')	{
		$hasil = $this->db->get($table);
		return $hasil->result();
	}

	public function read($table, $limit='', $offset='') {
		$query = $this->db->order_by('id', 'ASC');
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_order($table, $field, $type, $limit='', $offset='') {
		$query = $this->db->order_by($field, $type);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_single($field, $value, $table, $limit='', $offset='') {
		$query = $this->db->order_by('id', 'ASC');
		$query = $this->db->where($field, $value);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_single_order($field, $value, $table, $or_field, $or_value, $limit='', $offset='') {
		$query = $this->db->order_by($or_field, $or_value);
		$query = $this->db->where($field, $value);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function read2_order($field, $value, $field2, $value2, $table, $or_field, $or_value, $limit='', $offset='') {
		$query = $this->db->order_by($or_field, $or_value);
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_like($field, $value, $table, $limit='', $offset='') {
		$query = $this->db->like($field, $value);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_like2($field, $value, $field2, $value2, $table, $limit='', $offset='') {
		$query = $this->db->like($field, $value);
		$query = $this->db->or_like($field2, $value2);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_like3($field, $value, $field2, $value2, $field3, $value3, $table, $limit='', $offset='') {
		$query = $this->db->like($field, $value);
		$query = $this->db->or_like($field2, $value2);
		$query = $this->db->or_like($field3, $value3);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}


	public function read_like4($field, $value, $field2, $value2, $field3, $value3, $field4, $value4, $table, $limit='', $offset='') {
		$query = $this->db->like($field, $value);
		$query = $this->db->or_like($field2, $value2);
		$query = $this->db->or_like($field3, $value3);
		$query = $this->db->or_like($field4, $value4);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function read_like5($field, $value, $field2, $value2, $field3, $value3, $field4, $value4, $field5, $value5, $table, $limit='', $offset='') {
		$query = $this->db->like($field, $value);
		$query = $this->db->or_like($field2, $value2);
		$query = $this->db->or_like($field3, $value3);
		$query = $this->db->or_like($field4, $value4);
		$query = $this->db->or_like($field5, $value5);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_field($field, $value, $table, $call) {
		$return_call = '';
		$getresult = $this->read_single($field, $value, $table);
		if(!empty($getresult)) {
			foreach($getresult as $result)  {
				$return_call = $result->$call;
			}
		}
		return $return_call;
	}

	public function read_field2($field, $value, $field2, $value2, $table, $call) {
		$return_call = '';
		$getresult = $this->read2($field, $value, $field2, $value2, $table);
		if(!empty($getresult)) {
			foreach($getresult as $result)  {
				$return_call = $result->$call;
			}
		}
		return $return_call;
	}
	
	public function read2($field, $value, $field2, $value2, $table, $limit='', $offset='') {
		$query = $this->db->order_by('id', 'asc');
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read3($field, $value, $field2, $value2, $field3, $value3, $table, $limit='', $offset='') {
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->where($field3, $value3);
		if($limit && $offset) {
			$query = $this->db->limit($limit, $offset);
		} else if($limit) {
			$query = $this->db->limit($limit);
		}
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function check($field, $value, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	public function check2($field, $value, $field2, $value2, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	public function check3($field, $value, $field2, $value2, $field3, $value3, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->where($field3, $value3);
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function check4($field, $value, $field2, $value2, $field3, $value3, $field4, $value4, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->where($field3, $value3);
		$query = $this->db->where($field4, $value4);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	//////////////////// U - UPDATE ///////////////////////
	public function update($field, $value, $table, $data) {
		$this->db->where($field, $value);
		$this->db->update($table, $data);
		return $this->db->affected_rows();	
	}
	
	//////////////////// D - DELETE ///////////////////////
	public function delete($field, $value, $table) {
		$this->db->where($field, $value);
		$this->db->delete($table);
		return $this->db->affected_rows();	
	}


	//Multiple Delete record
    public function delete_mult($field, $ids){
	   if(is_array($ids))
	      $this->db->where_in('customer_id', $ids);
	   else
	      $this->db->where('customer_id', $ids);
	   $this->db->delete('cart');
	   if ($this->db->affected_rows() > 0) {
	     return true;
	   }
	   else
	     return false;
	 }

	 public function delete_product($id='', $table='') {
	 	$this->db->where('product_id', $id);
	 	$result = $this->db->delete($table);
	 	return $result;
	 }
	//////////////////// END DATABASE CRUD ///////////////////////
	
	
	//////////////////// NOTIFICATION CRUD ///////////////////////
	public function msg($type = '', $text = ''){
		if($type == 'success'){
			$icon = 'success';
			$icon_text = 'Successful!';
		} else if($type == 'info'){
			$icon = 'notice';
			$icon_text = 'Head up!';
		} else if($type == 'warning'){
			$icon = 'warning';
			$icon_text = 'Please check!';
		} else if($type == 'danger'){
			$icon = 'error';
			$icon_text = 'Oops!';
		}
		
		return '
		<div class="alert alert-'.$type.' alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="'.$icon.' pr-15 pull-left"></i><p class="pull-left">'.$text.'</p> 
				<div class="clearfix"></div>
			</div>
		';	
	}
	//////////////////// END NOTIFICATION CRUD ///////////////////////
	
	//////////////////// EMAIL CRUD ///////////////////////
	public function send_email($to, $from, $subject, $body_msg, $name, $subhead) {
		//clear initial email variables
		$this->email->clear(); 
		$email_status = '';
		
		$this->email->to($to);
		$this->email->from($from, $name);
		$this->email->subject($subject);
						
		$mail_data = array('message'=>$body_msg, 'subhead'=>$subhead);
		$this->email->set_mailtype("html"); //use HTML format
		$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
				
		$this->email->message($mail_design);
		if(!$this->email->send()) {
			$email_status = FALSE;
		} else {
			$email_status = TRUE;
		}
		
		return $email_status;
	}
	//////////////////// END EMAIL CRUD ///////////////////////
	
	//////////////////// APP NOTIFY CRUD ///////////////////////
	public function notify($user_id, $user, $email, $phone, $item_id, $item, $title, $details, $type, $hash) {
		// register notification
		$not_data = array(
			'user_id' => $user_id,
			'nhash' => $hash,
			'item_id' => $item_id,
			'item' => $item,
			'new' => 1,
			'title' => $title,
			'details' => $details,
			'type' => $type,
			'reg_date' => date(fdate)
		);
		$not_ins = $this->create('ka_notify', $not_data);
		if($not_ins){
			// send email
			if($type == 'email'){
				$email_result = '';
				$from = app_email;
				$subject = $title;
				$name = app_name;
				$sub_head = $title.' Notification';
				
				$body = '
					<div class="mname">Hi '.ucwords($user).',</div><br />You have new '.$title.' notification,<br /><br />
					'.$details.'<br /><br />
					Warm Regards.
				';
				
				$email_result = $this->send_email($email, $from, $subject, $body, $name, $sub_head);
			} else {
				// send sms	
			}
		}
	}
	//////////////////// END APP NOTIFY CRUD ///////////////////////

	//////////////////// DATATABLE AJAX CRUD ///////////////////////
	public function datatable_query($table, $column_order, $column_search, $order, $where='') {
		// where clause
		if(!empty($where)) {
			$this->db->where(key($where), $where[key($where)]);
		}
		
		$this->db->from($table);
 
		// here combine like queries for search processing
		$i = 0;
		if($_POST['search']['value']) {
			foreach($column_search as $item) {
				if($i == 0) {
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				$i++;
			}
		}
		 
		// here order processing
		if(isset($_POST['order'])) { // order by click column
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order)) { // order by default defined
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
 
	public function datatable_load($table, $column_order, $column_search, $order, $where='') {
		$this->datatable_query($table, $column_order, $column_search, $order, $where);
		
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
 
	public function datatable_filtered($table, $column_order, $column_search, $order, $where='') {
		$this->datatable_query($table, $column_order, $column_search, $order, $where);
		$query = $this->db->get();
		return $query->num_rows();
	}
 
	public function datatable_count($table, $where='') {
		$this->db->select("*");
		
		// where clause
		if(!empty($where)) {
			$this->db->where(key($where), $where[key($where)]);
		}
		
		$this->db->from($table);
		return $this->db->count_all_results();
	} 
	//////////////////// END DATATABLE AJAX CRUD ///////////////////
	
	//////////////////// PAYMENT API CRUD ///////////////////////
	public function pay_sandbox($link) {
		//$api = 'http://moneywave.herokuapp.com/'.$link;
		$api = 'https://live.moneywaveapi.co/'.$link;
		return $api;
	}
	
	public function pay_token() {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/merchant/verify');
		$api_key = 'lv_BTDE1WQFPI3Q3K1V1LA3';
		$api_secret = 'lv_TB99GAPNQMK35OITXDXU9Y5XCFZ72J';
		$curl_data = array('apiKey'=>$api_key, 'secret'=>$api_secret);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
    	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_getbank($code, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		if($code == 'NGN') {
			$api_link = 'https://live.moneywaveapi.co/banks';
		} else {
			$api_link = 'https://live.moneywaveapi.co/banks?country='.$code;	
		}
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_validate($acc_no, $bank_code, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/resolve/account');
		$curl_data = array('account_number'=>$acc_no, 'bank_code'=>$bank_code);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_card_to_wallet($firstname, $lastname, $phonenumber, $email, $card_no, $cvv, $expiry_year, $expiry_month, $amount, $fee, $currency, $redirecturl, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/transfer');
		$recipient = 'wallet';
		$apiKey = 'ts_7GTTG1A0NI2W7QM7B8PT';
		$medium = 'web';
		
		$curl_data = array('firstname'=>$firstname, 'lastname'=>$lastname, 'phonenumber'=>$phonenumber, 'email'=>$email, 'recipient'=>$recipient, 'card_no'=>$card_no, 'cvv'=>$cvv, 'expiry_year'=>$expiry_year, 'expiry_month'=>$expiry_month, 'apiKey'=>$apiKey, 'amount'=>$amount, 'fee'=>$fee, 'redirecturl'=>$redirecturl, 'medium'=>$medium, 'chargeCurrency'=>$currency);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_verify($id, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/transfer/'.$id);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_wallet_to_account($amount, $bankcode, $accountNumber, $currency, $senderName, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/disburse');
		$lock = 'paratech';
		
		$curl_data = array('lock'=>$lock, 'amount'=>$amount, 'bankcode'=>$bankcode, 'accountNumber'=>$accountNumber, 'currency'=>$currency, 'senderName'=>$senderName);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_wallet_balance($token) {
		// create a new cURL resource
		$curl = curl_init();
		
		$curl_data = array('name'=>'Wallet');
		$curl_data = json_encode($curl_data);

		// parameters
		$api_link = $this->pay_sandbox('v1/wallet');
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		//curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_wallet_transaction($ref, $token) {
		// create a new cURL resource
		$curl = curl_init();
		
		$curl_data = array('ref'=>$ref);
		$curl_data = json_encode($curl_data);

		// parameters
		$api_link = $this->pay_sandbox('v1/disburse/status');
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}

	

	public function paystack($amount, $email)	{
		// Payment amount (to be multiplied by 100)
        $payment_amount = $amount * 100;

        // User email. Ideally, this will be fetched dynamically
        $user_email = $email;
        
        // Payment reference. That is, if you do not want to use paystack's supplied reference.
        $payment_reference = random_string('md5');
        
        // Add fields to Paystack form
        $this->paystack_lib->add_field('email', $user_email); // user email (required)
        $this->paystack_lib->add_field('amount', $payment_amount); // amount (required)

        $this->paystack_lib->add_field('callback_url', base_url('paystack-verify')); // callback (required for verifaction)
        $this->paystack_lib->add_field('reference', $payment_reference); // only if you do not want to use reference provided by paystack
        

        // Render Paystack form
        $this->paystack_lib->ps_auto_form();
	}

	
	//////////////////// END PAYMENT API CRUD ///////////////////////

	//////////////////// DATETIME ///////////////////////
	public function date_diff($now, $end, $type) {
		$now = new DateTime($now);
		$end = new DateTime($end);
		$date_left = $end->getTimestamp() - $now->getTimestamp();
		
		if($type == 'seconds') {
			if($date_left <= 0){$date_left = 0;}
		} else if($type == 'minutes') {
			$date_left = $date_left / 60;
			if($date_left <= 0){$date_left = 0;}
		} else if($type == 'hours') {
			$date_left = $date_left / (60*60);
			if($date_left <= 0){$date_left = 0;}
		} else if($type == 'days') {
			$date_left = $date_left / (60*60*24);
			if($date_left <= 0){$date_left = 0;}
		} else {
			$date_left = $date_left / (60*60*24*365);
			if($date_left <= 0){$date_left = 0;}
		}	
		
		return $date_left;
	}

	public function date_add($now, $plus) {
		$date_le = date(fdate, strtotime($now.' + '.$plus.' days'));
		return $date_le;
	}

	public function date_range1($firstDate, $col1, $secondDate, $col2,$col3, $val3, $table){
		$this->db->where($col1.'>=', $firstDate);
		$this->db->where($col2.'<=', $secondDate);
		$this->db->where($col3, $val3);
		 $query = $this->db->get($table);
		 if($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function date_range($firstDate, $col1, $secondDate, $col2, $table){
		$this->db->where($col1.'>=', $firstDate);
		$this->db->where($col2.'<=', $secondDate);
		 $query = $this->db->get($table);
		 if($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function date_range2($firstDate, $col1, $secondDate, $col2, $col3, $val3, $col4, $val4, $table){
		$this->db->where($col1.'>=', $firstDate);
		$this->db->where($col2.'<=', $secondDate);
		$this->db->where($col3, $val3);
		$this->db->where($col4, $val4);
		
		 $query = $this->db->get($table);
		 if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	//////////////////// END DATETIME ///////////////////////
	
	public function take_id_users($id)
	{
		$data = $this->db->where(['id'=>$id])
		        		 ->get("user");
		if ($data->num_rows() > 0) {
			return $data->row(); //take data based on the id with the number
		}
	}

	
	//////////////////// IMAGE UPLOAD CRUD ///////////////////////
	function do_upload($htmlFieldName, $path) {
        $config['file_name'] = time();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|tif|bmp|pdf|doc|docx|txt|mp3';
        $config['max_size'] = '10000';
        $config['max_width'] = '6000';
        $config['max_height'] = '6000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        unset($config);
        if (!$this->upload->do_upload($htmlFieldName)) {
            return array('error' => $this->upload->display_errors(), 'status' => 0);
        } else {
            $up_data = $this->upload->data();
			return array('status' => 1, 'upload_data' => $this->upload->data(), 'image_width' => $up_data['image_width'], 'image_height' => $up_data['image_height']);
        }
    }
	
	function resize_image($sourcePath, $desPath, $width = '500', $height = '500', $real_width='', $real_height='') {
        $this->image_lib->clear();
		$config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
		$config['width'] = $width;
        $config['height'] = $height;
		
		$dim = (intval($real_width) / intval($real_height)) - ($config['width'] / $config['height']);
		$config['master_dim'] = ($dim > 0)? "height" : "width";
		
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->resize())
            return true;
        return false;
    }
	
	function crop_image($sourcePath, $desPath, $width = '303', $height = '220') {
        $this->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;
		$config['x_axis'] = '20';
		$config['y_axis'] = '20';
        
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->crop())
            return true;
        return false;
    }

     public function audio_insertdata($htmlFieldName, $path=''){
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|mp3';
        $config['max_size']             = 0;
        $this->load->library('upload', $config);
        $this->upload->do_upload($htmlFieldName);
        $up_file = $this->upload->data();
        $up_audio=$up_file['file_name'];
        $data = array("play_list_audio"=>$up_audio);
        return $data;
    }		
	//////////////////// END IMAGE UPLOAD CRUD ///////////////////////	



	/////////////Pagination///////////
    public function getData(){
    	$query = $this->db->get('exams');
  		return $query->result();           // return the data 
    	
    }

    public function countData(){
    	return $this->db->count_all_results('exams');
    }

	///////////// End of Pagination///////////


	public function get_total(){
	   $this->db->select_sum('litres');
		$result = $this->db->get('sales_record')->row();  
		return $result->litres;
	}
}
