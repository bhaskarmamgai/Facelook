<?php
include("dbconnect.php");

if(isset($_POST['but_upload'])){
 
 $name = $_FILES['file']['name'];
 $target_dir = "/var/www/html/facelook/";
 $target_file = $target_dir . basename($_FILES["file"]["name"]);

 // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Valid file extensions
 $extensions_arr = array("jpg","jpeg","png","gif");

 // Check extension
 if( in_array($imageFileType,$extensions_arr) ){
 
  // Insert record
  $query = "insert into user_pos (Filename) values('".$name."')";
  mysqli_query($link,$query);
  
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

 }
 
}
?>

<form method="post" action="" enctype='multipart/form-data'>
  <input type='file' name='file' value="Select" />
  <input type='submit' value='Upload' name='but_upload'>
</form>