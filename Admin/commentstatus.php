<?php  

session_start();

require '../config/connect.php';

if (isset($_SESSION['email'])  & empty($_SESSION['email'])) {
	header("location: login.php");

}
if (isset($_GET)  & !empty($_GET)) {
if((isset($_GET['id']) & !empty($_GET['id'])) & (isset($_GET['status']) & !empty($_GET['status']))) {
		
		$id= $_GET['id'];
		$status= $_GET['status'];

		$sql = "UPDATE comments SET status='$status' WHERE id=$id";
		$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

		if ($res) {
			
			header("location: comments.php");
		} else {
			header("location: comments.php");
		}
		
	}
}else{

header("location: comments.php");

}


















?>