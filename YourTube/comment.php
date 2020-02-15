<?php
$json1 = file_get_contents("https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=eR_5c6YUmT8&key=AIzaSyCnqIPSOahmfc3vvJzQ3EqZxkUJJJmNfBU");
$someArray = json_decode($json1, true);
$api_key = "AIzaSyCnqIPSOahmfc3vvJzQ3EqZxkUJJJmNfBU";

 for($i=0;$i<20;$i++)
 {
     
     $res = $someArray["items"][$i]['snippet']['totalReplyCount'];
if($res>0)
     {
         //echo "<b>All replies</b><br>";
         $parent_Id =  $someArray["items"][$i]["id"];
         $reply_url = "https://www.googleapis.com/youtube/v3/comments?key=";
         $reply_url2 = $reply_url.$api_key."&part=id,snippet&parentId=".$parent_Id;
         $get_replies = file_get_contents($reply_url2);
         $reply_array =  json_decode($get_replies, true);
         for($k=0;$k<$res;$k++)
         {
             
         echo "<br>".$reply_array["items"][$k]["snippet"]["authorDisplayName"];
         if($k==$res)
             break;
         }
     }
 }
 ?>