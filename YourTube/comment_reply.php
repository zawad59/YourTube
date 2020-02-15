<?php

if(isset($_GET['link']) && $_GET['link'] !== ''){
  $received_id = $_GET['link'];
  
} else {
  echo "failed";
}
 $video_id = $received_id;
 $embed_url = "https://www.youtube.com/embed/";
 $show_video = $embed_url.$video_id;
 $api_key = "AIzaSyCnqIPSOahmfc3vvJzQ3EqZxkUJJJmNfBU";
$url_comments = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=";
$url_comments2 = $url_comments.$video_id."&key=".$api_key;
$comments = file_get_contents($url_comments2);
$comArray = json_decode($comments, true);
?>
<div style="float:center;padding:12px;">
 <iframe src="<?php echo $show_video; ?>" width="1520" height="615" ></iframe>
<?php
 //Showing newest 20 comments with replies so loop through 20 comments
 $count = 1;
 for($i=0;$i<20;$i++)
 {
     echo '<br>';
     echo '<strong style="color:maroon;">'.$comArray["items"][$i]['snippet']['topLevelComment']['snippet']['authorDisplayName'].'</strong>';
    echo '<br>';
     echo $comArray["items"][$i]['snippet']['topLevelComment']['snippet']['textOriginal'];
     $count+=1;
     echo '<br>';
     echo '<b style="color:blue;">'.'Likes : '. $comArray["items"][$i]['snippet']['topLevelComment']['snippet']['likeCount'].' '.'Replies : '.$comArray["items"][$i]['snippet']['totalReplyCount'].'</b>';
$res = $comArray["items"][$i]['snippet']['totalReplyCount'];
      echo '<br>';
   if($res>0)
     {
         //Showing replies and the username who has replied for comments that have replies
         
         $parent_Id =  $comArray["items"][$i]["id"];
         $reply_url = "https://www.googleapis.com/youtube/v3/comments?key=";
         $reply_url2 = $reply_url.$api_key."&part=id,snippet&parentId=".$parent_Id;
         $get_replies = file_get_contents($reply_url2);
         $reply_array =  json_decode($get_replies, true);
         for($k=0;$k<$res;$k++)
         {echo '>><em style="color:maroon;">'."   ".$reply_array["items"][$k]["snippet"]["authorDisplayName"].':</em>';
         echo " ".$reply_array["items"][$k]["snippet"]["textOriginal"];
          $count+=1;
         echo "<br>";
         if($k==$res)
             break;
         }
     } 
     if ($count>20)  
     {
         break;
     }   
 }
 ?>