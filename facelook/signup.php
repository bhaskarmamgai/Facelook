<?php
ini_set('display_errors',1); ini_set('display_startup_errors',1); error_reporting(-1);


$link = mysqli_connect("localhost", "root", "root", "social");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 if(isset($_POST['register-submit'])){
// Escape user inputs for security
$uname = mysqli_real_escape_string($link, $_REQUEST['username']);

$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
$lname = mysqli_real_escape_string($link, $_REQUEST['lname']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
$uid = mysqli_real_escape_string($link, $_REQUEST['uid']);

 
// attempt insert query execution
$sql = "INSERT INTO users (User_Name,First_Name,Last_Name,Email_Id,Password,Uid) VALUES ('$uname','$fname', '$lname','$email','$password','$uid')";
// to map user post and image via uid
//$sql = "INSERT INTO user_post (Uid ) VALUES ('$uid')";

if(mysqli_query($link, $sql)){
    echo "<script>
	alert('Welcome $fname to our page click to proceed to home page');
	window.location.href='logsign.php';
	</script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
// close connection
mysqli_close($link);
?>