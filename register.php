<?php
require "config.php";

$username = $name = $lastname = $password = $password1 = $email = "";
$usernameErr = $nameErr = $lastnameErr = $passwordErr = $password1Err = $emailErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	//username validation
	$username = $_POST["username"];
    if(empty($username)){
        $usernameErr = "Prosim vnesite vaše ime.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($povezava, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            $usernameErr = "Uporabniško ime že obstaja.";
        }
    }
    mysqli_stmt_close($stmt);
	//password validation
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
	//passwword==password1
	$password1 = $_POST["password1"];
    if(empty($password1)){
        $password1Err = "Prosim potrdite vaše geslo.";     
    } else{
        if($password != $password1){
            $password1Err = "Gesli se ne ujemata.";
        }
    }
	//name validation
	$name=$_POST["name"];
	if(empty($_POST["name"])){
		$nameErr="Prosim vnesite vaše ime.";
	}
	//lastname validation
	$lastname=$_POST["lastname"];
	if(empty($lastname)){
		$lastnameErr="Prosim vensite vas priimek.";
	}
	//email validation
	$email=$_POST["email"];
	if(empty($email)){
		$emailErr="Prosim vnesite vas email";
	} elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
        $emailErr = "You Entered An Invalid Email Format"; 
    }
	//ce ni v nobenem polji napake dodamo uporabnika v mysql
    if(empty($usernameErr) && empty($passwordErr) && empty($password1Err) && empty($nameErr) && empty($lastnameErr) && empty($emailErr)){
		$confirm=0;
		$confirm_num=rand();
        $sql = "INSERT INTO users (name, lastname, username, password, email, confirm, confirm_num) VALUES (?, ?, ?, ? , ?, ?, ?)";
        $stmt = mysqli_prepare($povezava, $sql);
        mysqli_stmt_bind_param($stmt, "sssssii", $name, $lastname, $username, $password, $email, $confirm, $confirm_num);
        mysqli_stmt_execute($stmt);
        
		$msg = "Vas email lahko potrdite na hyperpovezavi: ";
		//mail($email, "Verifikacija elektronskega naslova", $msg, "From: me@example.com");
		echo("Registracija uspešna! Prosim potrdite vaš email naslov.");
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($povezava);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            			<div class="form-group <?php echo (!empty($nameErr)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $nameErr; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($lastnameErr)) ? 'has-error' : ''; ?>">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastnameErr; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($usernameErr)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $usernameErr; ?></span>
            </div>    
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
			 <div class="form-group <?php echo (!empty($emailErr)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="mail" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>