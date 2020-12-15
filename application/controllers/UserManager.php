<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userAccount_model');
	}

	public function index()
	{
		$users = $this->userAccount_model->getAllUser(0);
		$count = count($users);
		$users = array(
			'allusers' => $users,
			'num_users' => $count
		);
		$this->load->view('userManager_view', $users, FALSE);
	}

	public function addUser()		
	{
		$user_name = addslashes($this->input->post('username'));
		$fullname = addslashes($this->input->post('full_name'));
		$gender = addslashes($this->input->post('gender'));
		$email = addslashes($this->input->post('email'));
		if($this->input->post('permission') != null){
			$permission = 1;
		} else {
			$permission = 0;
		}

		$password = md5(addslashes($this->input->post('password')));
		$rePassword = md5(addslashes($this->input->post('re_password')));
		$check1 = $this->userAccount_model->checkEmailExists($email);
		$check2 = $this->userAccount_model->checkUserExists($user_name);
		if($password != $rePassword){			
			echo '<script>alert("Mật khẩu không trùng khớp!")</script>';
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		} else {
			if ($check1) {
                echo '<script>alert("Email đã tồn tại!")</script>';
                redirect($_SERVER['HTTP_REFERER'],'refresh');
            }
            if ($check2){
                echo '<script>alert("Username đã tồn tại!")</script>';
                redirect($_SERVER['HTTP_REFERER'],'refresh');
            }
            if (!$check1 && !$check2 ){
                $result = $this->userAccount_model->addAccountToDatabase($user_name, $gender, $email, $fullname, $password, $permission);

                if($result){
                	echo '<script>alert("Insert successfully!")</script>';
                	redirect(base_url(). 'UserManager','refresh');
                }
            } 
		}
	}

	public function findUser()
	{
		$name = $this->input->post('keyword');
		$permission = $this->input->post('permission');
		$result = array();
		if($name == ''){
			$result = $this->userAccount_model->getAllUser($permission);
		} else {
			$result = $this->userAccount_model->findUserByName($name, $permission);
		}

		$result = json_encode($result);
		echo $result;
	}

	public function deleteUser()
	{
		$user_id = $this->input->post('user_id');
		$this->userAccount_model->deleteUser($user_id);
	}

	public function editUser($user_id)
	{
		$data = $this->userAccount_model->getUserDetail($user_id);
		$this->load->view('editUser_view', $data[0], FALSE);
	}

	public function saveChange($user_id)
	{
		$full_name = $this->input->post('full_name');
		$user_name = $this->input->post('username');
		$gender = $this->input->post('gender');
		$email = $this->input->post('email');
		$permission = $this->input->post('permission');
		$avatar = $this->input->post('avatar');
		if($this->userAccount_model->saveUser($user_id, $full_name, $user_name, $gender, $email, $permission, $avatar)){
			echo '<script>alert("Your changes are saved!")</script>';
        	redirect(base_url(). 'UserManager','refresh');
		} else {
			echo '<script>alert("Email or username existed!")</script>';
        	redirect(base_url().'UserAccount/editUser/' . $user_id ,'refresh');
		}
		
	}

}

/* End of file UserManager.php */
/* Location: ./application/controllers/UserManager.php */