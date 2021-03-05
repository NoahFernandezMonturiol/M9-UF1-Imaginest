<?php
// Inicialitzar sessió
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destruir sessió
session_destroy();
 
// Redirigir a login.php
header("location: ./index.php");
exit;
?>