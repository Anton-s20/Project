<?php  
	session_start(); 
	session_destroy(); 
	$_SESSION=array();
	unset($_SESSION[key]);
	header('location: ../index.php');
?>