<?php 
include 'db_connect.php';

$State_1 = $State_2 = $Cost = '';
$errors = array('State_1' => '', 'State_2' => '', 'Cost' => '','login' => '');

     if(isset($_POST['add'])){
        if(empty($_POST['State_1'])){
            $errors['State_1'] = "*Required";
        }else{
            $State_1 = $_POST['State_1'];
        }
        if(empty($_POST["State_2"])){
            $errors['State_2'] = "*Required";
        }else{
            $State_2 = $_POST['State_2'];
        }
     
        if(empty($_POST["Cost"])){
            $errors['Cost'] = "*Required";
        }else{
            $Cost = $_POST['Cost'];
        }
        if(array_filter($errors)){
            //echo errors
        }else{
            $State_1 = mysqli_real_escape_string($conn, $State_1);
            $State_2 = mysqli_real_escape_string($conn, $State_2);
            $Cost = mysqli_real_escape_string($conn, $Cost);


            $sql="insert into `pricing` values ('','$State_1','$State_2','$Cost')";
            $result = mysqli_query($conn,$sql);

            if($result)
            {
                echo "Data inserted successfully";
                header("Location:adminboard.php");
              
            }
            else
            {
                $sql = "SELECT * FROM pricing WHERE State_2='$State_2'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 1){
                    $errors['login'] = 'Price list already Taken!';
                }
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
    <div class="container-fluid" style="background-color: rgba(255, 255, 255, 0.7); padding-left: 92px; margin-top: 20px; margin-bottom: 20px;border-radius: 15px; width: 50%;">
            <form method="post">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"><b>ADDING COST LIST</b></h2>
                    <!-- <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" name="close"><span aria-hidden="true">&times;</span></button> -->
                </div>
                <div class="mb-3">
                    <label style="font-size: 20px;"><i class="fa fa-location-dot"></i> State 1 : </label><br />
                    <input type="text" style="border-radius: 8px;" name="State_1" value="Tamil Nadu" readonly/>
                    <label class="text-danger"><?php echo $errors['State_1'];?></label>
                    <label class="text-danger"><?php echo $errors['login'];?></label>
                </div>
                <div class="mb-3">
                    <label style="font-size: 20px;"><i class="fa fa-location-dot"></i> State 2 : </label><br />
                    <input type="text" style="border-radius: 8px;" name="State_2" />
                    <label class="text-danger"><?php echo $errors['State_2'];?></label>
                </div>
                <div class="mb-3">
                    <label style="font-size: 20px;"><i class="fa fa-coins "></i> Cost : </label><br />
                    <input type="text" style="border-radius: 8px;" name="Cost" />
                    <label class="text-danger"><?php echo $errors['Cost'];?></label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark" name="add">Submit</button>
                    <a href="adminboard.php" class="btn btn-light">Close</a>
                </div>
            </form>


        </div>

</body>
</html>