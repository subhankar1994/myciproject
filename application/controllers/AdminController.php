<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class AdminController extends REST_Controller{

	function __construct()
	{
        // Construct the parent class
		parent::__construct();
		//$this->load->library('form_validation');
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
                $get_user_data = $this->Admin_model->get_users($flag->id , array() , 1 , 1, 'AU.*');
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

}
?>