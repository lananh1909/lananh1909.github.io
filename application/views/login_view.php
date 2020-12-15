<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login.css?ver=<?php echo rand(111,999)?>">
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<?php require('header.php'); ?>

	<div style="margin:50px">
      <form action="login/checkLogin" method="POST" autocomplete="off">
        <div class="imgcontainer">
          <img src="<?php echo base_url() ?>public/img_avatar2.png" alt="Avatar" class="avatar">
        </div>
      
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter username" name="user_name" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>

          <p id="user_error" style="display:none;color:red;">* Tài khoản không tồn tại</p>

          <button type="submit" name="btn_login">Login</button>
        </div>
      
        <div class="container" style="background-color:#f1f1f1">
          <button name="cancelbtn" onclick="window.location.href='<?php echo base_url() ?>'" type="button" class="cancelbtn">Cancel</button>
        </div>
      </form>  
    </div>

    <?php if($this->session->userdata('error')){
    	echo '<script>document.getElementById("user_error").style.display="block";</script>';
    	$this->session->unset_userdata('error');
    } ?>
	
</body>
</html>