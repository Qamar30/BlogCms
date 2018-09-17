<?php
session_start();
require('config/connect.php');
require('functionsfe.php');


if(isset($_GET['url']) & !empty($_GET['url'])){
	$url = $_GET['url'];
	$r = mysqli_fetch_assoc(SelSingleArticle($url));
	if(mysqli_num_rows(SelSingleArticle($url)) < 1){
		header("location: index.php");
	}
}else{
	header("location: index.php");
}

$msg = InsertComments($r['id']);

//$r = mysqli_fetch_assoc($res);
?>
<?php include 'inc/header.php' ?>
<?php include 'inc/nav.php' ?>

</div>
<div class="container">
	<div class="col-md-8">
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<h2><?php echo $r['title']; ?></h2>
		  	<div class="row">
		  		<div class="col-md-4"><img src="admin/<?php echo $r['featuredimage']; ?>" height="150px" width="150px" class="img-rounded img-responsive"></div>
		  		<div class="col-md-8"><?php echo $r['content']; ?>
		  		</div>
		  	</div>
		  </div>
		</div>

		<div class="panel panel-default">
		<div class="panel-heading">Submit Your Comments</div>
		  <div class="panel-body">
		  	<?php echo DisplayCommentMsg($msg); ?>
		  	<form method="post">
		  	  <div class="form-group">
			    <label for="exampleInputEmail1">Name</label>
			    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Subject</label>
			    <textarea name="subject" class="form-control" rows="3"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
		  </div>
		</div>

		<?php echo DisplayComments($r['id']); ?>
	</div>
	<div class="col-md-4">
		<?php include'inc/sidebar.php'; ?>
	</div>
</div>
<?php include 'inc/footer.php' ?>