<?php
session_start();
require('../config/connect.php');

if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_POST) & !empty($_POST)){
	if(!isset($_POST['maincat']) & empty($_POST['maincat'])){
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$description = mysqli_real_escape_string($connection, $_POST['description']);
		$sql = "DELETE FROM category (name, description) VALUES ('$name', '$description')";
		$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		if($res){
			$smsg = "Category Deleted Successfully";
		}else{
			$fmsg = "Failed to Delete Category";
		}
	}

	if(isset($_POST['maincat']) & !empty($_POST['maincat'])){
		$maincatid = mysqli_real_escape_string($connection, $_POST['maincat']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$description = mysqli_real_escape_string($connection, $_POST['description']);
		$sql = "DELETE FROM 'subcat' (catid, name, description) VALUES ($maincatid, '$name', '$description')";
		$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		if($res){
			$ssmsg = "Sub Category Deleted Successfully";
		}else{
			$sfmsg = "Failed to Delete Sub Category";
		}
	}
}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<div class="container">
	<div class="col-md-6">
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<form method="post">
				<div class="row">
					<div class="col-md-6">
					<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
					<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
					<form class="form-horizontal" method="post" action="#">
						<label>Category Name </label>
						<input name="name" class="form-control" placeholder="Category Name" value="" type="text" required="">
						<br>
						<label>Category Description </label>
						<textarea name="description" class="form-control" rows="3"></textarea>
						<br>
						<input type="submit" value="Delete Category" class="btn btn-primary btn-lg">
					</form>
					</div>
					<div class="col-md-6">
						
					</div>
				</div>	

				<br>
				<div class="row"> 
				<div class="col-md-3"></div>
				</div>
                                            
			</form>
		  </div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<form method="post">
				<div class="row">
					<div class="col-md-6">
					<?php if(isset($ssmsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $ssmsg; ?> </div><?php } ?>
					<?php if(isset($sfmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $sfmsg; ?> </div><?php } ?>
					<form class="form-horizontal" method="post" action="#">
						<label> Select Main Category Name </label>
						<select name="maincat" class="form-control">
						<?php 
							$selsql = "DELETE  FROM category";
							$selres = mysqli_query($connection, $selsql);
							while($selr = mysqli_fetch_assoc($selres)){
						?>
						  <option value="<?php echo $selr['id']; ?>"><?php echo $selr['name']; ?></option>
						  <?php } ?>
						</select>
						<br>
						<label> Sub Category Name </label>
						<input name="name" class="form-control" placeholder="Category Name" value="" type="text" required="">
						<br>
						<label>Sub Category Description </label>
						<textarea name="description" class="form-control" rows="3"></textarea>
						<br>
						<input type="submit" value="Delete Sub Category" class="btn btn-primary btn-lg">
					</form>
					</div>
					<div class="col-md-6">
						
					</div>
				</div>	

				<br>
				<div class="row"> 
				<div class="col-md-3"></div>
				</div>
                                            
			</form>
		  </div>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-body">
		  <ul>
		    <?php 
				$selsql = "DELETE * FROM 'category' WHERE id =''id";
				$selres = mysqli_query($connection, $selsql);
				while($selr = mysqli_fetch_assoc($selres)){
			?>
					<li><?php echo $selr['name']; ?> <a href="delcategory.php?id=<?php echo $selr['id']; ?>">Delete</a>
						<ul>
							<?php 
								$selsubsql = "DELETE  FROM 'subcat' WHERE id={$selr['id']}";
								$selsubres = mysqli_query($connection, $selsubsql);
							while($selsubr = mysqli_fetch_assoc($selsubres)){
							?>
								<li><?php echo $selsubr['name']; ?></li>
							<?php	
							}
							?>
						</ul>
					</li>
			<?php	}	?>
			</ul>
		  </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
