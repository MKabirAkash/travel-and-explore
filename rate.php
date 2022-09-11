<html>
<head>
<title>Rating</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
<script src="jquery-3.0.0.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="jquery-bar-rating-master/dist/jquery.barrating.min.js"></script>
<script type="text/javascript">
$(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {
                  alert('success');
                    var el = this;
                    var el_id = el.$elem.data('id');
                    if (typeof(event) !== 'undefined') {
                        var split_id = el_id.split("_");
                        var postid = split_id[1];  
                        $.ajax({
                            url: 'ratecalculate_ajax.php',
                            type: 'post',
                            data: {postid:postid,rating:value},
                            dataType: 'json',
                            success: function(data){
                                var average = data['averageRating'];
                                $('#avgrating_'+postid).text(average);
                            }
                        });
                    }
                }
            });
        });
</script>
</head>
<body>
<p><h1 align="center">Rate here</h1></p>
<div class="content">
<?php
 include "dbcon2.php";
if(isset($_GET['id']) && ctype_digit($_GET['id'])){
  $idd= intval($_GET['id']);
  $q="SELECT * from destinations WHERE id=?";
  $prepared = $conn->prepare($q);
  $prepared->execute(array($idd));
  // product_id, product_name, cat
  if($prepared->rowCount() == 1){
    $row=$prepared->fetch();
    $postid=$row['id'];
    $query = "SELECT * FROM post_rating WHERE postid=?";
    $userresult = $conn->prepare($query);
    $userresult->execute(array($postid));
    $rowrate=$userresult->fetch();
    $rating = $rowrate['rating'];

    $query1 = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid=?";
    $avgresult = $conn->prepare($query1);
    $avgresult->execute(array($postid));
    $avgrow=$avgresult->fetch();
    $averageRating = $avgrow['averageRating'];
 
    if($averageRating <= 0){
        $averageRating = "No rating yet.";
    }
  }
  else{
    echo "failed";
  }

}
?>
     <div class="post">
        <h1><a href='<?php echo $link; ?>' class='link' target='_blank'><?php echo $postid; ?></a></h1>
        <div class="post-action">
            <select class='rating' id='rating_<?php echo $postid; ?>' data-id='rating_<?php echo $postid; ?>'>
                <option value="1" >1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
                <option value="5" >5</option>
            </select>
            <div style='clear: both;'></div>
            <script type='text/javascript'>
                $(document).ready(function(){
                    $('#rating_<?php echo $postid; ?>').barrating('set',<?php echo $rating; ?>);
                });     
            </script>
        </div>
        <div class="home">
            <h3 allign='center'><a href="userhome.php">Return Home</a></h3>
        </div>
    </div>
<?php
?>
</div>
<style>
.content{
    border: 0px solid black;
    border-radius: 3px;
    padding: 5px;
    margin: 0 auto;
    width: 50%;
}
.post{
    border-bottom: 1px solid black;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
}
.post:last-child{
    border: 0;
}
.post h1{
    font-weight: normal;
    font-size: 30px;
}
.post a.link{
    text-decoration: none;
    color: black;
}
.post-text{
    letter-spacing: 1px;
    font-size: 15px;
    font-family: serif;
    color: gray;
    text-align: justify;
}
.post-action{
    margin-top: 15px;
    margin-bottom: 15px;
}
 
.like,.unlike{
    border: 0;
    background: none;
    letter-spacing: 1px;
    color: lightseagreen;
}
.like,.unlike:hover{
    cursor: pointer;
}
</style>
</body>
</html>
  