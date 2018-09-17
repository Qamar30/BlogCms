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
		  	<h2>Article Title</h2>
		    Basic panel example
		  </div>
		</div>

		<div class="panel panel-default">
		  <div class="panel-body">
		  <h2>Article Title</h2>
		    Basic panel example
		  </div>
		</div>

		<div class="panel panel-default">
		  <div class="panel-body">
		  <h2>Article Title</h2>
		    Basic panel example
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