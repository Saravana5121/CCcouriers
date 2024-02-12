<?php
    include("db_connect.php");
    $tid = '';
    $error = '';
    $status = array('Dispatched' => '','Shipped' => '', 'Out_for_delivery' => '', 'Delivered' => '', );
    $hide = 'hidden';
    session_start();
    $trackid = '';
    if(isset($_POST['track'])){
        if(empty($_POST['tid'])){
            $error = "*Required";
        }else{
            $tid = $_POST['tid'];
            $_SESSION['track_tid'] = $tid;
            if(empty($error)){
                $hide = '';
                $trackid = $_SESSION['track_tid'];
                $sql = "SELECT * FROM status WHERE TrackingID='$tid'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $status = mysqli_fetch_assoc($result);
                    $active = array();
                    if(! is_null($status['Delivered'])){
                        $active['Delivered'] = $active['Out_for_delivery'] = $active['Shipped'] = 'active';
                    }elseif(! is_null($status['Out_for_delivery'])){
                        $active['Delivered'] = '';
                        $active['Out_for_delivery'] = $active['Shipped'] = 'active';
                    }elseif(! is_null($status['Shipped'])){
                        $active['Delivered'] = $active['Out_for_delivery'] = '';
                        $active['Shipped'] = 'active';
                    }
                }else{
                    $error = "Invalid Tracking ID";
                }
            }
        }
    }
    $hidden = 'hidden';
    if(isset($_POST['view'])){
        $trackid = $_SESSION['track_tid'];
        $hidden = $hide = '';
    } 
    $name = $add = $contact = '';
    $errors = array('name' => '', 'add' => '', 'cont' => '');
    if(isset($_POST['update'])){
        $hidden = $hide = '';
        $trackid = $_SESSION['track_tid'];
        if(empty($_POST['fname'])){
            $errors['name'] = "*Required";
        }else{
            $name = $_POST['fname'];
        }
        if(empty($_POST['fadd'])){
            $errors['add'] = "*Required";
        }else{
            $add = $_POST['fadd'];
        }
        if(empty($_POST['fcontact'])){
            $errors['cont'] = "*Required";
        }else{
            $contact = $_POST['fcontact'];
        }
        if(! array_filter($errors)){
            $trackid = $_SESSION['track_tid'];
            $sql = "UPDATE parcel SET R_Name = '$name', R_Add = '$add', R_Contact = $contact WHERE TrackingID = $trackid";
            if(mysqli_query($conn, $sql)){
                echo '<script type="text/javascript">';
                echo "setTimeout(function () { swal('Address Updated', 'Receiver address updated successfully !!', 'success');";
                echo '}, 1000);</script>';
                $hide  = $hidden =  'hidden';
                $trackid = '';
            }else{
                echo 'Update Error : '.mysqli_error($conn);
            }
        }
    }
?>
<?php include_once 'top.php' ?>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important;  margin-top: 10px !important; " ></div>
        <div class="background"></div> 
        <nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-default navbar-light mb-10" style="background-color: rgba(255, 255, 255, 0.7); margin-top:10px !important;">
            <div class="container">
                <button class="navbar-toggler text-dark" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav  " style="margin: 0 auto; font-size: large;">
                        <a class="nav-item nav-link text-dark mr-5 " href="index.php" >Home</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#about">About</a>
                        <a class="nav-item nav-link text-dark mr-5 active" href="tracking.php">Tracking</a>
                        <a class="nav-item nav-link text-dark mr-5 " href="branches.php">Branches</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#contact">Contact Us</a>
                        <a class="nav-item nav-link text-dark mr-5" href="userlogin.php">User Login</a> 
                        <a class="nav-item nav-link text-dark mr-5" href="login.php">Staff Login</a>
                        <a href="adminlogin.php" class="nav-item nav-link "><i class="fa fa-lock"></i> Admin</a>    
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-10">
            <div class="row">
                <div class="col-md-4 p-4 text-center pt-0" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px;">
                    <img src="Images/track3.png" style="margin:0 auto; height: 250px;">
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label style="font-size: 20px;">Tracking ID : </label>
                            <input type="text" style="border-radius: 8px;" name="tid" value="<?php echo $tid; ?>">
                            <label class="text-danger"><?php echo $error; ?></label>
                        </div>
                        <input type="submit" name="track" class="btn btn-light text-center" value="Track" style="font-size: 20px;">
                    </form>
                </div>
                <div class="col-md-8 p-4 " style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px;">
                    <h3 class="display-6 text-center pb-2 mb-3" style="border-bottom: 2px solid black;">Delivery Status</h3>
                    <label>Tracking ID : <?php echo $trackid; ?></label><br>
                    <div class="track bg-info">
                        <div class="step active"> <span class="icon"> <i class="fa fa-map-marker"></i> </span> <span class="text font-weight-bold"> Received </span><span><?php echo $status['Dispatched'];?></span> </div>
                        <div class="step <?php echo $active['Shipped']; ?>"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text font-weight-bold"> On the way </span><span><?php echo $status['Shipped'];?></span> </div>
                        <div class="step <?php echo $active['Out_for_delivery']; ?>"> <span class="icon"> <i class="fa fa-cubes"></i> </span> <span class="text font-weight-bold"> Out for delivery </span><span><?php echo $status['Out_for_delivery'];?></span> </div>
                        <div class="step <?php echo $active['Delivered']; ?>"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text font-weight-bold">Delivered</span><span><?php echo $status['Delivered'];?></span> </div>
                    </div>
                    <div <?php echo $hide; ?>>
                        <br>
                        <label>Unable to receive on the expected date?</label>
                        <form action="tracking.php" method="POST">
                            <label>Drop to a friend nearby in the your city.</label>
                            <input type="submit" name="view" value="Update Delivery Address" class="btn btn-info">
                        </form>
                        <form action="tracking.php" method="POST" <?php echo $hidden; ?>>
                            <label>Friend's Details</label>
                            <div class="form-group text-left">
                                <label>Name : </label>
                                <input type="text" name="fname" style="border-radius: 8px;">
                                <label class="text-danger"><?php echo $errors['name'];?></label>
                            </div>
                            <div class="form-group text-left">
                                <label>Address : </label>
                                <input type="text" name="fadd" style="border-radius: 8px;">
                                <label class="text-danger"><?php echo $errors['add'];?></label>
                            </div>
                            <div class="form-group text-left">
                                <label>Contact : </label>
                                <input type="text" name="fcontact" style="border-radius: 8px;" >
                                <label class="text-danger"><?php echo $errors['cont'];?></label>
                            </div>
                            <input type="submit" name="update" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php include_once 'bottom.php' ?>