<?php
include 'db_connect.php';
if(isset($_GET['deleteid'])){
    $Branch_id=$_GET['deleteid'];
    
    $sql="delete from `branches` where Branch_id='$Branch_id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        //echo"Deleted Successfully";
        header('location:adminboard.php');
    }else{
         die(mysqli_error($conn));
    }
}

?>