<?php
include"db_connect.php";
$Branch_id=$_GET['updateid'];
$sql="select * from `branches` where Branch_id='$Branch_id' ";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
  if(isset($_POST['submit'])){

            $Address=$_POST['Address'];
            $Contact=$_POST['Contact'];
            $Email=$_POST['Email'];  

            $sql = "update `branches` set Address='$Address',Contact='$Contact',Email='$Email' where Branch_id='$Branch_id'";
            $result = mysqli_query($conn,$sql);

            if($result)
            {
              //echo "Data updated successfully";
                header('location:adminboard.php');
            }
            else
            {
                die(mysqli_error($con));
            }
    }
if(isset($_POST['close'])){
    header('location:adminboard.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CC Couriers</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon-32x32.png">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
             body, html{

            margin: 0;
            height: 100%;
            background-image: url('./Images/bbg3.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;  
            overflow-x: hidden;
            position: relative;
            z-index: -99;
            font-family: Arial, Helvetica, sans-serif !important; 

            }
            .form-control{
                width: 80%;
                
            }
            </style>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div class="container-fluid" style="background-color: rgba(255, 255, 255, 0.7); padding-left: 92px; margin-top: 20px; margin-bottom: 20px;border-radius: 15px; width: 60%;">
            <form method="post">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"><b>UPDATING BRANCH DATA</b></h2>
                    <button type="submit" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" name="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-map "></i> <b>Branch Address :</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Address" name="Address" value="<?php echo $row['Address'];?>">
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-phone "></i> <b>Contact :</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Contact Number" name="Contact" value="<?php echo $row['Contact'];?>">
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-envelope "></i> <b>Email :</b></label>
                    <input type="email" class="form-control" placeholder="Enter the Email ID" name="Email" value="<?php echo $row['Email'];?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" name="submit">Submit</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="close">Close</button>
                </div>
            </form>  

        </div>

    </body>
</html>




