<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="styles.css" >
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
<?php  require('../config/connect.php'); ?>
<div class="container">
	<div class="row">
	<?php
  		$logosql = "SELECT * FROM settings WHERE name='logo'";
  		$logores = mysqli_query($connection, $logosql);
  		$logor = mysqli_fetch_assoc($logores);
  	?>
		<div class="col-md-4"><a href="index.php"><img src="../<?php echo $logor['value']; ?>"></a></div>
		<div class="col-md-8"></div>
	</div>