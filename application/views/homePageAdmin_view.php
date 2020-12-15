<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login.css?ver=<?php echo rand(111,999)?>">
  	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/bootstrap.css">
  	<link rel="stylesheet" href="<?php echo base_url() ?>vendor/font-awesome.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>


<body>
	<div><?php require('AdminHeader.php'); ?></div>

	<div class="container" style="margin-top: 100px">
			<div class="card-group">
					<div class="card">
						<div class="card-body">
		    				<h5 class="card-title">Số sách</h5>
		    				<p class="card-text">Tổng có <strong><?php echo $sumBooks ?></strong> quyển sách trong thư viện</p>
		    				<br>
		  				</div>

		  				<div class="card-footer">
					      	<small class="text-muted">Last updated <?php echo $lastUpdateBook ?></small>
					    </div>
					</div>

					<div class="card">
		  				<div class="card-body">
					        <h5 class="card-title">Số người dùng</h5>
					        <p class="card-text">Tổng người dùng <strong><?php echo $sumUser ?></strong></p>
					        <br>
		  				</div>

		  				<div class="card-footer">
					      	<small class="text-muted">Last updated <?php echo $lastUpdateUser ?></small>
					    </div>
					</div>

					<div class="card">
		  				<div class="card-body" style="height: 97.6px">
					        <h5 class="card-title">Số lượt mượn sách</h5>
					        <p class="card-text">Tổng số lượt mượn <strong><?php echo $sumBorrow ?></strong>, trong đó có <strong><?php echo $sumBorrowing ?></strong> sách đang mượn</p>
		  				</div>

		  				<div class="card-footer">
					      	<small class="text-muted">Last updated <?php echo $lastUpdateBorrow ?></small>
					    </div>
					</div>		
			</div>
	</div>
	

    <div class="container">
    	<div class="card-group">
  			<div class="card">
  				
			</div>

			

			
  		</div>
	</div>
</body>
</html>