<?php
session_start();
require "config.php";
if(isset($_GET["email"]) && isset($_GET["znaki"])){
	$email=$_GET["email"];
	$znaki=$_GET["znaki"];
	$query=mysqli_query($povezava, "SELECT * FROM users WHERE geslo_token='$znaki' AND email='$email'");
	if(mysqli_num_rows($query)){
		$_SESSION["email"] = $email;
		header ("location:novogeslo.php");
	}
	else{
		echo "Neveljaven link.";
	}
	
}

?>