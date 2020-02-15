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
  <link rel="stylesheet" type="text/css" href="style_admin_home.css">
<div class="header">
	<h1>Admin Home</h1>

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
    	<p>Hello <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="admin.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
</div>

<title>Hellotube Admin</title>
<form action = "admin.php" method = "get">
<div class="url">
  <h2 style="float:center; color:blue" id="ytb">Youtube URL</h2>
  <input type="text" style="float:center" autocomplete="off" rows="2" cols="60" name="url"   size="45"  >

  <br>
   </div> 
   <div class="Go">
  <input type="submit" style="float:center;   background-color: #3354FF;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer" value="Add Video" id="Go" >
  </div>
</form>
<form action = "admin.php" >


</form>
<section class="links">
<div class="link1">
<a href="public_video_stats.php" <?php "     "?> id = "public">Public Videos</a>
</div>
<div class="link2">
<a href="locked_video_stats.php" id = "locked">Locked Videos</a>
</div>

</section>
<div class="link3">
<a href="Signed_in_users.php" id = "users">Users</a>
</div>
</body>


<?php
//the string entered by the admin has to contain the youtube.com/watch part otherwise it wont be valid url

$check_url = "https://www.youtube.com/watch";  

//API Key generated from google api v3 for youtube

$api_key = "AIzaSyCnqIPSOahmfc3vvJzQ3EqZxkUJJJmNfBU";

if (isset($_GET["url"]))
{$c = $_GET["url"];

Do_Check($c,$check_url,$api_key);
}


    function Do_Check($c,$check_url,$api_key)//function to check url is valid or not
    {
    if (strpos($c,$check_url)===0) {
       
       $youtube_url= $_GET["url"];
       $video_id = get_id_from_url($youtube_url);
       
      
       $api_url = "https://www.googleapis.com/youtube/v3/videos?part=statistics&id=";//API to generate JsonResponse from youtube videos


$final_url = $api_url.$video_id."&key=";
    
    $response = file_get_contents($final_url. $api_key);
    $checkresponse = json_decode($response,true);
    
    //Indexing keys of dictionaries to find total views and then to insert into db table
    
    $views = $checkresponse["items"][0]['statistics']['viewCount'];
    $likes = $checkresponse["items"][0]['statistics']['likeCount'];
    $dislikes = $checkresponse["items"][0]['statistics']['dislikeCount'];
    $total_comments =  $checkresponse["items"][0]['statistics']['commentCount'];
    echo "<b>Total Views : </b>".$views;
    $dbhost = '127.0.0.1';
 $dbuser = 'root';
 $dbpass = 'adios';
 $db = 'youtube_embed';
    if($views<=100000)
{
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    $query = "Insert into private_stats(id,like_count,dislike_count,view_count,comment_count)values('$video_id','$likes','$dislikes','$views','$total_comments')";
    if($conn->query($query))
    {
        echo "<br>inserted into private table";
    }
    else
    {
        echo "<br>".$conn->error;
    }
 
 $conn -> close();
 }

else if($views>100000)
{
    
 
    echo '<br>'?>
     
    <?php
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 $query = "Insert into public_stats(id,like_count,dislike_count,view_count,comment_count)values('$video_id','$likes','$dislikes','$views','$total_comments')";
    if($conn->query($query))
    {
        echo "<br>inserted into public table";
    }
    else
    {
        echo "<br>".$conn->error;
    }
 
 
$conn -> close();
 

}


    }else if($c=='')
        echo "Enter Youtube URL";
    else
        echo "Invalid URL";
    }
    
//Video ID from youtube is extracted as video IDs can be associated at different positions in a youtube url

function get_id_from_url($you_url)
{
    $id = explode("?v=", $you_url);
    if (empty($id[1]))
    $id = explode("/v/", $you_url);
    $id = explode("&", $id[1]);
    $id = $id[0];
    return $id;
}

?>
</html>