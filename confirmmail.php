<?php
require "config.php";

$username = $_GET["username"];
$code=$_GET["code"];
$query1 = "SELECT *FROM users WHERE username = '$username'";
$query = mysqli_query($povezava, $query1);
if(mysqli_num_rows($query)){
	while($row=mysqli_fetch_assoc($query)){
		$db_code = $row["confirm_num"];
	}
}
if($code==$db_code){
	mysqli_query($povezava, "UPDATE users SET confirm=1 WHERE username='$username'");
	mysqli_query($povezava, "UPDATE users SET confirm_num=0 WHERE username='$username'");
	echo "Vas email je bil potrjen.";
}
?>