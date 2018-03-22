<?php
session_start();
if (!isset($_SESSION['uid'])){
header('location:logsign.php');
exit();
}
require 'dbconnect.php';

$query=mysqli_query($link,"SELECT * FROM users WHERE Uid='".$_POST['uid']."' && Password='".$_POST['password']."'");
//$pquery=mysqli_query($link,"SELECT * FROM user_post WHERE Uid='".$_POST['uid']);
 $pquery=mysqli_query($link,"SELECT * FROM user_post WHERE Uid='".$_SESSION['uid']."'");
 //query for image
  $ppquery=mysqli_query($link,"SELECT Profile_Pic FROM users WHERE Uid='".$_SESSION['uid']."'");


    $count=mysqli_num_rows($query);
    $countp=mysqli_num_rows($pquery);

//Time in ago format function
    function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="author" content="Team Hestabit">
    <meta name="description" content="">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <title>Hestabit &copy;</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--CDN FOR Font Awesom-->
  
    <link rel="stylesheet"  type="text/css" href="css\bootstrap.min.css"/>
<style type="text/css">
.header-section{
	background: url("images/footer-bg.png");
	width: 100%;
	height: 105px;	
}
.post-body{
	background-image: url("images/map.png");
	width:100%;
	height: 770px;
	background-size: cover;
	position: relative;
	background-repeat: no-repeat;
}
.footer-section{
	background: url("images/footer-bg.png");
	width: 100%;
	height: 115px;	
}
.header-text{
	font-size: 70px;
	color: white;
	text-align: ;
}
.custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
.edit-button{
	text-align: center;
}
.profile{
	border-radius: 50%;
	text-align: center;
}
.logout{
	font-size: 40px;
	color: white;
	text-align: center;
	border: 4px solid white;
	margin-top: 15px;
}
p a {
	color: white;
}
</style> 
 
	</head>
<body>

<div class="header-section">
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="header-text">
			<p>FaceLook</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="logout">
			<p><a href="logout.php">Logout</a></p>
			</div>
		</div>		
	</div>
</div>
</div>
<br>
<div class="post-body">
	<div class="container">
		<div class="row">
			<div class="col-md-5" style="border: 1px solid black;box-shadow: 3px 4px 48px 0px rgba(111,161,247,1);
">
				<div class="profile"><!--user profile Image-->
          <?php
          $row=mysqli_fetch_array($ppquery,MYSQLI_ASSOC)
            ?>
					<p><?php echo "<img src='ppic/".$row['Profile_Pic']."' height = '130px' width = '130px'>";?></p>
				</div>
				<div class="upload-button" align="center">
          <form method="post" action="uploadphoto.php" enctype='multipart/form-data'>
             <input type='file' name='file' value="Select" />
            <input type='submit' value='Upload' name='but_upload'>
          </form>
				</div>
				<div class="user-deatils">
					<form>
  						<div class="form-group">
    						<label for="inputsm">User-Name</label>
    							<input class="form-control input-sm" id="inputsm" type="text" value="<?php  echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>">
  							</div>
 						<div class="form-group">
    						<label for="inputsm">First-Name</label>
    							<input class="form-control input-sm" id="inputsm" type="text" value="<?php  echo isset($_SESSION['user_name']) ? $_SESSION['first_name'] : ''; ?>">
  							</div>
  						<div class="form-group">
    						<label for="inputsm">Last-Name</label>
    							<input class="form-control input-sm" id="inputsm" type="text" value="<?php  echo isset($_SESSION['user_name']) ? $_SESSION['last_name'] : ''; ?>">
  							</div>
  						<div class="form-group">
    						<label for="inputsm">Email</label>
    							<input class="form-control input-sm" id="inputsm" type="text" value="<?php  echo isset($_SESSION['user_name']) ? $_SESSION['email'] : ''; ?>">
  							</div>
  						<div class="form-group">
    						<label for="inputsm">Uid</label>
    							<input class="form-control input-sm" id="inputsm" type="text" value="<?php  echo isset($_SESSION['user_name']) ? $_SESSION['uid'] : ''; ?>">
  							</div>
  						<div class="form-group">
  							<label for="comment">About You</label>
  								<textarea class="form-control" rows="5" id="comment"></textarea>
						</div>				 							 							   
					</form>
							
 
							<button id="opener">Open Edit</button><br>
 
				</div>
			</div><br>
			<div class="col-md-7" style="">
				<form action="post.php" method="POST">
					<div class="input-group">
   						<input type="text" class="form-control" name="post-text" id="upost">
   						<span class="input-group-btn">
       					 <button class="btn btn-default" type="submit" name="post-button" onClick="return empty()">Post Here!!</button>
   						</span>
					</div>
				<p>
					<div class="form-group">
  							<label for="comment">Your Post</label>
  							<?php 
  							if($countp>0){
  								//echo 'fff';
  								while($row=mysqli_fetch_array($pquery,MYSQLI_ASSOC)){
  									?>
  									<p><?php echo $row['Text_post'] ?></p>
  									<p><?php echo time_elapsed_string($row['Time']) ?></p>
  									<?php
  								}
  							}

  							?>
  							
					</div>	
					<div class="form-group">
  							<label for="comment">Your Image</label>
  							<textarea class="form-control" rows="14" id="comment">
  								<img src="" alt="user_post_image_url">
  							</textarea>
					</div>	
				</p>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="footer-section">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p align="center">Copy &copy; All Rights Reserved.</p>
		</div>
	</div>
</div>
</div>
<!--edit buuton form!-->
<div id="dialog" title="Edit Details" style="background-color: white">
  								<form  action="edit.php" method="POST" role="form">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="text" name="fname" id="confirm-password" tabindex="2" class="form-control" placeholder="First Name">
									</div>
									<div class="form-group">
										<input type="text" name="lname" id="confirm-password" tabindex="2" class="form-control" placeholder="Last Name">
									</div>									
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="edit-submit" id="" tabindex="4" class="form-control btn btn-register" value="Edit Now">
											</div>
										</div>
									</div>
								</form>
</div>

<script type="text/javascript">
	$('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
//Function To Display Popup
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
//funtion to check post is disable when left empty
function empty() {
    var x;
    x = document.getElementById("upost").value;
    if (x == "") {
        alert("Please Either Post Something OR Pass Image URL");
        return false;
    };
}
</script>  

</body>
</html>