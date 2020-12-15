<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trang chủ</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login.css?ver=<?php echo rand(111,999)?>">
    <link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>

	<?php
        if(isset($_SESSION['user_id'])){
            require('headerAfterLogin.php');
        } else {
          require('header.php');
        }
      ?>

      <section>
        <div id="search-container">
	        <div style="margin-left:150px;">
	            <input id="input-search" type="text" placeholder="Search.." name="search">
	            <button id="search-btn" type="submit" onClick="showResult()"><i class="fa fa-search"></i></button>
	        </div>
	    </div>

    
        <div id="search_result" style="overflow-x:auto;width:90%;margin:70px">
            <table id="table" class="search-table">
                <tr>
                    <th class="title">Title</th>
                    <th class="author">Authors</th>
                    <th>Language</th>
                    <th>Publication date</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php foreach ($allbooks as $key => $value):?>

                <tr id="<?= $value['book_id']?>">
                    <td class="title"><?= $value['title']?></td>
                    <td class="author"><?= $value['authors']?></</td>
                    <td><?= $value['language_name']?></</td>
                    <td><?= $value['publication_date']?></</td>
                    <td style="text-align: center">
                        <button style="padding: 3px" onclick="addBorrow(this.parentNode.parentNode)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </td>

                    <td>
                        <button style="padding: 3px;display: inline;" onclick="myFunc(this.parentNode.parentNode)"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                    </td>
                        
                    
                </tr>

                <?php endforeach ?>

            </table>
        </div>  
        <div id="action">
            <button id="btn_back" onclick="showResult()">BACK</button>
            <button id="btn_add" onclick="window.location.href='<?php base_url() ?>MuonSach'">ADD</button>
        </div>
      </section>

      <<script>
      	function myFunc(row){
      		var book_id = row.id;
      		window.location.href = '<?php echo base_url() ?>HomePage/getBookDetail/' + book_id;
            
        }
      </script>


      <script>

        function showResult() {
        	var key = document.getElementById("input-search").value;
            $.ajax({
            	url: 'homePage/findBook',
            	type: 'POST',
            	dataType: 'json',
            	data: {keyword: key},
            })
            .done(function(data) {
            	console.log("success");
            	var table = '<table id="table" class="search-table">';
            	table += '<tr>';
            	table += '<th class="title">Title</th>';
            	table += '<th class="author">Authors</th>';
            	table += '<th>Language</th>';
            	table += '<th>Publication date</th>';
                table += '<th></th>';
                table += '<th></th>';

            	data.forEach(function sumElement(element){
				    table += '<tr id="' +element.book_id +'">';
	            	table += '<td class="title">'+ element.title +'</td>';
	            	table += '<td class="author">'+ element.authors +'</td>';
	            	table += '<td>'+ element.language_name +'</</td>';
	            	table += '<td>'+ element.publication_date +'</</td>';
                    table += '<td style="text-align: center">';
                    table += '<button style="padding: 3px" onclick="addBorrow(this.parentNode.parentNode)"><i class="fa fa-plus" aria-hidden="true"></i></button>';
                    table += '</td>';
                    table += '<td style="text-align: center">';
                    table += '<button style="padding: 3px" onclick="myFunc(this.parentNode.parentNode)"><i class="fa fa-info-circle" aria-hidden="true"></i></button>';
                    table += '</td>';
	            	table += '</tr>';
				});
				table += '</table>';
				$('#search_result').html(table);
            	$('#action').hide();
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
        function addBorrow(row) {
            var row_id = row.id;
            window.location.href = '<?php echo base_url() ?>' + 'HomePage/addBorrow/' + row_id;            
        }
    </script>
	
</body>
</html>

            