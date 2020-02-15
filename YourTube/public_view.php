<!DOCTYPE html>
<html>
<body>

  <title>Hellotube</title>
<h1>YOURTUBE</h1>
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
          //echo "id : ".$row['id'];
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
    $embed_string = "https://www.youtube.com/embed/".$ids[$i];
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