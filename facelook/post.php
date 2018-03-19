<?php
session_start();
require 'dbconnect.php';

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 if(isset($_POST['post-button'])){

 //query to fetch user posts
 $query=mysqli_query($link,"SELECT * FROM user_post WHERE Uid='".$_SESSION['uid']);
    $count=mysqli_num_rows($query);
    if ($count==1)
    {
       $row=mysqli_fetch_array($query);
        
        $_SESSION['ptext'] = $row['Text_post'];
        

        $_SESSION['user_url'] = $row['Image_url'];
        
        }

// Escape user inputs for security
$text = mysqli_real_escape_string($link, $_REQUEST['post-text']);
$image = mysqli_real_escape_string($link, $_REQUEST['lname']);
$uid = mysqli_real_escape_string($link, $_SESSION['uid']);

 
// attempt insert query execution
$sql = "INSERT INTO user_post (Uid,Text_post,Image_url) VALUES ('$uid','$text','$image')";
if(mysqli_query($link, $sql)){
    echo "<script>
	alert('Succesfully Posted');
	window.location.href='dashboard.php';
	</script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
// close connection
mysqli_close($link);
?>