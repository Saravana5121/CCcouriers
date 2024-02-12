<!-- login code -->
<?php 
    include("db_connect.php");
    $loginid = $password = '';
    $errors = array('loginid' => '', 'password' => '', 'login' => '');

    if(isset($_POST['submit'])){
        if(empty($_POST['loginid'])){
            $errors['loginid'] = "*Required";
        }else{
            $loginid = $_POST['loginid'];
        }
        if(empty($_POST["password"])){
            $errors['password'] = "*Required";
        }else{
            $password = $_POST['password'];
        }
        if(array_filter($errors)){
            //echo errors
        }else{
            $loginid = mysqli_real_escape_string($conn, $loginid);
            $password = mysqli_real_escape_string($conn, $password);

            $sql = "SELECT * FROM customers WHERE loginid='$loginid' AND password=md5('$password')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['loginid'] = $user['loginid'];
                header("Location: userorder.php");
            }else{
                $sql = "SELECT * FROM customers WHERE loginid='$loginid'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 0){
                    $errors['login'] = 'Enter valid User ID';
                }else{
                    $user = mysqli_fetch_assoc($result);
                    if($password != $user['password']){
                        $errors['login'] = 'Incorrect Password';
                    }
                }
            }
        }
        
    }
    mysqli_close($conn);

?>
<?php include_once 'top.php' ?>
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
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important;  margin-top: 10px !important;" ></div>
        <div class="background"></div> 
        <nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-default navbar-light mb-10" style="background-color: rgba(255, 255, 255, 0.7);  margin-top:10px !important;">
            <div class="container">
                <button class="navbar-toggler text-dark" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav  " style="margin: 0 auto; font-size: large;">
                        <a class="nav-item nav-link text-dark mr-5" href="index.php" >Home</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#about">About</a>
                        <a class="nav-item nav-link text-dark mr-5" href="tracking.php">Tracking</a>
                        <a class="nav-item nav-link text-dark mr-5" href="branches.php">Branches</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#contact">Contact Us</a>
                        <a class="nav-item nav-link text-dark mr-5 active" href="userlogin.php">User Login</a> 
                        <a class="nav-item nav-link text-dark mr-5" href="login.php">Staff Login</a>
                        <a href="adminlogin.php" class="nav-item nav-link "><i class="fa fa-lock"></i> Admin</a>    
                    </div>
                </div>
            </div>
        </nav>
        <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 35%;">
            <img src="Images/userlogo.png" style="margin:0 auto; height: 140px; width: 140px; margin-bottom: 15px;">
            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label style="font-size: 20px;">User name : </label>
                    <input type="text" style="border-radius: 8px;" name="loginid" value="<?php echo htmlspecialchars($loginid)?>" >
                    <label class="text-danger"><?php echo $errors['loginid'];?></label>
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;">Password : </label>
                    <input type="password" style="border-radius: 8px;" name="password" value="<?php echo htmlspecialchars($password)?>" >
                    <label class="text-danger"><?php echo $errors['password'];?></label>
                </div>
                <label class="text-danger"><?php echo $errors['login'];?></label>
                <input type="submit" name="submit" class="btn btn-dark text-center" value="Sign In" style="font-size: 20px;">
                <br/></br />
                <label class="text-danger"><?php echo "couldn't find an account?";?></label>
                <br />
                <div id="signup">
                    <a class="btn btn-large btn-info" href="userregister.php">Register</a>
                </div>
            </form>
        </div>
<?php include_once 'bottom.php' ?>
        