<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quản lý người dùng</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/header.css?ver=<?php echo rand(111,999)?>">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>vendor/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>1.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>1.css">
</head>
<body>
  <div><?php require 'adminHeader.php'; ?></div>

  <div class="container">
    <div class="text-xs-center">
      <h4 class="display-3">Thêm mới người dùng</h4>
      <hr>
    </div>
  </div>

  <div class="container">
    <form method="POST" action="UserManager/addUser" autocomplete="off">
      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="full_name" class="col-sm-2 col-form-label text-xs-right">Full name</label>
            <div class="col-sm-10">
              <input type="text" name="full_name" class="form-control" id="full_name" placeholder="your full name" required>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="username" class="col-sm-2 col-form-label text-xs-right">Username</label>
            <div class="col-sm-10">
              <input type="text" name="username" class="form-control" id="username" placeholder="username" required>
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
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
              </select>
              <div class="select-dropdown"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="email" class="col-sm-2 col-form-label text-xs-right">Email</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" placeholder="email" required>
            </div>
          </div>
        </div>
      </div> 

      <div class="form-group row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-1 text-xs-right">
              <input type="checkbox" id="permission" name="permission" value="1">
            </div>
            <label class="col-sm-11" for="permission">Tài khoản admin</label>
          </div>
        </div>
        
      </div>

      <div class="form-group row">
        <div class="col-sm-12">
          <div class="row">
            <label for="password" class="col-sm-1 col-form-label text-xs-right">Password</label>
            <div class="col-sm-11">
              <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
            </div>
          </div>
        </div>
        
      </div>  

      <div class="form-group row">
        <div class="col-sm-12">
          <div class="row">
            <label for="re_password" class="col-sm-1 col-form-label text-xs-right">Repeat Password</label>
            <div class="col-sm-11">
              <input type="password" name="re_password" class="form-control" id="re_password" placeholder="Repeat password" required>
            </div>
          </div>
        </div>
      </div>   

      <div id="action-add" class="form-group row">
        <div class="col-sm-12 text-xs-right">
          <button type="submit" class="btn btn-outline-success">ADD</button>
          <button type="reset" class="btn btn-outline-danger">RESET</button>
        </div>

      </div>

    </form>
    <hr>
  </div>

  <div class="container">
    <div class="text-xs-center">
      <h4 class="display-3">Danh sách người dùng</h4>
      <hr>
    </div>
  </div>

  <div id="search-container">
      <div class="row" style="margin-left: 150px">
          <div class="col-sm-2">
            <input class="col-sm-2 text-xs-right" type="radio" id="user" name="kind-user" value="0" checked="checked">
            <label class="col-sm-8" for="user">User</label>
          </div>

          <div class="col-sm-2">
            <input class="col-sm-2 text-xs-right" type="radio" id="admin" name="kind-user" value="1">
            <label class="col-sm-8" for="admin">Admin</label>
          </div>
      </div>
      <div style="margin-left:150px;">
          <input id="input-search" type="text" placeholder="search by name.." name="search">
          <button id="search-btn" type="submit" onClick="showResult()"><i class="fa fa-search"></i></button>
      </div>
  </div>



  <div id="search_result" style="overflow-x:auto;width:90%;margin:70px">
  	  <div id="num_users"><p>Có <?php echo $num_users ?> kết quả tìm kiếm</p></div>
      <table id="table" class="search-table">
          <tr>
              <th>UserID</th>
              <th>Fullname</th>
              <th>Username</th>
              <th>Gender</th>
              <th>Email</th>
              <th></th>
              <th></th>
          </tr>

          <?php foreach ($allusers as $key => $value):?>

          <tr id="<?= $value['user_id']?>">
          	  <td><?= $value['user_id']?></td>
              <td><?= $value['full_name']?></td>
              <td><?= $value['user_name']?></td>
              <td><?= $value['gender']?></td>
              <td><?= $value['email']?></td>
              <td style="text-align: center">
                  <button class="btn btn-success" style="padding: 3px" onclick="editUser(this.parentNode.parentNode)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
              </td>

              <td style="text-align: center">
                  <button class="btn btn-success" style="padding: 3px;display: inline;" onclick="deleteUser(this.parentNode.parentNode)"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </td>
                  
              
          </tr>

          <?php endforeach ?>

      </table>
  </div>

  <script>
    function editUser(user) {
      var user_id = user.id;
      window.location.href = '<?php echo base_url() ?>UserManager/editUser/' + user_id;
    }

    function length(obj) {
    	return Object.keys(obj).length;
	}

      function showResult() {
        var key = document.getElementById("input-search").value;
        var permission = document.querySelector('input[name="kind-user"]:checked').value;
          $.ajax({
            url: 'UserManager/findUser',
            type: 'POST',
            dataType: 'json',
            data: {keyword: key, permission: permission},
          })
          .done(function(data) {
            console.log("success");
            var num_users = length(data);
            var string = '<div id="num_users"><p>Có ' + num_users + ' kết quả tìm kiếm</p></div>'
            var table = string;
            table += '<table id="table" class="search-table">';
            table += '<tr>';
            table += '<th>UserID</th>';
            table += '<th>Fullname</th>';
            table += '<th>Username</th>';
            table += '<th>Gender</th>';
            table += '<th>Email</th>';
            table += '<th></th>';
            table += '<th></th>';

            data.forEach(function sumElement(element){
              table += '<tr id="' +element.user_id +'">';
              table += '<td>'+ element.user_id +'</td>';
              table += '<td>'+ element.full_name +'</td>';
              table += '<td>'+ element.user_name +'</td>';
              table += '<td>'+ element.gender +'</td>';
              table += '<td>'+ element.email +'</td>';
              table += '<td style="text-align: center">';
              table += '<button class="btn btn-success" style="padding: 3px" onclick="editUser(this.parentNode.parentNode)"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
              table += '</td>';
              table += '<td style="text-align: center">';
              table += '<button class="btn btn-success" style="padding: 3px;display: inline;" onclick="deleteUser(this.parentNode.parentNode)"><i class="fa fa-trash" aria-hidden="true"></i></button>';
              table += '</td>';
              table += '</tr>';
            });
            table += '</table>';
            $('#search_result').html(table);
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
              console.log(key);
          });
          
        }
  </script>


  <script>
    function deleteUser(user) {
      var user_id = user.id;
      var td = user.getElementsByTagName('td');
      var ask = window.confirm("Are you sure to delete " + td[2].innerHTML);
      if (ask) {
        $.ajax({
          url: 'UserManager/deleteUser',
          type: 'POST',
          dataType: 'json',
          data: {user_id: user_id},
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
          $('#' + user_id).remove();
          var tr = document.getElementById('table').getElementsByTagName('tr');
          var string = "<p>Có " + (tr.length-1) + " kết quả tìm kiếm</p>";
          $('#num_users').html(string);
        });
      } else {
      }
      
    }
  </script>

  <script>
    $('input[type="radio"]').click(function(){  
          showResult();
    });
  </script>

	
</body>
</html>