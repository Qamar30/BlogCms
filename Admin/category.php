<?php
session_start();
require('../config/connect.php');

if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
	header('location: login.php');
}
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<div class="container">
	<div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-body">
		  <ul>
		    <?php 
				$selsql = "SELECT * FROM category";
				$selres = mysqli_query($connection, $selsql);
				while($selr = mysqli_fetch_assoc($selres)){
			?>
					<li><?php echo $selr['name']; ?> <a href="delcategory.php"<?php echo $selr['id']; ?>">Delete</a>
						<ul>
							<?php 
							
								$selsubsql = "SELECT * FROM subcat WHERE id={$selr['id']}";
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