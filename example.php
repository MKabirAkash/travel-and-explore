
<!DOCTYPE html>
<html>
 <head>
  <title>Nested comment for travel and explore</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
    <?php
    if(isset($_GET['id'])){
        session_start();
        include('dbcon.php');
        $bid= $_GET['id'];
        $sl="SELECT * FROM blogs where bid=?";
        $rs=$conn->prepare($sl);
        $rs->execute(array($bid));
        $row=$rs->fetch();
        $_SESSION['postid']=$row['bid'];
        $title=$row['title'];
        $aname=$row['aname'];
        $infor=$row['infor'];

    ?>
  <h1 align="center">Travel and Explore </h1>
  <h2 align="center"><a href="#"><?php echo "Blog Title: $title";?></a></h2>
  <h3 align="center"><?php echo "Author name: $aname";?></h3>
  <p align="center"><?php echo "$infor";?></p>
  <br />
  <div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group">
    <div class="col-4 text-light"> <h4><a href="blogs.php">Return to Blogs</a></h4></div>
    <label for="">Commentor name</label>
                        <select name="comment_name">
                        	<option value="<?php if(isset($_SESSION['authuser_name'])){ echo $_SESSION['authuser_name']; } ?>">User account</option>
                        </select>
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
 </body>
</html>
<?php } ?>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});
</script>
