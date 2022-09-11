<?php
  
    $server= "localhost";
    $username= "root";
    $password= "";
    $database="travel";
    $variable=mysqli_connect($server,$username,$password,$database);

    $usermail=$_POST['email1'];
    $password1=$_POST['pass1'];
    $query1= "SELECT * from admins having `email`='".$usermail."' and `password`='".$password1."'" ;
    $result1=mysqli_query($variable,$query1);
    $rows=mysqli_num_rows($result1);
    if($rows==1){
       header('location:login_as_admin.php');
    }
    else{
        header('location:index.php');
    }
?>
