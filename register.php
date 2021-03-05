<?php
require 'connecta_db.php';

$message = '';

if (!empty($_POST['username']) && (!empty($_POST['mail']) && !empty($_POST['pass']))) {
    $sql = "INSERT INTO users (username, mail, userFirstName, userLastName, passHash) VALUES (:username, :mail, :fname, :lname, :pass)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':mail', $_POST['mail']);
    $stmt->bindParam(':fname', $_POST['fname']);
    $stmt->bindParam(':lname', $_POST['lname']);
    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$stmt->bindParam(':pass', $password);
	
	$pass1 = $_POST['pass'];
	$pass2 = $_POST['pass2'];

	if ($pass1 != $pass2) {
		$message = 'Sorry, there must have been an issue creating your account. Check both passwords match.';
	} else if ($stmt->execute()) {
		$message = 'Successfully created new user. An email has been sent into your account: "' . $_POST['mail'] . '"';
		$valorRand = rand();
		$valorRand = hash('sha256',$valorRand);

		$sql = "UPDATE users set activationCode='$valorRand' where mail=:mail";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':mail',$_POST['mail']);
            $stmt->execute();

		require'./PHPmailer.php';

	} else {
		$message = 'Sorry, there must have been an issue creating your account. User already exists in our database.';
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register | Imaginest™</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">

				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="register.php" autocomplete="off">

					<div class="wrap-input100">
						<input  class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100" >
						<input  class="input100" type="email" name="mail" placeholder="E-mail">
						<span class="focus-input100" data-placeholder="&#xe818;"></span>
					</div>

					<div class="wrap-input100" >
						<input  class="input100" type="text" name="fname" placeholder="First Name">
						<span class="focus-input100" data-placeholder="&#xe802;"></span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="text" name="lname" placeholder="Last Name">
						<span class="focus-input100" data-placeholder="&#xe802;"></span>
					</div>

					<div class="wrap-input100" >
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="wrap-input100" >
						<input  class="input100" type="password" name="pass2" placeholder="Verify Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<a href="./index.php" style="font-size:35px; margin-top:-12px;">←</a>
						<button class="login100-form-btn" type="submit">
							Register
						</button>
					</div>

					<?php if (!empty($message)): ?>
      				<p> <?=$message?></p>
    				<?php endif;?>

				</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>