<?php
include"db_connect.php";
$StaffID=$_GET['updateid'];
$sql="select * from `staff` where StaffID='$StaffID' ";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
  if(isset($_POST['submit'])){
           $Name=$_POST['Name'];
           $Designation=$_POST['Designation'];
           $Gender=$_POST['Gender'];
           $DOB=$_POST['DOB'];
           $DOJ=$_POST['DOJ'];
           $Salary=$_POST['Salary'];
           $Mobile=$_POST['Mobile'];
           $Email=$_POST['Email'];

            $sql = "update `staff` set Name='$Name',Designation='$Designation',Gender='$Gender',DOB='$DOB',DOJ='$DOJ',Salary='$Salary',Mobile='$Mobile',Email='$Email' where StaffID='$StaffID'";
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
                    <h2 class="modal-title" id="exampleModalLabel"><b>UPDATING STAFF DATA</b></h2>
                    <button type="submit" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" name="close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-pencil"></i> <b>Staff Name :</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Staff Name" name="Name" value="<?php echo $row['Name'];?>">
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-hand "></i> <b>Designation :</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Designation" name="Designation" value="<?php echo $row['Designation'];?>">
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-user"></i> <b>Gender :</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Gender" name="Gender" value="<?php echo $row['Gender'];?>">
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-calendar"></i> <b>Date of birth :</b></label>
                    <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="DOB" value="<?php echo $row['DOB'];?>">
                </div>
                <div class="mb-3">
                    <label><i class="fa fa-calendar "></i> <b>Date Of joined:</b></label>
                    <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="DOJ" value="<?php echo $row['DOJ'];?>">
                </div>
                    <div class="mb-3">
                    <label><i class="fa fa-money-check-dollar "></i> <b>Salary</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Salary" name="Salary" value="<?php echo $row['Salary'];?>">
                </div>
                    <div class="mb-3">
                    <label><i class="fa fa-phone "></i> <b>Mobile</b></label>
                    <input type="text" class="form-control" placeholder="Enter the Mobile number" name="Mobile" value="<?php echo $row['Mobile'];?>">
                </div>
                    <div class="mb-3">
                    <label><i class="fa fa-envelope "></i> <b>Email</b></label>
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




