<?php 
    include("db_connect.php");
    
    $id = $pwd = '';
    $errors = array('id' => '', 'pwd' => '', 'login' => '');

    if(isset($_POST['submit'])){
        if(empty($_POST['id'])){
            $errors['id'] = "*Required";
        }else{
            $id = $_POST['id'];
        }
        if(empty($_POST["pwd"])){
            $errors['pwd'] = "*Required";
        }else{
            $pwd = $_POST['pwd'];
        }
        if(array_filter($errors)){
            //echo errors
        }else{
            $id = mysqli_real_escape_string($conn, $id);
            $pwd = mysqli_real_escape_string($conn, $pwd);

            $sql = "SELECT * FROM staff WHERE StaffID='$id' AND pwd=md5('$pwd')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['id'] = $user['StaffID'];
                header("Location: staff.php");
            }else{
                $sql = "SELECT * FROM staff WHERE StaffID='$id'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 0){
                    $errors['login'] = 'Enter valid Staff ID';
                }else{
                    $user = mysqli_fetch_assoc($result);
                    if($pwd != $user['pwd']){
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
                        <a class="nav-item nav-link text-dark mr-5 " href="index.php" >Home</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#about">About</a>
                        <a class="nav-item nav-link text-dark mr-5" href="tracking.php">Tracking</a>
                        <a class="nav-item nav-link text-dark mr-5" href="branches.php">Branches</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#contact">Contact Us</a>
                        <a class="nav-item nav-link text-dark mr-5" href="userlogin.php">User Login</a> 
                        <a class="nav-item nav-link text-dark mr-5 active" href="#">Staff Login</a>
                        <a href="adminlogin.php" class="nav-item nav-link "><i class="fa fa-lock"></i> Admin</a>    
                    </div>
                </div>
            </div>
        </nav>
        <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 35%;">
        
            <img src="Images/userlogo.png" style="margin:0 auto; height: 140px; width: 140px; margin-bottom: 15px;">
            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label style="font-size: 20px;">Staff ID : </label>
                    <input type="text" style="border-radius: 8px;" name="id" value="<?php echo htmlspecialchars($id)?>" >
                    <label class="text-danger"><?php echo $errors['id'];?></label>
                </div>
                <div class="form-group">
                    <label style="font-size: 20px;">Password : </label>
                    <input type="password" style="border-radius: 8px;" name="pwd" value="<?php echo htmlspecialchars($pwd)?>" >
                    <label class="text-danger"><?php echo $errors['pwd'];?></label>
                </div>
                <label class="text-danger"><?php echo $errors['login'];?></label>
                <input type="submit" name="submit" class="btn btn-dark text-center" value="Sign In" style="font-size: 20px;">
            </form>
        </div>
<?php include_once 'bottom.php' ?>