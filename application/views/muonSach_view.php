<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mượn sách</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login.css?ver=<?php echo rand(111,999)?>">
	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>

	<?php if(!isset($_SESSION['user_id'])){
		redirect(base_url() . 'Login','refresh');} ?>


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

    <div style="margin: 50px">
    	<h2>Danh sách sách mượn</h2>
    </div>

    <div id="books_borrow" style="overflow-x:auto;width:90%;margin:70px">
    	<table id="table" class="search-table">
    		<tr>
    			<th class="title">Title</th>
    			<th class="author">Authors</th>
    			<th>Language</th>
    			<th>Publication date</th>
    			<th></th>
    		</tr>
    		<?php foreach ($danhsachsachmuon as $key => $value): ?>
    			<tr id="<?= $key?>">
    				<td class="title"><?= $value[0]['title']?></td>
                    <td class="author"><?= $value[0]['authors']?></</td>
                    <td><?= $value[0]['language_name']?></</td>
                    <td><?= $value[0]['publication_date']?></</td>
                    <td style="text-align: center"><button style="padding: 3px" onclick="deleteRow(this.parentNode.parentNode)"><i class="fa fa-trash"></i></button></td>
    			</tr>
    			
    		<?php endforeach ?>
    		
    	</table>
    </div>

    <form action="MuonSach/actionControl" method="POST" id="action" style="display:block;border:none">
        <button id="btn_back" name="back">BACK</button>
        <button id="btn_add" name="sent">SENT</button>
  	</form>

  	<script>
  		function deleteRow(row) {
  			var id = row.id;
  			console.log(id);
  			$.ajax({
  				url: 'MuonSach/deleteRow',
  				type: 'POST',
  				dataType: 'json',
  				data: {row_id: id},
  			})
  			.done(function() {
  				console.log("success");
  			})
  			.fail(function() {
  				console.log("error");
  			})
  			.always(function() {
  				console.log("complete");
  				$('#' + id).remove();
  			});
  			
  		}
  	</script>
</body>
</html>