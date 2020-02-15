  <?php 
  session_start(); 
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: admin_login_form.php');
    $message = "You must log in first";
      echo "<script type='text/javascript'>alert('$message');</script>";
      ?><script type="text/javascript">
         alert("You must log in first";
         location="admin_login_form.php");
      </script><?php
  }
  if (isset($_GET['logout'])) {
  	
     unset($_SESSION['username']);
    session_destroy();
   
    $_SESSION = array();
    header("location: admin_login_form.php");
  }
?>
 <!DOCTYPE html>
<html>
<body>
  <link rel="stylesheet" type="text/css" href="table_style_locked.css">
   <div class="header">
	<h1>Locked Video Stats</h1>
<div class="content">
  	<!-- Notify for successful login -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
           
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!--  User Welcome After Log in -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Admin: <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="admin.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>



 <table align="center"  border="1px" style="width:300px; line-height:30px;">
  <tr>
    
    </tr>
    <th>Video ID</th>
    <th>Views</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>Comments</th>
  </tr>



 <?php

 $db = mysqli_connect('127.0.0.1', 'root', 'adios', 'youtube_embed');
 $public = "Select * from private_stats";
 $result = mysqli_query($db,$public);
 if($result)
 {
while($get_rows = mysqli_fetch_assoc($result)){ 
?>
  
  <tr>
  <td><?php echo $get_rows['id']; ?> </td>
  <td><?php echo $get_rows['view_count']; ?> </td>
  <td><?php echo $get_rows['like_count']; ?> </td>
  <td><?php echo $get_rows['dislike_count']; ?> </td>
  <td><?php echo $get_rows['comment_count']; ?> </td>
  </tr>



 <?php //Show locked video stats for admin
 }
 
 }
 
 else
 {
     echo "<h3>Connection not established</h3>";
 }
 ?>
 </body>
</html>
