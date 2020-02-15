<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="style_home.css">
 <title>Hellotube</title>
<h1>YOURTUBE</h1>
<h2>Viewers choice to access quality contents</h2>
<p><a href = "admin_login_form.php" id = "admin">System Admin?</a></p><h3 id = "msg">To access exclusive content <a href = "login_form.php" id = "login">Login</a></h3>
<h3 id = "msg1">No account?<a href = "signup.php" id = "signup">Signup here</a></h3>

</form>
 
<?php
  $dbhost = '127.0.0.1';
  $dbuser = 'root';
 $dbpass = 'adios';
 $db = 'youtube_embed';
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 $get_video_ids = "Select * from public_stats";
 
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
    //echo "<br>".$ids[$i];
    $embed_string = "https://www.youtube.com/embed/".$ids[$i];// Embedding public videos by getting ids from public_stats table
    ?>

 <div style="float:left;padding:12px;">
 <iframe src="<?php echo $embed_string; ?>" width="473" height="315" ></iframe>
 <?php  
 

echo "<b><br>Views : </b>".$view_count[$i];
echo "<b> Likes : </b>".$like_count[$i];
echo "<b> Dislikes </b>: ".$dislike_count[$i];
echo "<b>  Comments </b>: ".$comment_count[$i];
echo "<br>";
echo '<a href="comment_reply.php?link=' . $ids[$i] .'">View Comments & Replies</a>';

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