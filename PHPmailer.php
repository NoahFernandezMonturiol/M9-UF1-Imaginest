<?php

    use PHPMailer\PHPMailer\PHPMailer;

    //if() {

        require 'vendor/autoload.php';
        //require 'C:/Users/slast/xampp/phpMyAdmin/vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();

        //Configuració del servidor de Correu
        //Modificar a 0 per eliminar msg error
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
        $mail->Subject = 'Activate your account, '. $_POST['fname'];
        $mail->MsgHTML('<img src="https://i.imgur.com/gIxVwMZ.png" width="264" height="163">'.'<br>'.'Dear '.$_POST['fname'].', please activate your account using this link: <br> <a href="http://localhost/M9-UF1-P3/PHPmailer.php?codi='.$valorRand.'&mail='.$_POST['mail'].'">Activate now!</a>');
        
        //Destinatari
        $address = $_POST['mail'];
        $mail->AddAddress($address, $_POST['username']);

        //Enviament
        $result = $mail->Send();
        if(!$result){
            echo 'Error: ' . $mail->ErrorInfo;
        }else{
            //echo "Correu enviat";
        }

    //} else if () {
        
    //}

