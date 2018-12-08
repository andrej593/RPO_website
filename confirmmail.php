<?php
require "config.php";

$username = $_GET["username"];
$code=$_GET["code"];
$sql = "SELECT *FROM users WHERE username = '".$username."';";
$result = $povezava->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$db_code = $row["confirmNum"];
	}
}
if($code===$db_code){
	$sql="UPDATE users SET confirm=1 WHERE username='".$username."';";
	if ($povezava->query($sql) === TRUE) {
		//echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $povezava->error;
	}
	$sql="UPDATE users SET confirmNum=0 WHERE username='".$username."';";
	if ($povezava->query($sql) === TRUE) {
		//echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $povezava->error;
	}
	echo "Vas email je bil potrjen.";
}
?>