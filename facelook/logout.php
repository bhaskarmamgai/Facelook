<?php 
session_start();
unset($_SESSION["email"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
unset($_SESSION["first_name"]); 
session_unset();
session_destroy(); 
header("Location: logsign.php");
 ?>