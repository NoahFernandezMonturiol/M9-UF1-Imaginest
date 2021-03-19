<?php

    require_once 'connecta_db.php';

    $con = "UPDATE users set active=1 where mail=:email";
            $records = $db->prepare($con);
            $records->bindParam(':email',$_GET['mail']);
            $records->execute();
                echo'<script>
                alert("Your account has been successfully activated, please sign in.");
                location.href="index.php";
                </script>'; 
?>
