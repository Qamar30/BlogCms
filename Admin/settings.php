<?php
session_start();
require('../config/connect.php');

if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_POST) & !empty($_POST)){
	//print_r($_POST);
	$sitename = mysqli_real_escape_string($connection, $_POST['sitename']);
	$ad = mysqli_real_escape_string($connection, $_POST['ad']);
	$perpage = mysqli_real_escape_string($connection, $_POST['perpage']);

	if(isset($_FILES) & !empty($_FILES)){
		$name = $_FILES['logo']['name'];
		$size = $_FILES['logo']['size'];
		$type = $_FILES['logo']['type'];
		$tmp_name = $_FILES['logo']['tmp_name'];

		$max_size = 10000000;
		$extension = substr($name, strpos($name, '.') + 1);

		if(isset($name) && !empty($name)){
			if(($extension == "jpg" || $extension == "jpeg" || $extension == "png") && $extension == $size<=$max_size){
				$location = "../img/";
				if(move_uploaded_file($tmp_name, $location.$name)){
					$smsg = "Uploaded Successfully";

					$sql = "UPDATE settings SET value='img/$name'WHERE name='logo'";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				}else{
					$fmsg = "Failed to Upload File";
				}
			}else{
				$fmsg = "File size should be 10,000 KiloBytes & Only JPEG File";
			}
		}else{
			$fmsg = "Please Select a File";
		}
	}

	$sql = "UPDATE settings SET value='$sitename'WHERE name='sitename'";
	$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

	$sql = "UPDATE settings SET value='$ad'WHERE name='ad'";
	$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

	$sql = "UPDATE settings SET value='$perpage'WHERE name='perpage'";
	$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));


}


?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<div class="container">
	<div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<form method="post" enctype="multipart/form-data">
			  <div class="form-group">
			  <?php
			  		$sql = "SELECT * FROM settings WHERE name='sitename'";
			  		$res = mysqli_query($connection, $sql);
			  		$r = mysqli_fetch_assoc($res);
			  ?>
			    <label for="exampleInputEmail1">Site Name</label>
			    <input type="text" name="sitename" class="form-control" id="exampleInputEmail1" placeholder="Your Site Name" value="<?php echo $r['value']; ?>">
			  </div>
			  <div class="form-group">
			  <?php
			  		$sql = "SELECT * FROM settings WHERE name='ad'";
			  		$res = mysqli_query($connection, $sql);
			  		$r = mysqli_fetch_assoc($res);
			  ?>
			    <label for="exampleInputPassword1">Ad</label>
			    <input type="text" name="ad" class="form-control" id="exampleInputPassword1" placeholder="Your Ad Code Here" value="<?php echo $r['value']; ?>">
			  </div>
			  <div class="form-group">
			  <?php
			  		$sql = "SELECT * FROM settings WHERE name='perpage'";
			  		$res = mysqli_query($connection, $sql);
			  		$r = mysqli_fetch_assoc($res);
			  ?>
			    <label for="exampleInputPassword1">Per Page Results</label>
			    <input type="number" name="perpage" min="2" max="20" class="form-control" id="exampleInputPassword1" value="<?php echo $r['value']; ?>">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputFile">Logo</label>
			  <?php
			  		$sql = "SELECT * FROM settings WHERE name='logo'";
			  		$res = mysqli_query($connection, $sql);
			  		$r = mysqli_fetch_assoc($res);
			  ?>
			    <?php if(isset($r['value']) & !empty($r['value'])){ ?>
			    		<img src="../<?php echo $r['value']; ?>" width="100px" height="100px">
			    		<a href="logodel.php?id=<?php echo $r['id']; ?>">Delete Image</a>
			    <?php }else{ ?>
			    		<input type="file" name="logo" id="exampleInputFile">
			    		<p class="help-block">Only jpeg, png file formats allowed.</p>
			    <?php } ?>
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		  </div>
		</div>

		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li>
		      <a href="#" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <li><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li>
		      <a href="#" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
		<div class="panel-heading">Categories</div>
		  <div class="panel-body">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		  </div>
		</div>

		<div class="panel panel-default">
		<div class="panel-heading">Recent Comments</div>
		  <div class="panel-body">
		   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		  </div>
		</div>

		<div class="panel panel-default">
		<div class="panel-heading">Recent Articles</div>
		  <div class="panel-body">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		  </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>