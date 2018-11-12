<?php
session_start();

include "config.php";

$password = $password1 = "";
$passwordErr = $password1Err = "";

if($_SESSION['email']){
	$email=$_SESSION['email'];
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$password = $_POST["password"];
		if(empty($password)){
			$passwordErr = "Prosim vnesite vaše geslo.";     
		} elseif(strlen($password) < 8){
			$passwordErr = "Geslo mora vsebovati vsaj 8 znakov.";
		} elseif(!preg_match("#[0-9]+#",$password)) {
			$passwordErr = "Geslo mora vsebovati vsaj eno število!";
		} elseif(!preg_match("#[A-Z]+#",$password)) {
			$passwordErr = "Vaše geslo mora vsebovati vsaj eno veliko tiskano črko!";
		}
		
		$password1 = $_POST["password1"];
		if(empty($password1)){
			$password1Err = "Prosim potrdite vaše geslo.";     
		} else{
			if($password != $password1){
				$password1Err = "Gesli se ne ujemata.";
			}
		}
		if(empty($passwordErr) && empty($password1Err)){
			mysqli_query($povezava, "UPDATE users SET password='$password' WHERE email='$email'");
			mysqli_query($povezava, "UPDATE users SET geslo_token='' WHERE email='$email'");
			header("location:login.php");
		}
	}
}
else{
	header("error page");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Novo geslo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Izberite novo geslo</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($passwordErr)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password1Err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="password1" class="form-control" value="<?php echo $password1; ?>">
                <span class="help-block"><?php echo $password1Err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p><a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>