<?php

	session_start();

	if (isset($_SESSION['user_id'])) {
		header('Location: /home.php');
	}

	require 'connecta_db.php';

	if (!empty($_POST['UserOrMail']) && !empty($_POST['pass'])) {
		$records = $db->prepare('SELECT iduser, username OR mail, passHash, active FROM users WHERE mail = :mail or username = :mail');
		$records->bindParam(':mail', $_POST['UserOrMail']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$message = '';

		if(empty($results) or $results['active']!=1) {
			$message = 'Sorry, those credentials do not match';
		} else if(password_verify($_POST['pass'],$results['passHash'])){
			$_SESSION['user_id'] = $results['iduser'];
			header("Location: home.php");
		} else {
			$messageErr = 'Sorry, those credentials do not match';
			echo "<script type='text/javascript'>alert('$messageErr');</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Imaginest™</title>
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
				<span class="login100-form-title p-b-41">
					Imaginest
				</span>
				
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="index.php">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input required class="input100" type="text" name="UserOrMail" placeholder="Username/E-mail">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input required class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<br>
					<p id="haveAcc">Don't have an account yet? <a href="./register.php" id="signUpBtn">Sign Up</a></p>

					<div class="popup" onclick="recPasswd()">
						<!--<p id="lostPwdTxt"><a id="changePass">Forgot your password?</a></p>-->
						<span class="popuptext" id="myPopup">Popup text...</span>
					</div>
					

					<?php if(!empty($message)): ?>
      					<p> <?= $message ?></p>
    				<?php endif; ?>

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

	<script>
	// When the user clicks on <div>, open the popup
	function recPasswd() {
	var popup = document.getElementById("changePass");
	popup.classList.toggle("show");
	}
	</script>
</body>
</html>
