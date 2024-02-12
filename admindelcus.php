<?php
include 'db_connect.php';
if(isset($_GET['deleteid'])){
    $loginid=$_GET['deleteid'];
    
    $sql="delete from `customers` where loginid='$loginid'";
    $result=mysqli_query($conn,$sql);
    if($result){
        //echo"Deleted Successfully";
        header('location:adminboard.php');
    }else{
         die(mysqli_error($conn));
    }
}

?>