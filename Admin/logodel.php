<?php  
session_start();

require '../config/connect.php';

if (isset($_SESSION['email']) &empty($_SESSION['email'])) {
	header("location: login.php");
}

if (isset($_GET['id'])  & !empty($_GET['id'])) {
	
$id= $_GET['id'];
$sql = "DELETE * from settings WHERE id=$id";
$res = mysqli_query($connection, $sql);
$r= mysqli_fetch_assoc($res);

	$delsql="DELETE FROM settings WHERE id=$id";
	if (mysqli_query($connection, $delsql)) {
		header("location : settings.php");
	} 
		# code...
	
}else{

header("location: settings.php");

}


	


?>