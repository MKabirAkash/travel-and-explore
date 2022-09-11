<?php
    session_start();
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="travel";
    // Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
    $strSQL= "SELECT * from `blogs` ";
    $res=mysqli_query($conn,$strSQL);
    if(mysqli_affected_rows($conn)>=1){
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- CSS only -->
            <!-- CSS only -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="./css/styleLogin.css">
            <title>AKASH VAIA || PROJECT</title>
        </head>
        <body>
            <section class="hero">
                <div class="container">
                    <div class="nav row pt-4">
                        <div class="col-4 text-light"> <h4>Travel & Explore</h4></div>
                        <div class="col-4 text-light"> <div class="row">
                            <div class="col-4"> <a href="userhome.php" class="text-light">Home</a></div>
                            <div class="col-4"><a href="blogs.php" class="text-light">Blogs</a></div>
                            <div class="col-4"><a href="trips.php" class="text-light">Trips</a></div>
                        </div>
                    </div>
                        <div class="col-4 d-flex justify-content-end"> <a href="loginadmin.php" class="btn btn-outline-light rounded-pill">Login as Admin</a></div>
                    </div>';
                    if(isset($_SESSION['authuser_name'])){
                        echo'
                <div class="col-2 d-flex justify-content-end">
                     <h3>' .$_SESSION['authuser_name'].'</h3>
                </div>';
                    
                        echo'
                        <div class="col-2 d-flex justify-content-end">
                             <a href="logout.php" class="btn btn-outline-light rounded-pill">logout</a>
                        </div>';
                    }
                ?>
                <?php 
                echo'
                    <div class="header text-center pt-5 text-light">
                        <h2>Its a big world out there, <br> Go Explore</h2>
                        <p class="pt-4">Thinking of taking a break from every days Busy Life? Dont Worry, <br> we take care of your trip</p>
                        <div class="header text-center pt-5 text-light">
                        <div class="header text-center pt-5 text-light">
                        <a href="addABlog.php" class="btn btn-success btn-lg rounded-pill px-5">Add a Blog</a>
                    </div>
                </div>
            </section>
            <h1 align="center">Available Blogs</h1>';
        while($rows=mysqli_fetch_assoc($res))
        {
            
            $title=$rows['title'];
            $blog_id=$rows['bid'];
            $name=$rows['aname'];

            echo '
            <div class="result">
            <h3><a href="blogdetail.php?bid='.$blog_id.'" class="text-dark">Title :'. $title. '</a> </h3>
            <p>Author bame: '. $name .'</p>
            
      </div>'; 
        }
        
    }
    else{
        echo "failed";
    }

?>