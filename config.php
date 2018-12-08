<?php

$servername = "localhost";
$username = "root";
$password = "Geslo123";
$name="mydb";	

// Create povezavaection
$povezava = new mysqli($servername, $username, $password, $name);

// Check povezavaection
if ($povezava->povezavaect_error) {
    die("povezava failed: " . $povezava->povezavaect_error);
} 
echo "povezava";
?>