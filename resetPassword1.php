<?php

	session_start();

	if (isset($_SESSION['user_id'])) {
		header('Location: /home.php');
	}

	use PHPMailer\PHPMailer\PHPMailer;
	require 'connecta_db.php';

	if(isset($_POST['emailToSend']))
    {
        $sql=$db->prepare('SELECT mail from users where mail=:email or username=:email');
        $sql->bindParam(':email',$_POST['emailToSend']);
        if($sql->execute())
        {
            $valor=rand();
            $valor=hash('sha256',$valor);
            
            $sql=$sql->fetch(PDO::FETCH_ASSOC);
            $correu=$_POST['emailToSend'];

            $minutes_to_add = 90;

            $time = new DateTime();
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

            $hora = $time->format('Y-m-d H:i:s');

            $sql = "UPDATE users set resetPassCode='$valor', resetPass=1, resetPassExpiry='$hora' where mail='$correu'";
            $smt = $db->prepare($sql);
            $smt->execute();

            require 'vendor/autoload.php';
            $mail = new PHPMailer();
            $mail->IsSMTP();

            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;

            //Credencials del compte GMAIL
            $mail->Username = 'nmonturiol2021@educem.net';
            $mail->Password = '_Asix@2021_';

            //Dades del correu electrònic
            $mail->SetFrom('nmonturiol2021@educem.net','Imaginest');
            $mail->Subject = 'Reset your password, '.$correu;

            $mail->MsgHTML('<img src="https://i.imgur.com/gIxVwMZ.png" width="264" height="163">'.'<br>Click this link to change your password: ' . '<a href="http://localhost/M9-UF1-P3/resetPassword2.php?code='.$valor.'&mail='.$correu.'">Change now!</a>');

            //Destinatari
            $address = $_POST['emailToSend'];
			$mail->AddAddress($address , $correu);

            //Enviament
            $result = $mail->Send();
			
			$message = 'Please, check your email inbox to change your password.';
        
		} else {
			$message = 'Sorry, this username or email does not exist in our database.';
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset password | Imaginest™</title>
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
					Reset password
				</span>
				
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input required class="input100" type="mail" name="emailToSend" placeholder="E-mail or username">
						<span class="focus-input100" data-placeholder="&#xe818;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<a href="./index.php" style="font-size:35px; margin-top:-12px;">←</a>
						<button class="login100-form-btn" type="submit">
							Change password
						</button>
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

</body>
</html>