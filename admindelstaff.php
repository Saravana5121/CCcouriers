<?php
include 'db_connect.php';
if(isset($_GET['deleteid'])){
    $StaffID=$_GET['deleteid'];
    
    $sql="delete from `staff` where StaffID='$StaffID'";
    $result=mysqli_query($conn,$sql);
    if($result){
        //echo"Deleted Successfully";
        header('location:adminboard.php');
    }else{
         die(mysqli_error($conn));
    }
}

?>