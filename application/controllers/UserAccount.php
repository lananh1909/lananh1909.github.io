<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAccount extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userAccount_model');
	}

	public function index()
	{
		
		$data = $this->userAccount_model->getUserDetail($this->session->userdata('user_id'));
		$this->load->view('user_detail_view', $data[0], FALSE);
	}

	public function saveChange()
	{
		if(empty($_FILES["avatar"]["name"])){
			$avatarurl = $this->input->post('old-avatar');
		} else {
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($_FILES["avatar"]["tmp_name"]);
			  if($check !== false) {
			    //echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
			  } else {
			    echo '<script>alert("File is not an image.")</script>';
			    redirect(base_url(). 'UserAccount','refresh');
			    $uploadOk = 0;
			  }
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			  $avatarurl = 'uploads/'. basename($_FILES["avatar"]["name"]);
			}

			// Check file size
			if ($_FILES["avatar"]["size"] > 500000) {
			  echo '<script>alert("Sorry, your file is too large.")</script>';
			  redirect(base_url(). 'UserAccount','refresh');
			  $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
			  redirect(base_url(). 'UserAccount','refresh');
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo '<script>alert("Sorry, your file was not uploaded.")</script>';
			  redirect(base_url(). 'UserAccount','refresh');
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
			    //echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
			  } else {
			    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
			   	$uploadOk = 0;
			  }
			}
			if($uploadOk == 1){
				$avatarurl = 'uploads/'. basename($_FILES["avatar"]["name"]);
			}
		}	
				
		$user_id = $this->session->userdata('user_id');
		$full_name = $this->input->post('full_name');
		$user_name = $this->input->post('username');
		$gender = $this->input->post('gender');
		$email = $this->input->post('email');

		$permission = 0;
		if($this->userAccount_model->saveUser($user_id, $full_name, $user_name, $gender, $email, $permission, $avatarurl)){
			echo '<script>alert("Your changes are saved!")</script>';
        	redirect(base_url().'UserAccount' ,'refresh');
		} else {
			echo '<script>alert("Email or username existed!")</script>';
        	redirect(base_url().'UserAccount' ,'refresh');
		}
		
	}

}

/* End of file UserAccount.php */
/* Location: ./application/controllers/UserAccount.php */