<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login.css?ver=<?php echo rand(111,999)?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/signup.css?ver=<?php echo rand(111,999)?>">
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>

	<?php
        if(isset($_SESSION['user_id'])){
          if($_SESSION['permission'] == 0){
            require('headerAfterLogin.php');
          } else {
            header('Location: controller/admin');
          }
        } else {
          require('header.php');
        }
     ?>



	<div style="margin:50px">
        <form action="signup/checkSignup" style="border:1px solid #ccc" method="POST" autocomplete="off">
            <div class="container">
              <h1>Sign Up</h1>
              <p>Please fill in this form to create an account.</p>
              <hr>

              <label for="name"><b>Your name</b></label>
              <input type="text" placeholder="Enter Name" name="name" required>

              <label for="gender"><b>Giới tính</b></label>
              <select id="gender" name="gender" class="form-control" required>
                <option value="" disabled="true" selected="selected">Choose Gender</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
              </select>
              <div class="select-dropdown"></div>
          
              <label for="email"><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>

              <p id="email_error" style="display:none;color:red;">* Email này đã được sử dụng</p>

              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter username" name="username" required>

              <p id="user_error" style="display:none;color:red;">* Username đã tồn tại</p>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
          
              <label for="psw-repeat"><b>Repeat Password</b></label>
              <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
              <p id="password_error" style="display:none;color:red;">* Mật khẩu không trùng khớp</p>
          
              <p>By creating an account you agree to our <span style="color:dodgerblue">Terms & Privacy</span>.</p>

              <div class="clearfix">
                <button type="reset" class="cancelbtn">Cancel</button>
                <button name="btn_signup" type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
          </form>  
      </div>  

      <?php 
     	if($this->session->userdata('error_repsw')){
     		echo '<script>document.getElementById("password_error").style.display="block";</script>';
    		$this->session->unset_userdata('error_repsw');
     	}

     	if($this->session->userdata('error_email')){
     		echo '<script>document.getElementById("email_error").style.display="block";</script>';
    		$this->session->unset_userdata('error_email');
     	}

     	if($this->session->userdata('error_name')){
     		echo '<script>document.getElementById("user_error").style.display="block";</script>';
    		$this->session->unset_userdata('error_name');
     	} ?>    
	
</body>
</html>