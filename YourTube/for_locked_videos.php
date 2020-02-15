<?php 
  session_start(); 
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

   //Embedded Locked Videos Page
  
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login_form.php');
  }
  if (isset($_GET['logout'])) {
  
     unset($_SESSION['username']);
    session_destroy();
   
    $_SESSION = array();
    header("location: homepage.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Locked Videos</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<div class="header">
	<h2>YourTube Exclusive</h2>
</div>
<div class="content">
  		<!-- Notify for successful login -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="abier" >
      	<p>
          <?php 
          	//echo $_SESSION['success']; 
          	unset($_SESSION['success']);
           
          ?>
      	</p>
      </div>
  	<?php endif ?>

     <!--  User Welcome After Log in -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="for_locked_videos.php?logout='1'" style="color: red;" >logout</a> </p>
    <?php endif ?>
</div>
	<?php
  $dbhost = '127.0.0.1';
  $dbuser = 'root';
 $dbpass = 'adios';
 $db = 'youtube_embed';
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 $get_video_ids = "Select * from private_stats";
 
 $ids = array();
 $like_count = array();
 $dislike_count = array();
 $view_count = array();
 $comment_count = array();
 
if ($total_ids = $conn -> query($get_video_ids)) {
 
  if(($total_ids -> num_rows)>0)
  {
      $total_id_count = $total_ids -> num_rows;
      while($row = $total_ids->fetch_assoc()) {
        
          $ids[] = $row['id'];
          $like_count[] = $row['like_count'];
          $dislike_count[] = $row['dislike_count'];
          $view_count[] = $row['view_count'];
          $comment_count[] = $row['comment_count'];
  }
 
}
for($i=0;$i<$total_id_count;$i++)
{ 
    $embed_string = "https://www.youtube.com/embed/".$ids[$i]; //Embedding videos on the page by getting ids from private_stats table
    ?>

 <div style="float:left;padding:12px;">
 <iframe src="<?php echo $embed_string; ?>" width="473" height="315" ></iframe>
 <?php  
echo "<b><br>Views : </b>".$view_count[$i];
echo "<b> Likes : </b>".$like_count[$i];
echo "<b> Dislikes </b>: ".$dislike_count[$i];
echo "<b>  Comments </b>: ".$comment_count[$i];
echo "<br>";
echo '<a href="comment_reply_locked.php?link=' . $ids[$i] .'">View Comments & Replies</a>';
?>
<?php

?>
</div>

<?php
}
}
else
     echo "No ids found";
?>
</body>
</html>