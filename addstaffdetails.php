<?php 
include 'db_connect.php';

    $StaffID= '';
    $errors = array('StaffID' => '', 'login' => '');

     if(isset($_POST['Add'])){
        $StaffID=$_POST['StaffID'];
        $Name=$_POST['Name'];
        $Designation=$_POST['Designation'];
        $Gender=$_POST['Gender'];
        $DOB=$_POST['DOB'];
        $DOJ=$_POST['DOJ'];
        $Salary=$_POST['Salary'];
        $Mobile=$_POST['Mobile'];
        $Email=$_POST['Email'];
        $pwd=$_POST['pwd'];

            $sql="insert into `staff` values('$StaffID','$Name','$Designation','$Gender','$DOB','$DOJ','$Salary','$Mobile','$Email','',md5('$pwd'))";
            $result = mysqli_query($conn,$sql);

            if($result)
            {
                echo "Data inserted successfully";
                header("Location:adminboard.php");
              
            }
            else
            {
                $sql = "SELECT * FROM staff WHERE StaffID='$StaffID'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 1){
                    $errors['login'] = 'Staff ID already excist!';
                }
            }
     }
     mysqli_close($conn);
    
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
            </style>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10"><img src="Images/logo.png" id="logo" style="height: 100px !important; margin-top: 10px !important; margin-left:10px !important; " ></div>
    <div class="background"></div> 
    <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 50%;">
        <div class="container-fluid bg-secondary text-white p-3 mb-2" style="border-radius: 5px;">
            <h2>ENTER STAFF DETAILS</h2>
        </div>
        <img src="Images/userlogo.png" style="margin:10px auto; height: 140px; width: 140px; margin-bottom: -20px;">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="row text-left">
            <div class="col-md-6 p-5">
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-id-card "></i> Staff ID : </label><br />
                    <input type="text" style="border-radius: 8px;" name="StaffID" required />
                    <label class="text-danger"><?php echo $errors['login'];?></label>
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-pencil"></i> Staff Name : </label><br />
                    <input type="text" style="border-radius: 8px;" name="Name" Required />
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-hand"></i> Designation : </label><br />
                    <input type="text" style="border-radius: 8px;" name="Designation" Required />
                </div>
                <div class="form-group" style="font-size: 20px;">
                    <label style="font-size: 20px;"><i class="fa fa-user"></i> Gender : </label><br />
                    <input type="radio" name="Gender" value="Male" /> Male <br />
                    <input type="radio" name="Gender" value="Female"/> Female <br />
                    <input type="radio" name="Gender" value="Transgender"/> Transgender <br />
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-key"></i> Add Password : </label><br />
                    <input type="password" style="border-radius: 8px;" name="pwd" Required />
                </div>
            </div>
            <div class="col-md-6 p-5">
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-calendar"></i> Date of birth: </label><br />
                    <input type="text" style="border-radius: 8px;" placeholder=" YYYY - MM - DD " name="DOB" Required />
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-calendar"></i> Date of joined : </label><br />
                    <input type="text" style="border-radius: 8px;" placeholder=" YYYY - MM - DD " name="DOJ" Required />
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-money-check-dollar"></i> Salary : </label><br />
                    <input type="text" style="border-radius: 8px;" name="Salary" Required />
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-phone"></i> Mobile : </label><br />
                    <input type="text" style="border-radius: 8px;" name="Mobile" Required />
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;"><i class="fa fa-envelope"></i> Email : </label><br />
                    <input type="text" style="border-radius: 8px;" name="Email" Required />
                </div>
            </div>
        </div>
            <a href="adminboard.php" class="btn btn-light" style="font-size: 20px;">Back</a>
            <input type="submit" name="Add" class="btn btn-secondary text-center" value="Add" style="font-size: 20px;">
        </form>


    </div>

<?php include_once 'bottom.php' ?>