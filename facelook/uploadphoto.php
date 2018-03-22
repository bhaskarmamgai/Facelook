<?php
 session_start();
include("dbconnect.php");
 $pquery=mysqli_query($link,"SELECT * FROM users WHERE Uid='".$_SESSION['uid']."'");


if(isset($_POST['but_upload'])){
 
 $name = strtolower($_FILES['file']['name']);
 $target_dir = "/var/www/html/facelook/ppic/";
 $target_file = $target_dir . basename($_FILES["file"]["name"]);

 // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Valid file extensions
 $extensions_arr = array("jpg","jpeg","png","gif");

 // Check extension
 if( in_array($imageFileType,$extensions_arr) ){
 
  // Insert record
$query = "UPDATE users SET Profile_Pic='".$name."' WHERE Uid='".$_SESSION['uid']."'";
  mysqli_query($link,$query);
  		$_SESSION['image'] = $name;

  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
echo "<script>
	alert('Your Profile Picture Updated Succefully');
	window.location.href='dashboard.php';
	</script>";
 }
 
}
?>