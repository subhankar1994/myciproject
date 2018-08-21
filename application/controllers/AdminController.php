<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class AdminController extends REST_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('utility_helper');
		$this->load->model('Admin_model');
		$this->load->model('Util');
		$this->load->model('Response');
	}

	//=================== Index =============================

	public function index_get(){
		redirect(base_url("AdminController/dashboard"));
	}

	//================== Admin Login =========================

	public function redirect_login(){
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control:s no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->driver('cache');
        $this->db->cache_delete_all();
        $this->session->sess_destroy();
        redirect(base_url("admin/login"));
    }

	public function login_get(){
		if($this->Util->loginValidate()){
			redirect(base_url("admin/dashboard"));
		}else{
			return $this->load->view('admin/login');
	    }
	}

	public function login_post(){
		$u_name = trim($this->post('u_name'));
        $password = trim($this->post('password'));
        $this->form_validation->set_rules('u_name', 'User name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        if($this->form_validation->run()){
        	$data = array();
        	$dataReturn = array();
        	$data["u_name"] = $u_name;
            $data["password"] = md5($password);
            $flag = $this->Admin_model->login_verify($data);
            if(!empty($flag) && $flag->counter > 0){
                $get_user_data = $this->Admin_model->get_users($flag->id , array() , 'AU.*');
                if(isset($get_user_data[0]->id)){
                    $this->Admin_model->set_user_session($get_user_data[0]);
                }
                $dataReturn["status"] = true;
            }else{
            	$dataReturn["status"] = false;
            	$dataReturn["error"] = 'Invalid Login';
            }
        }else{
        	$output = $this->Util->return_form_validation_error($this->input->post());
            $dataReturn["status"] = false;
            $dataReturn["error"] = $output;
        }
        $this->response($this->Response->api_generic_response($dataReturn), 200);
	}

	//====================Logout=============================

	public function logout_get(){
		$this->session->sess_destroy();
        redirect(base_url('admin/'));
	}

	//=====================Dashboard==========================

	public function dashboard_get(){
		if($this->Util->loginValidate()){
			$data['title'] = 'Dashboard';
			$data['description'] = 'Dashboard';
			$data['keyword'] = 'Dashboard';
			$data['main_content'] = 'admin/pages/dashboard';
			return $this->load->view('admin_template', $data);
	  	}else{
	  		$this->redirect_login();
	  	}
	}

	//====================Admin Users=======================

	public function users_get(){
		if($this->Util->loginValidate()){
			$data['title'] = 'Users';
			$data['description'] = 'Users';
			$data['keyword'] = 'Users';
			$data['users'] = $this->Admin_model->get_users('',array(),'AU.*');;
			$data['main_content'] = 'admin/pages/users';
			return $this->load->view('admin_template', $data);
	  	}else{
	  		$this->redirect_login();
	  	}

	}

	public function add_user_get(){
		if($this->Util->loginValidate()){
			$data['title'] = 'Add User';
			$data['description'] = 'Add User';
			$data['keyword'] = 'Add User';
			$data['main_content'] = 'admin/pages/add_user';
			return $this->load->view('admin_template', $data);
	  	}else{
	  		$this->redirect_login();
	  	}
	}

	public function save_user_post(){
		$u_name = $this->post('u_name');
		$f_name = $this->post('f_name');
        $l_name = $this->post('l_name');
        $email = $this->post('email');
        $password = $this->post('password');
        $phone = $this->post('phone');
        $user_id = $this->post('user_id');
		$dataReturn = array();
		$this->form_validation->set_rules('f_name', 'First name', 'required|trim|xss_clean|alpha');
    	$this->form_validation->set_rules('l_name', 'Last name', 'required|trim|xss_clean|alpha');
    	$this->form_validation->set_rules('phone', 'Phone no', 'required|trim|xss_clean|integer');
    	if($user_id){
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|callback_is_unique_email['.$user_id.']');
            $this->form_validation->set_rules('u_name', 'Username', 'required|trim|xss_clean|callback_is_unique_uname['.$user_id.']');
        }else{
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[admin_users.email]');
            $this->form_validation->set_rules('u_name', 'Username', 'required|trim|xss_clean|is_unique[admin_users.uname]');
        }
        if($this->form_validation->run()){
        	$data = array();
	        $data["uname"] = trim($u_name);
	        $data["phone"] = trim($phone);
	        $data["email"] = trim($email);
	        $data["f_name"] = trim($f_name);
	        $data["l_name"] = trim($l_name);
	        $data["password"] = md5($password);
	        if($user_id){
	        	$this->Admin_model->user_update($user_id , $data);
                $id =$user_id;
	        }else{
	        	$id = $this->Admin_model->user_add($data);
	        }
	        if($id){
	        	$dataReturn["id"] = $id;
                $dataReturn["status"] = true;
	        }else{
	        	$dataReturn["status"] = false;
	        }
        }else{
        	$output = $this->Util->return_form_validation_error($this->input->post());
            $dataReturn["status"] = false;
            $dataReturn["error"] = $output;
        }
        $this->response($this->Response->api_generic_response($dataReturn), 200);
	}

	function is_unique_uname($uname , $user_id)
    {
        if($this->Admin_model->get_user_existance($user_id , $uname)[0]->counter > 0){
            $this->form_validation->set_message('is_unique_uname', 'This username already used.');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    function is_unique_email($uname , $user_id)
    {
        if($this->Admin_model->get_user_existance($user_id , $uname)[0]->counter > 0){
            $this->form_validation->set_message('is_unique_email', 'This email already used.');
            return FALSE;
        }else{
            return TRUE;
        }
    }

}
?>