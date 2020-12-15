<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/header.css?ver=<?php echo rand(111,999)?>">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>vendor/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>1.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>1.css">
</head>
<body>
  <div><?php require 'headerAfterLogin.php'; ?></div>

  <div class="container">
    <div class="text-xs-center">
      <h4 class="display-3">Sửa thông tin</h4>
      <hr>
    </div>
  </div>

  <div class="container">
    <form method="POST" action="<?php echo base_url() ?>UserAccount/saveChange" enctype="multipart/form-data">
      <div class="imgcontainer" style="margin-bottom: 20px">
          <img src="<?php echo base_url() . $avatar ?>" alt="Avatar" class="avatar" style="width: 400px; height: 400px;">
      </div>

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="full_name" class="col-sm-2 col-form-label text-xs-right">Full name</label>
            <div class="col-sm-10">
              <input type="text" name="full_name" class="form-control" id="full_name" value="<?php echo $full_name ?>" required>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="username" class="col-sm-2 col-form-label text-xs-right">Username</label>
            <div class="col-sm-10">
              <input type="text" name="username" class="form-control" id="username" value="<?php echo $user_name ?>" required>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="gender" class="col-sm-2 col-form-label text-xs-right">Gender</label>
            <div class="col-sm-10">
              <select id="gender" name="gender" class="form-control" required>
                <option value="" disabled="true" selected="selected">Choose Gender</option>
              </select>
              <div class="select-dropdown"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="email" class="col-sm-2 col-form-label text-xs-right">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" value="<?php echo $email ?>" required>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-12">
          <div class="row">
            <label for="avatar" class="col-sm-1 col-form-label text-xs-right">Avatar</label>
            <div class="col-sm-11">
              <input type="file" name="avatar" class="form-control" id="avatar">
              <input type="hidden" name="old-avatar" class="form-control" id="old-avatar" value="<?php echo $avatar ?>">
            </div>
          </div>
        </div>
      </div> 

      <div id="action-add" class="form-group row">
        <div class="col-sm-12 text-xs-right">
          <button type="submit" class="btn btn-outline-success">SAVE</button>
          <button type="reset" class="btn btn-outline-danger">RESET</button>
        </div>

      </div>

    </form>
    <hr>
  </div>

  <script>
  	var val = '<?php echo $gender ?>';
	  var sel = document.getElementById('gender');
    var html;
    if(val == 'Nam'){
      html = '<option value="Nam" selected="selected">Nam</option>';
      html += '<option value="Nữ">Nữ</option>';
    } else {
      html = '<option value="Nam">Nam</option>';
      html += '<option value="Nữ" selected="selected">Nữ</option>';
    }
	  
    $('#gender').append(html);
  </script>
	
</body>
</html>