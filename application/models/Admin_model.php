<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	//=======================Login=============================

	function login_verify($data)
	{
		$this->db->select('COUNT(*) AS counter , id');
		$this->db->from('admin_users');
		$this->db->where('password', $data["password"]);
		$this->db->where('uname', $data["u_name"]);
		$this->db->where('active', 1);
		$this->db->group_by('id'); 
		$query = $this->db->get();
		$result = $query->result();
		if($query->num_rows() > 0) {
			return $result[0];
		}else{
			return $result;
		}
	}

	function set_user_session($data){
		$data = array(
			'id' => $data->id,
			'uname' => $data->uname,
			'email' => $data->email,
			'f_name' => $data->f_name,
			'l_name' => $data->l_name,
			'phone' => $data->phone
		);
		$this->session->set_userdata($data);
	}

	//=======================Admin User==========================

	function get_users($dataId = '' , $conditions = array() , $select = '*'){
		$this->db->select($select);
		$this->db->from('admin_users AU');
		if($dataId != ''){
			$this->db->where('AU.id', $dataId);
		}
		if(count($conditions) > 0){
			$this->db->where($conditions);
		}
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	function user_add($data){
        $this->db->insert('admin_users', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    function user_update($user_id , $data){
        $this->db->where('id', $user_id);
        $this->db->update('admin_users', $data);
    }
	function get_user_existance($u_id , $u_name){
        $this->db->select('COUNT(*) AS counter');
        $this->db->from('admin_users');
        $this->db->where('id !=', $u_id);
        $this->db->where("( uname = '$u_name' OR email = '$u_name')", NULL , FALSE);
        $this->db->group_by('id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

}
?>