<?php
    $submit=false;
    $server= "localhost";
    $username= "root";
    $password= "";
    $database="travel";
    $variable=mysqli_connect($server,$username,$password,$database);
    $type=$_POST['type'];
    $title=$_POST['title'];
    $country=$_POST['country'];
    $state=$_POST['state'];
    $dist=$_POST['dist'];
    $division=$_POST['division'];
    $info=$_POST['info'];
    $image=$_FILES['image'];
    $imagecount=count($image['name']);
    for ($i=0;$i<$imagecount;$i++){
        $imagename=$image['name'][$i];
        $tem_name=$image['tmp_name'][$i];
        $error=$image['error'][$i];
        if($error==0){
        $filedest='./'.$imagename;

        $query="INSERT INTO destinations (`type`,`ttile`, `country`, `state`,`district`,`division`,`infor`,`photo`) VALUES ('$type','$title','$country','$state','$dist','$division','$info','$imagename' )";
        move_uploaded_file($tem_name,$filedest);
        $result=mysqli_query($variable,$query);
        }
    }
    if(mysqli_affected_rows($variable)>=1){
        header('location:destination_successfull.php');
     }
    else{
        header('location:login_as_admin.php');   
    }
    
?>