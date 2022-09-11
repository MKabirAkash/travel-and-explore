<?php
require_once('dbcon2.php');
if(isset($_GET['id']) && ctype_digit($_GET['id'])){
    $tid=intval($_GET['id']);
    $sq="SELECT * from trips where tid=?";
    $rs=$conn->prepare($sq);
    $rs->execute(array($tid));
    $row=$rs->fetch();
    $prevjoined=$row['joined'];
    $people= $prevjoined + 1 ;
    $sq2="UPDATE  `trips` set `joined`=? where `tid`=?";
    $rs2=$conn->prepare($sq2);
    $rs2->execute(array($people,$tid));
    if($rs2->rowcount()==1){
        header('location:trips.php');
    }
    else{
        echo "Failed to update";
    }
    
}
else{
    echo "failed error 404";
}

?>