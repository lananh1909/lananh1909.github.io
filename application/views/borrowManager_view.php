<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow Manager</title>
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
      <h4 class="display-3">Quản lý mượn sách</h4>
      <hr>
    </div>
  </div>

  <div class="container">
    <form method="POST" action="BorrowManager/addBorrow" enctype="multipart/form-data">
      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row">
            <label for="user_id" class="col-sm-2 col-form-label text-xs-right">User ID</label>
            <div class="col-sm-10">
              <input id="user_id" name="user_id" class="form-control" list="suggestions" placeholder="Select User" required>
              <datalist id="suggestions">
              </datalist>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <label for="book_id" class="col-sm-2 col-form-label text-xs-right">Book ID</label>
            <div class="col-sm-10">
              <input id="book_id" name="book_id" class="form-control" list="list-books" placeholder="Select Book" required>
              <datalist id="list-books">
              </datalist>
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
      <h4 class="display-3">Thống kê</h4>
      <hr>
    </div>
  </div>

  <div id="search-container">
    <form>
      <div class="row" style="margin-left: 150px">
          <div class="col-sm-2">
            <input class="col-sm-2 text-xs-right" type="radio" id="all" name="selection" value="3">
            <label class="col-sm-8" for="all">All</label>
          </div>

          <div class="col-sm-2">
            <input class="col-sm-2 text-xs-right" type="radio" id="borrowing" name="selection" value="0" checked="checked">
            <label class="col-sm-8" for="borrowing">Borrowing</label>
          </div>

          <div class="col-sm-2">
            <input class="col-sm-2 text-xs-right" type="radio" id="returned" name="selection" value="1">
            <label class="col-sm-8" for="returned">Returned</label>
          </div>

          <div class="col-sm-2">
            <input class="col-sm-2 text-xs-right" type="radio" id="outdate" name="selection" value="2">
            <label class="col-sm-8" for="outdate">Outdate</label>
          </div>
      </div>

      <div class="container" style="margin-top: 50px">
        <div class="form-group row">
          <div class="col-sm-6">
            <div class="row">
              <label for="user_id1" class="col-sm-2 col-form-label text-xs-right">User ID</label>
              <div class="col-sm-10">
                <input id="user_id1" name="user_id1" class="form-control" list="suggestions1" placeholder="Select User">
                <datalist id="suggestions1">
                </datalist>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <label for="book_id1" class="col-sm-2 col-form-label text-xs-right">Book ID</label>
              <div class="col-sm-10">
                <input id="book_id1" name="book_id1" class="form-control" list="list-books1" placeholder="Select Book">
                <datalist id="list-books1">
                </datalist>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6">
            <div class="row">
              <label for="from_date" class="col-sm-2 col-form-label text-xs-right">From</label>
              <div class="col-sm-10">
                <input type="date" id="from_date" name="from_date" class="form-control">
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="row">
              <label for="to_date" class="col-sm-2 col-form-label text-xs-right">To</label>
              <div class="col-sm-10">
                <input type="date" id="to_date" name="to_date" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <div id="action-add" class="form-group row">
          <div class="col-sm-12 text-xs-right">
            <button type="button" onclick="showResult()" class="btn btn-outline-success">Lọc</button>
            <button type="reset" class="btn btn-outline-danger">RESET</button>
          </div>
        </div>
      </div>
    </form>
  </div>


  <div id="search_result" style="overflow-x:auto;width:90%;margin:70px">
      <div id="num_borrow"><p><?php echo $num_borrow ?> kết quả được hiển thị</p></div>
      <table id="table" class="search-table">
          <tr>
              <th onclick="sortTable(0)">Borrow ID</th>
              <th class="title" onclick="sortTable(1)">Username</th>
              <th class="author" onclick="sortTable(2)">Book</th>
              <th onclick="sortTable(3)">Date Borrow</th>
              <th onclick="sortTable(4)">Due Date</th>
              <th></th>
              <th></th>
          </tr>

          <?php foreach ($all_borrow as $key => $value):?>

          <tr id="<?= $value['borrow_id']?>">
              <td><?= $value['borrow_id']?></td>
              <td><?= $value['user_name']?></td>
              <td id="<?php echo $value['book_id'] ?>"><?= $value['title']?></td>
              <td><?= $value['date_borrow']?></td>
              <td><?= $value['due_date']?></td>
              <td style="text-align: center">
                  <button class="btn btn-success" style="padding: 3px" onclick="returnBook(this.parentNode.parentNode)">Return</button>
              </td>

              <td style="text-align: center">
                  <button class="btn btn-success" style="padding: 3px;display: inline;" onclick="deleteBorrow(this.parentNode.parentNode)"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </td>
                  
              
          </tr>

          <?php endforeach ?>

      </table>
  </div>

  <script>
    $.ajax({
      url: 'BorrowManager/getUsers',
      type: 'POST',
      dataType: 'json',
      data: {},
    })
    .done(function(data) {
      console.log("success");
      data.forEach(function sumElement(element){
        var html = '<option value="'+element.user_id+'">'+element.full_name+'</option>';
        $('#suggestions').append(html);
        $('#suggestions1').append(html);
      });
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

    $.ajax({
      url: 'BorrowManager/getBooks',
      type: 'POST',
      dataType: 'json',
      data: {},
    })
    .done(function(data) {
      console.log("success");
      data.forEach(function sumElement(element){
        if(element.available == '0'){
          var html = '<option value="'+element.book_id+'" disabled>'+element.title+'</option>';
        } else {
          var html = '<option value="'+element.book_id+'">'+element.title+'</option>';
        }
        var html1 = '<option value="'+element.book_id+'">'+element.title+'</option>';
        
        $('#list-books').append(html);
        $('#list-books1').append(html1);
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

  <script>
    function returnBook(row) {
      var borrow_id = row.id;
      var td = row.getElementsByTagName('td');
      var book_id = td[2].id;
      var ask = window.confirm("Are you sure to return?");
      if (ask) {
        $.ajax({
          url: 'BorrowManager/returnBorrow',
          type: 'POST',
          dataType: 'json',
          data: {
            borrow_id: borrow_id,
            book_id: book_id
          },
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
          showResult();
          // var tr = document.getElementById('table').getElementsByTagName('tr');
          // var string = "<p>Có " + (tr.length-1) + " kết quả tìm kiếm</p>";
          // $('#num_borrow').html(string);
        });
      } else {
      }
    }  

    function deleteBorrow(row) {
      var borrow_id = row.id;
      var td = row.getElementsByTagName('td');
      var book_id = td[2].id;
      var ask = window.confirm("Are you sure to delete?");
      if (ask) {
        $.ajax({
          url: 'BorrowManager/deleteBorrow',
          type: 'POST',
          dataType: 'json',
          data: {
            borrow_id: borrow_id,
            book_id: book_id
          },
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
          $('#' + borrow_id).remove();
        });
      } else {
      }
    }
  </script>

  <script>
    function length(obj) {
      return Object.keys(obj).length;
    }

    function showResult() {
      var selection = document.querySelector('input[name="selection"]:checked').value;
      var user_id = document.getElementById('user_id1').value;
      var book_id = document.getElementById('book_id1').value;
      var from_date = document.getElementById('from_date').value;
      var to_date = document.getElementById('to_date').value;

      $.ajax({
        url: 'BorrowManager/findBorow',
        type: 'POST',
        dataType: 'json',
        data: {
          selection : selection,
          user_id : user_id,
          book_id : book_id,
          from_date : from_date,
          to_date : to_date
        },
      })
      .done(function(data) {
        console.log("success");
        var num_borrow = length(data);
        var string = "<p>" + num_borrow + " kết quả được hiển thị</p>";
        var table = string;
        table += '<table id="table" class="search-table">';
        table += '<tr>';
        table += '<th onclick="sortTable(0)">Borrow ID</th>';
        table += '<th class="title" onclick="sortTable(1)">Username</th>';
        table += '<th class="author" onclick="sortTable(2)">Book</th>';
        table += '<th onclick="sortTable(3)">Date Borrow</th>';
        table += '<th onclick="sortTable(4)">Due Date</th>';
        table += '<th></th>';
        table += '<th></th>';

        data.forEach(function sumElement(element){
          table += '<tr id="' +element.borrow_id +'">';
          table += '<td>'+ element.borrow_id +'</td>';
          table += '<td>'+ element.user_name +'</td>';
          table += '<td>'+ element.title +'</td>';
          table += '<td>'+ element.date_borrow +'</td>';
          table += '<td>'+ element.due_date + '</td>';
          table += '<td style="text-align: center">';
          if(element.state == '1'){
            table += '<button class="btn btn-success" style="padding: 3px" disabled>Return</button>';
          } else {
            table += '<button class="btn btn-success" style="padding: 3px" onclick="returnBook(this.parentNode.parentNode)">Return</button>';
          }
          table += '</td>';
          table += '<td style="text-align: center">';
          table += '<button class="btn btn-success" style="padding: 3px;display: inline;" onclick="deleteBorrow(this.parentNode.parentNode)"><i class="fa fa-trash" aria-hidden="true"></i></button>';
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
      });
      
    }

    $('input[type="radio"]').click(function(){  
          showResult();
    });

    $("#user_id1").on('change', function(){
        showResult();
    });

    $("#book_id1").on('change', function(){
        showResult();
    });

    $("#from_date").on('change', function(){
        showResult();
    });
    $("#to_date").on('change', function(){
        showResult();
    });

  </script>
</body>
</html>