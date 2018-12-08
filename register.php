<?php
include "config.php";

$username = $name = $lastname = $password = $password1 = $email = "";
$usernameErr = $nameErr = $lastnameErr = $passwordErr = $password1Err = $emailErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	//username validation
	$username = $_POST["username"];
    if(empty($username)){
        $usernameErr = "Prosim vnesite vaše ime.";
    } else{
        $sql = "SELECT IDusers FROM users WHERE username = '".$username."';";
		$result = $povezava->query($sql);
		if ($result->num_rows > 0) {
			$usernameErr = "Uporabniško ime že obstaja.";
		}
    }

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
		$lastnameErr="Prosim vensite vaš priimek.";
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
		$geslo_token=0;
        $sql = "INSERT INTO users (name, lastname, username, password, email, confirm, confirmNum, pass_token) 
		VALUES('".$name."','". $lastname."','".$username."','".$password."','".$email."','".$confirm."','".$confirm_num."','".$geslo_token."');";
        //echo "</br> --------------------------------";
		
		if ($povezava->query($sql) === TRUE) {
			//echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $povezava->error;
		}
        
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'game.exchange123@gmail.com';
		$mail->Password = 'geslo1234';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom('andtop593@gmail.com', 'Andrej');
		$mail->addAddress($email, 'User');
		$mail->isHTML(true);
		$msg="<h1>GameExchange</h1>Prosim potrdite vaš email naslov preko linka: <br/>
		<a href='localhost/website/confirmmail.php?username=$username&code=$confirm_num'>localhost/website/confirmmail.php?username=$username&code=$confirm_num</a></br>";
		$mail->Subject = 'Verifikacija racuna za gameexchange';
		$mail->Body    = $msg;
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent\n';
		}
		//gg page
		echo("Registracija uspešna! Prosim potrdite vaš email naslov.");
        //mysqli_stmt_close($stmt);
    }
    
    // Close povezava
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