<?php
session_start();
$username = "";
$email    = "";
 


//Database connection
$db = mysqli_connect('127.0.0.1', 'root', 'adios', 'youtube_embed');
$error_check = 0;

//Will insert user info for sign up and login if conditions like empty field and multiple entries are validated

if (isset($_POST['reg_user'])) {
 
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  
  if (empty($username))
      {
          $message = "Username required";
          echo "<script type='text/javascript'>alert('$message');</script>";
          $error_check = 1;
      }
  if (empty($email))
      { 
          $message = "Email required";
          echo "<script type='text/javascript'>alert('$message');</script>";
          $error_check = 1;
      }
  if (empty($password_1))
      {
          $message = "password required";
          echo "<script type='text/javascript'>alert('$message');</script>";
          $error_check = 1;
      }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //echo "Invalid email format";
      $message = "Invalid email";
      echo "<script type='text/javascript'>alert('$message');</script>";
      $error_check = 1;
      
}
//Multiple entry with username or email check

  if ($password_1 != $password_2) {
	      $message = "Passwords dont match";
          echo "<script type='text/javascript'>alert('$message');</script>";
          $error_check = 1;
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user_info WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  //$user = mysqli_fetch_assoc($result);
  if($result)
  {
  while($user = mysqli_fetch_assoc($result))
   { // if user exists
    if ($user['username'] === $username) {
      $message = "Username already exists";
      echo "<script type='text/javascript'>alert('$message');</script>";
      $error_check = 1;
    }

    if ($user['email'] === $email) {
       $message = "email already exists";
       echo "<script type='text/javascript'>alert('$message');</script>";
      $error_check = 1;
    }
  }
  }else
  {
       echo "Connection not established to database";
  }

   // Sign up user if all conditions are validated
  if ($error_check == 0) {
  	$password = md5($password_1);//Password encryption before saving to table

  	$query = "INSERT INTO user_info(username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: for_locked_videos.php');
  }
}
//Check for Login
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username1']);
  $password = mysqli_real_escape_string($db, $_POST['password1']);
  $check_login = 0;
  if (empty($username)) {
  	$message_log = "Username required";
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
  	$check_user = "SELECT * FROM user_info WHERE username='$username'"; 
  	$result_user = mysqli_query($db, $check_user);
    if($result_user)
    {
        if (mysqli_num_rows($result_user) == 1) {
        $check_pass = "SELECT * FROM user_info WHERE password='$password'";
        $result_pass = mysqli_query($db, $check_pass);
        if($result_pass)
        {
            if(mysqli_num_rows($result_pass)==1)
            {
                $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: for_locked_videos.php');
            }
            else
        {
            $message_log = "Wrong password for user ";
            $final_msg = $message_log.$username;
            echo "<script type='text/javascript'>alert('$final_msg');</script>";
        }
        }
  	  
  	}else {
  		$message_log = "Username not found";
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
