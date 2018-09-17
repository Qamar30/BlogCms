<?php
session_start();
require('config/connect.php');
require('functionsfe.php');

if(isset($_GET['url']) & !empty($_GET['url'])){
	$url = $_GET['url'];

	$catr = GetCatIdName($_GET['url']);

	$curpage = SetCurPage();

	$perpage = PerPageResults();
	

	$start = ($curpage * $perpage) - $perpage;

	$totalres = mysqli_num_rows(SelPublishedContent($catr['id']));

	$res = SelPubContPag($start, $perpage, $catr['id']);

	$endpage = ceil($totalres/$perpage);
	$startpage = 1;
	$nextpage = $curpage + 1;
	$previouspage = $curpage - 1;
}else{
	header("location: index.php");
}

?>
<?php include 'inc/header.php' ?>
<?php include 'inc/nav.php' ?>

</div>
<div class="container">
	<div class="col-md-8">
	<?php 
	if(mysqli_num_rows($res)>=1){
	while ($r = mysqli_fetch_assoc($res)) { ?>
		<div class="panel panel-default">
		  <div class="panel-body">
		  	<a href="single.php?url=<?php echo $r['url']; ?>"><h2><?php echo $r['title']; ?></h2></a>
		  	<div class="row">
		  		<div class="col-md-4"><img src="admin/<?php echo $r['featuredimage']; ?>" height="150px" width="150px" class="img-rounded img-responsive"></div>
		  		<div class="col-md-8"><?php echo $r['content']; ?>
		  		<br>
		  		<a class="btn btn-primary pull-right" href="single.php?url=<?php echo $r['url']; ?>" role="button">Read More...</a>
		  		</div>
		  	</div>
		  </div>
		</div>
	<?php } }else{?>
		<h2>No articles found in "<?php echo $catr['name']; ?>" Category...</h2>
		<h3>Go through other catgories from Main Menu</h3>
	<?php } ?>
	<?php if($endpage>=1){ echo PrintPagination($curpage, $startpage, $endpage, $previouspage, $nextpage, $url); } ?>
	</div>
	<div class="col-md-4">
		<?php include'inc/sidebar.php'; ?>
	</div>
</div>
<?php include 'inc/footer.php' ?>