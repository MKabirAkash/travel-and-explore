<?php
$server= "localhost";
$username= "root";
$password= "";
$database="travel";
$variable=mysqli_connect($server,$username,$password,$database);
$userid = 4;
$postid = $_POST['postid'];
$rating = $_POST['rating'];
 
$query = "SELECT COUNT(*) AS cntpost FROM post_rating WHERE postid='.$postid.' and userid='.$userid'";
 
$result = mysqli_query($variable,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];
 
if($count == 0){
    $insertquery = "INSERT INTO post_rating(userid,postid,rating) values(".$userid.",".$postid.",".$rating.")";
    mysqli_query($variable,$insertquery);
}else {
    $updatequery = "UPDATE post_rating SET rating='. $rating .' where userid='. $userid .' and postid='. $postid'";
    mysqli_query($variable,$updatequery);
}
 
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid='.$postid'";
$result = mysqli_query($variable,$query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];
$return_arr = array("averageRating"=>$averageRating);
 
echo json_encode($return_arr);
