<?php
    $submit=false;
    $server= "localhost";
    $username= "root";
    $password= "";
    $database="travel";
    $variable=mysqli_connect($server,$username,$password,$database);
    
    $dist=$_POST['title'];
    $division=$_POST['name'];
    $info=$_POST['infor'];
    $image=$_FILES['image'];
    $imagecount=count($image['name']);
    for ($i=0;$i<$imagecount;$i++){
        $imagename=$image['name'][$i];
        $tem_name=$image['tmp_name'][$i];
        $error=$image['error'][$i];
        if($error==0){
        $filedest='./'.$imagename;

        $query="INSERT INTO blogs (`title`,`aname`,`infor`,`photo`) VALUES ('$dist','$division','$info','$imagename' )";
        move_uploaded_file($tem_name,$filedest);
        $result=mysqli_query($variable,$query);
        }
    }
    if(mysqli_affected_rows($variable)>=1){
        header('location:destination_successfull.php');
     }
    else{
        header('location:addABlog.html');   
    }
    
?>