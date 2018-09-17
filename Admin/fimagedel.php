<?php  
session_start();

require '../config/connect.php';

if (isset($_SESSION['email']) &empty($_SESSION['email'])) {
	header("location: login.php");
}

if (isset($_GET['id'])  & !empty($_GET['id'])) {
	
$id= $_GET['id'];
$sql = "SELECT  * FROM  'content' WHERE content id=$id";
$res = mysqli_query($connection, $sql);
$r= mysqli_fetch_assoc($res);

if (unlink($r['featuredimage'])) {
	$delsql="DELETE  *  FROM  'featuredimage' WHERE id=$id";
	if (mysqli_query($connection, $delsql)) {
		header("location : editcontent.php?id=$id");
	} 
		# code...
	}
	
}else{

header("location: content.php");

}


	


?>