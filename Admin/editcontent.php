<?php
session_start();
require('../config/connect.php');

if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_GET['id']) & !empty($_GET['id'])){
	//select query
	$id = $_GET['id'];
	$selsql = "SELECT * FROM content WHERE id=$id";
	$selres = mysqli_query($connection, $selsql);
	$selr = mysqli_fetch_assoc($selres);
	if(mysqli_num_rows($selres) <= 1){
		//redirect to view content page
	}
}else{
	//redirect view content page
}

if(isset($_POST) & !empty($_POST)){
	print_r($_POST);
	$title = mysqli_real_escape_string($connection, $_POST['title']);
	echo $url = str_replace(' ', '-', $title);
	$content = mysqli_real_escape_string($connection, $_POST['content']);
	$catid = implode(",", $_POST['cat']);
	$updatetime = date("Y-m-d H:i:s");
	$status = $_POST['status'];

	if(isset($_FILES) & !empty($_FILES)){
		$name = $_FILES['fimage']['name'];
		$size = $_FILES['fimage']['size'];
		$type = $_FILES['fimage']['type'];
		$tmp_name = $_FILES['fimage']['tmp_name'];

		$max_size = 10000000;
		$extension = substr($name, strpos($name, '.') + 1);

		if(isset($name) && !empty($name)){
			if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $extension == $size<=$max_size){
				$location = "uploads/";
				$filepath = $location.$name;
				if(move_uploaded_file($tmp_name, $filepath)){
					$smsg = "Uploaded Successfully";
				}else{
					$fmsg = "Failed to Upload File";
				}
			}else{
				$fmsg = "File size should be 10,000 KiloBytes & Only JPEG File";
			}
		}else{
			$fmsg = "Please Select a File";
		}
	}else{
		$filepath = $selr['featuredimage'];
	}

	$sql = "UPDATE content SET title='$title', content='$content', catid='$catid', url='$url', updatetime='$updatetime', status='$status', featuredimage='$filepath' WHERE id=$id";
	$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	//$lid = mysqli_insert_id($connection);
	if($res){
		$smsg = "Content updated Successfully";
		header("location: editcontent.php?id=$id");
	}else{
		$fmsg = "Failed to update Content";
	}
}
?>
<?php include 'inc/header.php'; ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<?php include 'inc/nav.php'; ?>
<div class="container">
	<div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		  	<form method="post" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Title</label>
			    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Title" value="<?php echo $selr['title']; ?>">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Content</label>
			    <textarea name="content" class="form-control" rows="6"><?php echo $selr['content']; ?></textarea>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputFile">Featured Image</label>
			    <?php if(isset($selr['featuredimage']) & !empty($selr['featuredimage'])){ ?>
			    		<img src="<?php echo $selr['featuredimage']; ?>" width="100px" height="100px">
			    		<a href="fimagedel.php?id=<?php echo $selr['id']; ?>">Delete Image</a>
			    <?php }else{ ?>
			    		<input type="file" name="fimage" id="exampleInputFile">
			    		<p class="help-block">Only jpeg, png file formats allowed.</p>
			    <?php } ?>
			  </div>
			  <div class="form-group">
				  <div class="row">
					  	<div class="col-md-6">
						    <label>Categories</label>
						    <select name="cat[]" multiple class="form-control">
							<?php 
								$categories = explode(",", $selr['catid']); 
								$selcatsql = "SELECT * FROM category";
								$selcatres = mysqli_query($connection, $selcatsql);
								while($selcatr = mysqli_fetch_assoc($selcatres)){
							?>
								<option value="<?php echo $selcatr['id']; ?>" 
							<?php
									foreach ($categories as $key => $value) {
							?>
							  <?php if($selcatr['id'] == $value){ echo "selected"; } ?>
							<?php } ?>
							><?php echo $selcatr['name']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-md-6">
						<label>Post Status</label>
							<select name="status" multiple class="form-control">
							  <option value="draft" <?php if($selr['status'] == "draft"){ echo "selected"; } ?>>Draft</option>
							  <option value="published" <?php if($selr['status'] == "published"){ echo "selected"; } ?>>Published</option>
							</select>
						</div>
					  </div>
				  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		  </div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-default">
		<div class="panel-heading">Categories</div>
		  <div class="panel-body">
		    Basic panel example
		  </div>
		</div>

		<div class="panel panel-default">
		<div class="panel-heading">Recent Comments</div>
		  <div class="panel-body">
		    Basic panel example
		  </div>
		</div>

		<div class="panel panel-default">
		<div class="panel-heading">Recent Articles</div>
		  <div class="panel-body">
		    Basic panel example
		  </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>