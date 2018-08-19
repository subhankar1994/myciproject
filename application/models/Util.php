<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Util extends CI_Model{

	public function return_form_validation_error($input)
	{
		$output = array();
		foreach ($input as $key => $value)
		{
			$output[$key] = form_error($key);
		}
		return $output;
	}

	public function loginValidate(){
        if($this->session->userdata('id') != ''){
            return true;
        }else{
            return false;
        }
    }
}

?>