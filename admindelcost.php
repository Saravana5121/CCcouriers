<?php
include 'db_connect.php';
if(isset($_GET['deleteid'])){
    $S_No=$_GET['deleteid'];
    
    $sql="delete from `pricing` where S_No='$S_No'";
    $result=mysqli_query($conn,$sql);
    if($result){
        //echo"Deleted Successfully";
        header('location:adminboard.php');
    }else{
         die(mysqli_error($conn));
    }
}

?>