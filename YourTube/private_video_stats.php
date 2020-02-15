 <!DOCTYPE html>
<html>
<body>
  <link rel="stylesheet" type="text/css" href="table_style.css">




 <table align="center"  border="1px" style="width:300px; line-height:30px;">
  <tr>
    <h3> Private Video Stats </h3>
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
 {//echo "<table>"; // start a table tag in the HTML
while($get_rows = mysqli_fetch_assoc($result)){ 
?>
  
  <tr>
  <td><?php echo $get_rows['id']; ?> </td>
  <td><?php echo $get_rows['view_count']; ?> </td>
  <td><?php echo $get_rows['like_count']; ?> </td>
  <td><?php echo $get_rows['dislike_count']; ?> </td>
  <td><?php echo $get_rows['comment_count']; ?> </td>
  </tr>



 <?php
 }
 
 }
 
 else
 {
     echo "<h3>Connection not established</h3>";
 }
 ?>
 </body>
</html>
