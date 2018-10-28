<?php
session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: members.php");
    exit;
}
require "config.php";

$username = $password = $db_passowrd = "";
$usernameErr = $passwordErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST["username"];
	if(empty($username)){
        $usernameErr = "Please enter username.";
    }
	$password = $_POST["password"];
    if(empty($password)){
        $passwordErr = "Please enter your password.";
    }
    if(empty($usernameErr) && empty($passwordErr)){
        $query1 = "SELECT * FROM users WHERE username = '$username'";
        $query = mysqli_query($povezava, $query1);
		if(mysqli_num_rows($query)){
			while($row=mysqli_fetch_assoc($query)){
				$db_password = $row["password"];
			}
            if($password==$db_password){
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
                header("location: members.php");
            } else{
				$passwordErr = "The password you entered was not valid.";
			}
        } else{
			$usernameErr = "No account found with that username.";
        }
    }
}
mysqli_close($povezava);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($usernameErr)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $usernameErr; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($passwordErr)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>