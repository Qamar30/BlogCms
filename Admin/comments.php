<?php  
session_start();
require '../config/connect.php';

if (!isset($_SESSION['email']) & empty($_SESSION['email'])) {
	header("location: login.php");
}

//$sql = "SELECT * FROM comments";
//$res = mysqli_query($connection, $sql);
//$r = mysqli_fetch_assoc($res);

if (isset($_GET['page']) & !empty($_GET['page'])){
	
	$curpage =$_GET['page'];
} else {
	$curpage = 1;
}

	$sql = "SELECT * FROM settings WHERE name='perpage'";

	$res= mysqli_query($connection, $sql);
	$r= mysqli_fetch_assoc($res);
	$perpage= $r['value'];

	$start= ($curpage * $perpage) - $perpage;

	$PageSql = "SELECT * FROM comments";

	$pageres= mysqli_query($connection, $PageSql);
	$totalres= mysqli_num_rows($pageres);


$sql = "SELECT * FROM comments ORDER BY id DESC LIMIT $start, $perpage";

$res =mysqli_query($connection, $sql);

$endpage= ceil($totalres/$perpage);
$startpage= 1;
$nextpage =$curpage +1;
$previouspage = $curpage -1;





















?>



<?php include 'inc/header.php'; ?>
<?php include 'inc/nav.php'; ?>
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Comments</div>
			<table class="table table-striped"> 
				<thead> 
					<tr> 
						<th>#</th> 
						<th>Content Title</th> 
						<th>Name</th> 
						<th>Comment</th> 
						<th>Time</th> 
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
						<td><?php 
							$csql = "SELECT title FROM content WHERE id={$r['cid']}";
							$cres = mysqli_query($connection, $csql);
							$cr = mysqli_fetch_assoc($cres);
							echo $cr['title'];
						?></td> 
						<td><?php echo $r['name'] ?></td> 
						<td><?php echo $r['subject']; ?></td> 
						<td><?php echo $r['submittime']; ?></td> 
						<td><?php if(isset($r['status']) & !empty($r['status'])){echo $r['status'];}else{echo "NA";} ?></td> 
						<td><a href="editcomment.php?id=<?php echo $r['id']; ?>">Edit</a> <a href="commentstatus.php?id=<?php echo $r['id']; ?>&status=publish">App</a> <a href="commentstatus.php?id=<?php echo $r['id']; ?>&status=draft">Dis</a> <a href="delcomment.php?id=<?php echo $r['id']; ?>">Del</a></td> 
					</tr> 
				<?php } ?>
				</tbody> 
			</table>
		</div>

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
	</div>
</div>
<?php include 'inc/footer.php'; ?>
