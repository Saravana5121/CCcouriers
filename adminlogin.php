<!-- login code -->
<?php 
    include("db_connect.php");
    $adminid = $pwd = '';
    $errors = array('adminid' => '', 'pwd' => '', 'login' => '');

    if(isset($_POST['submit'])){
        if(empty($_POST['adminid'])){
            $errors['adminid'] = "*Required";
        }else{
            $adminid = $_POST['adminid'];
        }
        if(empty($_POST["pwd"])){
            $errors['pwd'] = "*Required";
        }else{
            $pwd = $_POST['pwd'];
        }
        if(array_filter($errors)){
            //echo errors
        }else{
            $adminid = mysqli_real_escape_string($conn, $adminid);
            $pwd = mysqli_real_escape_string($conn, $pwd);

            $sql = "SELECT * FROM admincreds WHERE adminid='$adminid' AND pwd=md5('$pwd')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['adminid'] = $user['adminid'];
                header("Location: adminboard.php");
            }else{
                $sql = "SELECT * FROM admincreds WHERE adminid='$adminid'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 0){
                    $errors['login'] = 'Enter valid Admin ID';
                }else{
                    $user = mysqli_fetch_assoc($result);
                    if($pwd != $user['pwd']){
                        $errors['login'] = 'Incorrect password';
                    }
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
        <link rel="stylesheet" href="index_styles.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
             body, html{

            margin: 0;
            height: 100%;
            background-image: url('./Images/bbg9.jpg');
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
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important;  margin-top: 10px !important;" ></div>
        <div class="background"></div>
        <nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-default navbar-light mb-10" style="background-color: rgba(255, 255, 255, 0.7); margin-bottom: 20px; margin-top:10px !important;">
            <div class="container">
                <button class="navbar-toggler text-dark" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav  " style="margin: 0 auto; font-size: large;">
                        <a class="nav-item nav-link text-dark mr-5 " href="index.php" >Home</a>
                         <!-- <a class="nav-item nav-link text-dark mr-5" href="#about">About</a> -->
                        <a class="nav-item nav-link text-dark mr-5" href="tracking.php">Tracking</a>
                        <a class="nav-item nav-link text-dark mr-5" href="branches.php">Branches</a>
                        <!-- <a class="nav-item nav-link text-dark mr-5" href="#contact">Contact Us</a> -->
                        <a class="nav-item nav-link text-dark mr-5" href="userlogin.php">User Login</a> 
                        <a class="nav-item nav-link text-dark mr-5" href="login.php">Staff Login</a> 
                        <a href="adminlogin.php" class="nav-item nav-link active"><i class="fa fa-lock"></i> Admin</a> 
                    </div>
                </div>
            </div>
        </nav>
        <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 35%;">
            <img src="Images/userlogo.png" style="margin:0 auto; height: 140px; width: 140px; margin-bottom: 15px;">
            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h2>Admin login</h2>
            <br />
                <div class="form-group">
                    <label style="font-size: 20px;">Admin ID : </label>
                    <input type="text" style="border-radius: 8px;" name="adminid" value="<?php echo htmlspecialchars($adminid)?>" >
                    <label class="text-danger"><?php echo $errors['adminid'];?></label>
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;">Password : </label>
                    <input type="password" style="border-radius: 8px;" name="pwd" value="<?php echo htmlspecialchars($pwd)?>" >
                    <label class="text-danger"><?php echo $errors['pwd'];?></label>
                </div>
                <a href="index.php" class="btn btn-info" style="font-size: 20px;">Back</a>
                <input type="submit" name="submit" class="btn btn-dark text-center" value="Sign In" style="font-size: 20px;"><br /><br />
                <label class="text-danger"><?php echo $errors['login'];?></label>
            </form>
        </div>
<?php include_once 'bottom.php' ?>