<?php  
session_start();
require 'dbconnect.php';

        if(isset($_POST['login-submit'])){


    $query=mysqli_query($link,"SELECT * FROM users WHERE Uid='".$_POST['uid']."' && Password='".$_POST['password']."'");
    $count=mysqli_num_rows($query);
   

    if ($count==1)
    {
       $row=mysqli_fetch_array($query);
        
        $_SESSION['email'] = $row['Email_Id'];
        
        $_SESSION['first_name'] = $row['First_Name'];
        $_SESSION['last_name'] = $row['Last_Name'];
        $_SESSION['user_name'] = $row['User_Name'];
        $_SESSION['uid'] = $row['Uid'];
        
        header("location: dashboard.php");
        }
    else
    {
    echo "<script>
    alert('Either Uid or Password Wrong!!! TRY Again');
    window.location.href='logsign.php';
    </script>";        }  
        } 

    mysqli_close($link);
    ?>