<?php
session_start();
require('../config/connect.php');

if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT featuredimage from content WHERE id=$id";
	$res = mysqli_query($connection, $sql);
	$r = mysqli_fetch_assoc($res);
	if(isset($r['featuredimage']) & !empty($r['featuredimage'])){
		if(unlink($r['featuredimage'])){
			$delsql="DELETE FROM `content` WHERE id=$id";
			if(mysqli_query($connection, $delsql)){
				header("Location: content.php");
			}
		}else{
			$delsql="DELETE FROM `content` WHERE id=$id";
			if(mysqli_query($connection, $delsql)){
				header("Location: content.php");
			}			
		}
	}else{
		$delsql="DELETE FROM `content` WHERE id=$id";
		if(mysqli_query($connection, $delsql)){
			header("Location: content.php");
		}
	}
}else{
	header('location: content.php');
}

?>