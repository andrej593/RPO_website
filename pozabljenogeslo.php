<?php
require "config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$email=$_POST["email"];
	$query1 = "SELECT * FROM users WHERE email='$email'";
	$query=mysqli_query($povezava, $query1);
	if(mysqli_num_rows($query)){
		$znaki="qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM1234567890";
		$znaki=str_shuffle($znaki);
		$znaki=substr($znaki, 0, 10);
		
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
		
		$msg="<h1>GameExchange</h1>Novo geslo si lahko nastavite na linku: <br/>
		<a href='localhost/website/gesloreset.php?email=$email&znaki=$znaki'>localhost/website/gesloreset.php?email=$email&znaki=$znaki'</a>";
		$mail->Subject = 'Verifikacija racuna za gameexchange';
		$mail->Body    = $msg;

		if(!$mail->send()) {
			echo 'Napaka: ' . $mail->ErrorInfo;
		} else {
			echo 'Sporocilo je bilo poslano!';
		}
		mysqli_query($povezava, "UPDATE users SET geslo_token='$znaki' WHERE email='$email'");
		//check page
		
	}
}
	



?>
 <!DOCTYPE html>
<html>
<head>
</head>
<body>
<form action="pozabljenogeslo.php" method="post">
<label>Email</label>
<input type="mail" name="email">
<input type="submit" name="pozabljenogeslo" value="Submit">
</form>
</body>
</html>