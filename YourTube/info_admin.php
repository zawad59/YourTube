<?php
session_start();
$username = "";
$email    = "";
 

//Database connection

$db = mysqli_connect('127.0.0.1', 'root', 'adios', 'youtube_embed');
$error_check = 0;

//Will insert user info for sign up and login if conditions like empty field and multiple entries are validated



//Login info check and validate
if (isset($_POST['login_admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username1']);
  $password = mysqli_real_escape_string($db, $_POST['password1']);
  $check_login = 0;
  if (empty($username)) {
  	$message_log = "Name required";
    echo "<script type='text/javascript'>alert('$message_log');</script>";
    $check_login = 1;
  }
  if (empty($password)) {
  	$message_log = "password required";
    echo "<script type='text/javascript'>alert('$message_log');</script>";
    $check_login = 1;
  }

  if ($check_login == 0) {
  	$password = md5($password);
  	$check_user = "SELECT * FROM admin WHERE name='$username'"; 
  	$result_user = mysqli_query($db, $check_user);
    if($result_user)
    {
        if (mysqli_num_rows($result_user) == 1) {
        $check_pass = "SELECT * FROM admin WHERE password='$password'";
        $result_pass = mysqli_query($db, $check_pass);
        if($result_pass)
        {
            if(mysqli_num_rows($result_pass)==1)
            {
                $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: admin.php');
            }
            else
        {
            $message_log = "Wrong password for admin";
            echo "<script type='text/javascript'>alert('$message_log');</script>";
        }
        }
  	  
  	}else {
  		$message_log = "Admin name not found";
    echo "<script type='text/javascript'>alert('$message_log');</script>";
  	}
        
    }
    else
    {
        	$message_log = "No records found";
            echo "<script type='text/javascript'>alert('$message_log');</script>";
    }
    
  }
}
?>
