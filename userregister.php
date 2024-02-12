<?php
    include("db_connect.php");

    if (isset($_POST['btnRegister'])) {
        $firstname = $_POST['txtFirstName'];
        $lastname = $_POST['txtLastName'];
        $gender = $_POST['rdoGender'];
        $mobile = $_POST['txtMobile'];
        $address = $_POST['txtAddress'];
        $emailid = $_POST['txtEmailID'];
        $loginid = $_POST['txtLoginID'];
        $password = $_POST['txtPassword'];
        $confirmpassword = $_POST['txtConfirmPassword'];
        if(empty($_POST['email'])){
            $error['email'] = "*Required";
        }else{
            if(email_validation($_POST['email'])){
                $email =  mysqli_real_escape_string($conn, $_POST['email']);
            }else{
                $error['email'] = "*Invalid email";
            }
        }
        if ($password == $confirmpassword) {
            $query = "select * from customers where loginid='$loginid'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                $query = "insert into customers (firstname, lastname, gender, mobile, address, emailid, loginid, password) values('$firstname', '$lastname', '$gender', '$mobile', '$address', '$emailid', '$loginid', md5('$password'))";
                mysqli_query($conn, $query);

                if (mysqli_affected_rows($conn) == 1) {
                    echo '<script type="text/javascript">';
                    echo "setTimeout(function () { swal('Userid registered successfully!!!', 'Start from the login!!', 'success');";
                    echo '}, 1000);</script>';
                }
            }
            else {
                echo '<script type="text/javascript">';
                echo "setTimeout(function () { swal('User id already exist', 'Go to the Login page!!', 'warning');";
                echo '}, 1000);</script>';
            }
        }
        else {
            echo '<script type="text/javascript">';
            echo "setTimeout(function () { swal('oops...!', 'Password and confirm password does not match!', 'error');";
            echo '}, 1000);</script>';
        }
    }
    function email_validation($str) {
        return (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) ? FALSE : TRUE;
    }
?>
<?php include('top.php') ?>
<body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important;  margin-top: 10px !important;"  ></div>
        <div class="background"></div> 
        <nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-default navbar-light mb-10" style="background-color: rgba(255, 255, 255, 0.7); margin-bottom: 20px; margin-top:10px !important;">
            <div class="container">
                <button class="navbar-toggler text-dark" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav  " style="margin: 0 auto; font-size: large;">
                        <a class="nav-item nav-link text-dark mr-5 active" href="index.php" >Home</a>
                        <a class="nav-item nav-link text-dark mr-5" href="#about">About</a>
                        <a class="nav-item nav-link text-dark mr-5" href="tracking.php">Tracking</a>
                        <a class="nav-item nav-link text-dark mr-5" href="branches.php">Branches</a>
                        <a class="nav-item nav-link text-dark mr-5" href="#contact">Contact Us</a>
                        <a class="nav-item nav-link text-dark mr-5" href="userlogin.php">User Login</a> 
                        <a class="nav-item nav-link text-dark" href="login.php">Staff Login</a>                        
                    </div>
                </div>
            </div>
        </nav>
    <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 35%;">
    <img src="Images/userlogo.png" style="margin:0 auto; height: 150px; width: 150px; margin-bottom: 10px;">
        <form class="form" method="POST">
            <h1>User Registration</h1>
        <table>
            <tr>
                <td style="font-size: 20px;">First Name</td>
                <td>
                    <input type="text" style="border-radius: 8px;" name="txtFirstName" Required/>
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Last Name</td>
                <td>
                    <input type="text" style="border-radius: 8px;" name="txtLastName" />
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Gender</td>
                <td>
                    <input type="radio" name="rdoGender" value="Male" /> Male
                    <input type="radio" name="rdoGender" value="Female" /> Female
                    <input type="radio" name="rdoGender" value="Transgender" /> Transgender
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Mobile Number</td>
                <td>
                <input type="text" style="border-radius: 8px;" name="txtMobile" Required/>
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Address</td>
                <td>
                <input type="text-area" style="border-radius: 8px;" name="txtAddress" Required/>
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Email ID</td>
                <td>
                <input type="email" style="border-radius: 8px;" name="txtEmailID" Required/>
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Login ID</td>
                <td>
                <input type="text" style="border-radius: 8px;" name="txtLoginID" Required/>
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Password</td>
                <td>
                <input type="password" style="border-radius: 8px;" name="txtPassword" Required/>
                </td>
            </tr>
            <tr>
                <td style="font-size: 20px;">Confirm Password</td>
                <td>
                <input type="password" style="border-radius: 8px;" name="txtConfirmPassword" Required/>
                </td>
            </tr>
            <tr >
                <td style="font-size: 20px; padding-top: 10px;">
                    <a href="userlogin.php" class="btn btn-secondary" style="border-radius: 8px;">Go Back</a>
                </td>
                <td style="font-size: 20px;  padding-top: 10px;">
                    <button type="submit" class="btn btn-primary" name="btnRegister" style="border-radius: 8px;">Register</button>
                </td>
            </tr>
        </table>
    </form>
</div>
    <?php
        if (isset($info)) {
            echo $info;
        }
    ?>
<?php include ('bottom.php') ?>


          