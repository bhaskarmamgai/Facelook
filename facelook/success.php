<?php
session_start();

if(isset($_SESSION['email'])){
echo "<h2>Valid username or password\n</h2>";
        
echo "Hello, " . $_SESSION['first_name']. " (" . $_SESSION['email'] . ").";
echo '<a href="logout.php">logout</a>';
}
else{
	header("location: logsign.php");
}