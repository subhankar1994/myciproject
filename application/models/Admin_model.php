<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
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

	function get_users($dataId = '' , $conditions = array(), $page_no = 1 , $limit = ADMIN_PAGE_LIMIT , $select = '*'){
		$start = 0;
		if($page_no == ''){
			$page_no = '*';
		}
		if($page_no !='*'){
			if($page_no == 0){
				$page_no = 1;
			}

			$start = ($page_no - 1) * $limit;
		}
		$this->db->select($select);
		$this->db->from('admin_users AU');
		if($dataId != ''){
			$this->db->where('AU.id', $dataId);
		}
		if(count($conditions) > 0){
			$this->db->where($conditions);
		}
		if($limit != 0){
			$this->db->limit($limit , $start);
		}
		$query = $this->db->get();
        // echo $this->db->last_query();
		$result = $query->result();
		return $result;
	}

}
?>