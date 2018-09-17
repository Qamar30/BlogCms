<?php  

session_start();

require('../config/connect.php');

if(isset($_SESSION['email']) & empty($_SESSION['email'])){

header("location:login.php");


}

if (isset($_GET['page']) & !empty($_GET['page'])) {
	$curpage =$_GET['page'];
} else {
	$curpage= 1;
}

	$sql = "SELECT * FROM settings WHERE name='perpage'";

	$res = mysqli_query($connection, $sql);
	$r = mysqli_fetch_array($res);
	$perpage = $r['value'];

	$start = ($curpage * $perpage) - $perpage;
	$PageSql = "SELECT * FROM content";
	$pageres = mysqli_query($connection, $PageSql);
	$totalres = mysqli_num_rows($pageres);


$sql = "SELECT * FROM content ORDER BY id DESC LIMIT $start, $perpage";
	$res = mysqli_query($connection, $sql);

$endpage=ceil($totalres/$perpage);
$startpage= 1;
$nextpage= $curpage +1;
$previouspage= $curpage -1;



?>


<?php include ('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Content</div>
			<table class="table table-striped"> 
				<thead> 
					<tr> 
						<th>#</th> 
						<th>Title</th> 
						<th>Image</th> 
						<th>Created On</th> 
						<th>Updated On</th> 
						<th>Status</th> 
						<th>Operations</th> 
					</tr> 
				</thead> 
				<tbody> 
				<?php
					while ( $r = mysqli_fetch_assoc($res)) {
				?>
					<tr> 
						<th scope="row"><?php echo $r['id']; ?></th> 
						<td><?php echo $r['title']; ?></td> 
						<td><?php if(isset($r['featuredimage']) & !empty($r['featuredimage'])){echo "Yes";}else{echo "No";} ?></td> 
						<td><?php echo $r['createtime']; ?></td> 
						<td><?php echo $r['updatetime']; ?></td> 
						<td><?php echo $r['status']; ?></td> 
						<td><a href="editcontent.php?id=<?php echo $r['id']; ?>">Edit</a> <a href="delcontent.php?id=<?php echo $r['id']; ?>">Delete</a></td> 
					</tr> 
				<?php } ?>
				</tbody> 
			</table>
		</div>
		<?php if($endpage>=1){ ?>
		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <?php if($curpage != $startpage){ ?>
			    <li>
			      <a href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
			        <span aria-hidden="true">&laquo;</span>
			        <span class="sr-only">First</span>
			      </a>
			    </li>
			    <?php } ?>
		    <?php if($curpage >= 2){ ?>
		    	<li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
		    <?php } ?>
		    <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
		    <?php if($curpage != $endpage){ ?>
    			<li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
			<?php } ?>
		    <?php if($curpage != $endpage){ ?>
			    <li>
			      <a href="?page=<?php echo $endpage ?>" aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			        <span class="sr-only">Last</span>
			      </a>
			    </li>
		    <?php } ?>
		  </ul>
		</nav>
		<?php } ?>
	</div>
</div>
<?php include 'inc/footer.php'; ?>