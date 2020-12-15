<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/header.css?ver=<?php echo rand(111,999)?>">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>vendor/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>1.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>1.css">
	<title>Quản lý sách</title>
</head>
<body>

  <div><?php require 'adminHeader.php'; ?></div>

  <div class="container">
    <div class="text-xs-center">
      <h4 class="display-3">Thêm mới sách</h4>
      <hr>
    </div>
  </div>

  <div class="container">
    <form method="POST" action="BookManager/addBook" autocomplete="off" enctype="multipart/form-data">
      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="title" class="col-sm-2 col-form-label text-xs-right">Title</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="title" placeholder="title" required>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="authors" class="col-sm-2 col-form-label text-xs-right">Authors</label>
            <div class="col-sm-10">
              <input type="text" name="authors" class="form-control" id="authors" placeholder="authors" required>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="language" class="col-sm-2 col-form-label text-xs-right">Language</label>
            <div class="col-sm-10">
              <select id="language" name="language" class="form-control" required>
                <option value="" disabled="true" selected="selected">Choose Language</option>
              </select>
              <div class="select-dropdown"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="num_page" class="col-sm-2 col-form-label text-xs-right">Pages</label>
            <div class="col-sm-10">
              <input type="number" name="num_page" class="form-control" id="num_page" placeholder="num pages" required>
            </div>
          </div>
        </div>
      </div> 

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="rating" class="col-sm-2 col-form-label text-xs-right">Rating</label>
            <div class="col-sm-10">
              <input type="text" name="rating" class="form-control" id="rating" placeholder="rating" required>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="publication_date" class="col-sm-2 col-form-label text-xs-right">Date</label>
            <div class="col-sm-10">
              <input type="date" name="publication_date" class="form-control" id="publication_date" placeholder="publication date" required>
            </div>
          </div>
        </div>
      </div>  

      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="publisher" class="col-sm-2 col-form-label text-xs-right">Publisher</label>
            <div class="col-sm-10">
              <input type="text" name="publisher" class="form-control" id="publisher" placeholder="publisher" required>
            </div>
          </div>
        </div>
      </div>  

      <div class="form-group row">
        <div class="col-sm-12">
          <div class="row">
            <label for="avatar" class="col-sm-1 col-form-label text-xs-right">Book Image</label>
            <div class="col-sm-11">
              <input type="file" name="book_image" class="form-control" id="book_image">
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
      <h4 class="display-3">Danh sách sách</h4>
      <hr>
    </div>
  </div>

  <div id="search-container">
      <div style="margin-left:150px;">
          <input id="input-search" type="text" placeholder="Search.." name="search">
          <button id="search-btn" type="submit" onClick="showResult()"><i class="fa fa-search"></i></button>
      </div>
  </div>


  <div id="search_result" style="overflow-x:auto;width:90%;margin:70px">
      <div id="num_books"><p><?php echo $num_books ?> quyển sách được hiển thị</p></div>
      <table id="table" class="search-table">
          <tr>
              <th class="title" onclick="sortTable(0)">Title</th>
              <th class="author" onclick="sortTable(1)">Authors</th>
              <th onclick="sortTable(2)">Language</th>
              <th onclick="sortTable(3)">Publication date</th>
              <th onclick="sortTable(4)">Quantity</th>
              <th onclick="sortTable(5)">Available</th>
              <th></th>
              <th></th>
          </tr>

          <?php foreach ($allbooks as $key => $value):?>

          <tr id="<?= $value['book_id']?>">
              <td class="title"><?= $value['title']?></td>
              <td class="author"><?= $value['authors']?></</td>
              <td><?= $value['language_name']?></</td>
              <td><?= $value['publication_date']?></</td>
              <td><?= $value['quantity']?></</td>
              <td><?= $value['available']?></</td>
              <td style="text-align: center">
                  <button class="btn btn-success" style="padding: 3px" onclick="editBook(this.parentNode.parentNode)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
              </td>

              <td style="text-align: center">
                  <button class="btn btn-success" style="padding: 3px;display: inline;" onclick="deleteBook(this.parentNode.parentNode)"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </td>
                  
              
          </tr>

          <?php endforeach ?>

      </table>
  </div>

  <script>
    function editBook(book) {
      var book_id = book.id;
      window.location.href = '<?php echo base_url() ?>BookManager/editBook/' + book_id;
    }

    function length(obj) {
      return Object.keys(obj).length;
    }

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
            var num_book = length(data);
            var string = "<p>Có " + num_book + " kết quả tìm kiếm</p>";
            var table = string;
            table += '<table id="table" class="search-table">';
            table += '<tr>';
            table += '<th class="title" onclick="sortTable(0)">Title</th>';
            table += '<th class="author" onclick="sortTable(1)">Authors</th>';
            table += '<th onclick="sortTable(2)">Language</th>';
            table += '<th onclick="sortTable(3)">Publication date</th>';
            table += '<th></th>';
            table += '<th></th>';

            data.forEach(function sumElement(element){
              table += '<tr id="' +element.book_id +'">';
              table += '<td class="title">'+ element.title +'</td>';
              table += '<td class="author">'+ element.authors +'</td>';
              table += '<td>'+ element.language_name +'</</td>';
              table += '<td>'+ element.publication_date +'</</td>';
              table += '<td style="text-align: center">';
              table += '<button class="btn btn-success" style="padding: 3px" onclick="editBook(this.parentNode.parentNode)"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
              table += '</td>';
              table += '<td style="text-align: center">';
              table += '<button class="btn btn-success" style="padding: 3px;display: inline;" onclick="deleteBook(this.parentNode.parentNode)"><i class="fa fa-trash" aria-hidden="true"></i></button>';
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
    function deleteBook(book) {
      var book_id = book.id;
      var td = book.getElementsByTagName('td');
      var ask = window.confirm("Are you sure to delete " + td[0].innerHTML);
      if (ask) {
        $.ajax({
          url: 'BookManager/deleteBook',
          type: 'POST',
          dataType: 'json',
          data: {book_id: book_id},
        })
        .done(function() {
          console.log("success");
        })  
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
          $('#' + book_id).remove();
        });
      } else {
      }
      
    }
  </script>

  <script>
    $.ajax({
      url: 'BookManager/getLanguage',
      type: 'POST',
      dataType: 'json',
      data: {param1: 'value1'},
    })
    .done(function(data) {
      console.log("success");
      data.forEach(function sumElement(element){
        var html = '<option value="'+element.language_code+'">'+element.language_name+'</option>';
        $('#language').append(html);
      });

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  </script>

  <script>
    var check = 0;
    function sortTable(a) {
      var table, rows, switching, i, x, y;
      table = document.getElementById("table");
      switching = true;
      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[a];
          y = rows[i + 1].getElementsByTagName("TD")[a];
          //check if the two rows should switch place:
          if(check == 0){
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              //if so, mark as a switch and break the loop:
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
            }
          } else {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              //if so, mark as a switch and break the loop:
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
            }
          }
          
        }
      }
      if(check == 0)
        check = 1;
      else
        check = 0;
    }
  </script>
	
</body>
</html>