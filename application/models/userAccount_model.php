<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class userAccount_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkLogin($username, $password)
	{
		$this->db->select('*');
		$this->db->where('user_name', $username);
		$this->db->where('pass_word', $password);
		$result = $this->db->get('user_account');
		$result = $result->result_array();
		return $result;
	}

	public function checkEmailExists($email)
	{
		$this->db->select('*');
		$this->db->where('email', $email);
		$result = $this->db->get('user_account');
		$result = $result->result_array();
		return $result;
	}

	public function checkUserExists($user_name)
	{
	    $this->db->select('*');
	    $this->db->where('user_name', $user_name);
	    $result = $this->db->get('user_account');
	    $result = $result->result_array();
		return $result;
	}

	public function addAccountToDatabase($username, $gender, $email, $fullname, $password, $permission)
	{
		$data = array(
			'user_name' => $username,
			'gender' => $gender,
			'email' => $email,
			'full_name' => $fullname,
			'pass_word' => $password,
			'permission' => $permission
		);
		$this->db->set('create_date', 'NOW()', FALSE);
		$this->db->set('last_update', 'NOW()', FALSE);
		$this->db->insert('user_account', $data);
		return $this->db->insert_id();
	}

	public function countUser()
	{
		$this->db->select('count(user_id)');
		$this->db->where('permission', 0);
		$result = $this->db->get('user_account');
		$result = $result->result_array();
		return $result;
	}

	public function getLastUpdateUser()
	{
		$this->db->select('max(last_update)');
		$result = $this->db->get('user_account');
		$result = $result->result_array();
		return $result;
	}

	public function getAllUser($permission)
	{
		$this->db->select('*');
		$this->db->where('permission', $permission);
		$this->db->order_by('last_update', 'desc');
		$result = $this->db->get('user_account');
		$result = $result->result_array();
		return $result;
	}

	public function findUserByName($name, $permission)
	{
		$this->db->select('*');
		$this->db->where("full_name like '%" . $name . "%'");
		$this->db->where('permission', $permission);
		$this->db->order_by('last_update', 'desc');
		$result = $this->db->get('user_account');
		$result = $result->result_array();
		return $result;
	}

	public function deleteUser($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('borrow');
		$this->db->where('user_id', $user_id);
		$this->db->delete('user_account');
	}

	public function saveUser($user_id, $full_name, $user_name, $gender, $email, $permission, $avatar)
	{
		$data = array(
			'full_name' => $full_name, 
			'user_name' => $user_name,
			'gender' => $gender, 
			'email' => $email, 
			'permission' => $permission,
			'avatar' => $avatar
		);

		$this->db->where('user_id', $user_id);
		$this->db->set('last_update', 'NOW()', FALSE);
		if(!$this->db->update('user_account', $data)){
		   $error = $this->db->error();
		   if($error['code'] == 1062){
		      return FALSE;
		   }
		}
		return TRUE;
	}

	public function getUserDetail($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$user = $this->db->get('user_account');
		$user = $user->result_array();
		return $user;
	}

}

/* End of file userAccount_model.php */
/* Location: ./application/models/userAccount_model.php */