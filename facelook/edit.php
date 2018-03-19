<?php
session_start();
require 'dbconnect.php';
ini_set('display_errors',1); ini_set('display_startup_errors',1); error_reporting(-1);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 if(isset($_POST['edit-submit'])){
// Escape user inputs for security
$uname = mysqli_real_escape_string($link, $_REQUEST['username']);

$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
$lname = mysqli_real_escape_string($link, $_REQUEST['lname']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
//print_r($_SESSION);die();

 
// Attempt update query execution
$sql = "UPDATE users SET First_Name='".$fname."',Last_Name='".$lname."',User_Name='".$uname."',Email_Id= '".$email."' WHERE Uid='".$_SESSION['uid']."'";



if(mysqli_query($link, $sql)){
	$_SESSION['email'] = $email;
        
        $_SESSION['first_name'] = $fname;
        $_SESSION['last_name'] = $lname;
        $_SESSION['user_name'] = $uname;
        //$_SESSION['uid'] = $row['Uid'];

    echo "<script>
	alert('Your Details Updated Succefully');
	window.location.href='dashboard.php';
	</script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
// close connection
mysqli_close($link);
 ?>