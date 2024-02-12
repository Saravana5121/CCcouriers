<?php 
    include("db_connect.php");
    $name = '';
    date_default_timezone_set('Asia/Kolkata');
    session_start();
    $id = $_SESSION['loginid'];
    $sql = "SELECT * FROM customers WHERE loginid='$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $name = $user['firstname'];
    $sname = $sadd = $scity = $sstate = $scontact = $rname = $radd = $rcity = $rstate =  $rcontact = $wgt = '';
    $errors = array('req' => '');
    if(isset($_POST['submit'])){
        if(empty($_POST['sname'])){
            $errors['req'] = '*Required Field';
        }else{
            $sname = $_POST['sname'];
        }
        if(empty($_POST['sadd'])){
            $errors['req'] = '*Required Field';
        }else{
            $sadd = $_POST['sadd'];
        }
        if(empty($_POST['scity'])){
            $errors['req'] = '*Required Field';
        }else{
            $scity = $_POST['scity'];
        }
        if(empty($_POST['sstate'])){
            $errors['req'] = '*Required Field';
        }else{
            $sstate = $_POST['sstate'];
        }
        if(empty($_POST['scontact'])){
            $errors['req'] = '*Required Field';
        }else{
            $scontact = $_POST['scontact'];
        }
        if(empty($_POST['rname'])){
            $errors['req'] = '*Required Field';
        }else{
            $rname = $_POST['rname'];
        }
        if(empty($_POST['radd'])){
            $errors['req'] = '*Required Field';
        }else{
            $radd = $_POST['radd'];
        }        
        if(empty($_POST['rcity'])){
            $errors['req'] = '*Required Field';
        }else{
            $rcity = $_POST['rcity'];
        }
        if(empty($_POST['rstate'])){
            $errors['req'] = '*Required Field';
        }else{
            $rstate = $_POST['rstate'];
        }
        if(empty($_POST['rcontact'])){
            $errors['req'] = '*Required Field';
        }else{
            $rcontact = $_POST['rcontact'];
        }
        if(empty($_POST['wgt'])){
            $errors['req'] = '*Required Field';
        }else{
            $wgt = $_POST['wgt'];
        }
        if(array_filter($errors)){
            //echo errors
        }else{
            $price = 0;
            $sql  = "SELECT * FROM pricing WHERE (State_1 = '$sstate' AND State_2 = '$rstate') OR (State_1 = '$rstate' AND State_2 = '$sstate')";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $pricing = mysqli_fetch_assoc($result);
                $price = $pricing['Cost'] * $wgt;
                
                $sql = "INSERT INTO parcel (loginid, S_Name, S_Add, S_City, S_State, S_Contact, R_Name, R_Add, R_City, R_State, R_Contact, Weight_Kg, Price) VALUES ('$id', '$sname', '$sadd', '$scity', '$sstate', $scontact, '$rname', '$radd', '$rcity', '$rstate', $rcontact, $wgt, $price) ";
                if(mysqli_query($conn, $sql)){
                    $tid = mysqli_insert_id($conn);
                    $_SESSION['tid'] = $tid;
                    header("Location: userreceipt.php");                    
                }else{
                    echo "Error : " . mysqli_error($conn);
                }
            }else{
                echo '<script type="text/javascript">';
                echo "setTimeout(function () { swal('Service Not Available', 'CC Couriers will reach your place soon !!', 'info');";
                echo '}, 1000);</script>';
            }
        }
    }
    $sql = "SELECT * FROM pricing";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include_once 'top.php' ?>
    <body style="font-family: Tahoma, sans-serif">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10"><img src="Images/logo.png" id="logo" style="height: 100px !important; margin-top: 10px !important; margin-left:10px !important; " ></div>
                <div class="col-2 dropdown">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" >
                        <img src="Images/userlogo.png" id="logo" style="height: 85px !important;" >
                        <span><b><?php echo $name ?></b></span>
                    </button>
                    <ul class="dropdown-menu text-center" id="dd-menu">
                        <li><div><a href="useraccount.php" style="color: black; text-decoration: none;">Account</a></div></li>
                        <li><div><a href="userlogout.php" style="color: black; text-decoration: none;">Logout</a></div></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="background"></div>
        <style>
            .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
                background-color: rgba(255, 255, 255, 0.7);
            }
        </style>
        <div class="container mt-10">
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="ins-tab" data-toggle="tab" href="#ins" role="tab" aria-controls="ins" aria-selected="true" style="color: black;">New Order</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="cost-tab" data-toggle="tab" href="#cost" role="tab" aria-controls="cost" aria-selected="false" style="color: black;">Price List</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false" style="color: black;">Your Orders</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-3" id="ins" role="tabpanel" aria-labelledby="ins-tab">
                <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 5px; border-radius: 15px; width: 105%;">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form" method="POST">
                            <div class="row text-center">
                            <div class="col-md-6 p-3">
                                <h3 class="mb-3 p-3">Sender's Details</h3>
                                <div class="form-group text-left pl-5">
                                    <label>Name    : </label>
                                    <input type="text" name="sname" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>Address : </label>
                                    <input type="text" name="sadd" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>City    : </label>
                                    <input type="text" name="scity" style="border-radius: 8px;"> 
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>State : </label>
                                        <select id="browsers" name="sstate" style="border-radius: 8px;">
                                            <option>Tamil Nadu</option>
                                            <option>Kerala</option>
                                            <option>Andhra Pradhesh</option>
                                            <option>Karnataka</option>
                                            <option>Maharashtra</option>
                                            <option>Delhi</option>
                                            <option>Uttar Pradesh</option>
                                            <option>West Bengal</option>
                                            <option>Assam</option>
                                            <option>Rajasthan</option>
                                        </select>
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>Contact : </label>
                                    <input type="text" name="scontact" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <h3 class="mb-3 p-3">Receiver's Details</h3>
                                <div class="form-group text-left pl-5">
                                    <label>Name : </label>
                                    <input type="text" name="rname" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>Address : </label>
                                    <input type="text" name="radd" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>City : </label>
                                    <input type="text" name="rcity" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>State : </label>
                                        <select id="browsers" name="rstate" style="border-radius: 8px;">
                                            <option>Tamil Nadu</option>
                                            <option>Kerala</option>
                                            <option>Andhra Pradhesh</option>
                                            <option>Karnataka</option>
                                            <option>Maharashtra</option>
                                            <option>Delhi</option>
                                            <option>Uttar Pradesh</option>
                                            <option>West Bengal</option>
                                            <option>Assam</option>
                                            <option>Rajasthan</option>
                                        </select>
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>Contact : </label>
                                    <input type="text" name="rcontact" style="border-radius: 8px;" >
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <div class="form-group text-left pl-5">
                                    <label>Weight : </label>
                                    <input type="text" name="wgt" placeholder="(Kilograms)" style="border-radius: 8px;">
                                    <label class="text-danger"><?php echo $errors['req'];?></label>
                                </div>
                                <input type="submit" name="submit" value="Place order" class="btn btn-info" style="font-size: 15px;">
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade pt-3" id="cost" role="tabpanel" aria-labelledby="cost-tab">
                    <div class="tab-content b-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="arr" role="tabpanel" aria-labelledby="arr-tab">
                        <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 5px; border-radius: 15px; width: 105%;">
                        <h1>Courier Cost details</h1>
                        <hr>
                        <table class="table table-hover table-bordered table-striped table-hover" style="padding-top: 10px;">
                        <thead class="table-dark">
                                    <tr>
                                        <td>State 1</td>
                                        <td>State 2</td>
                                        <td>Cost</td>
                                    </tr>                    
                                </thead>
                                <tbody>
                                    <?php foreach($arr as $order): ?>
                                    <tr>
                                        <td><?php echo $order['State_1'];?></td>
                                        <td><?php echo $order['State_2'];?></td>
                                        <td><?php echo $order['Cost'];?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                                    </div>
                        </div>
                        
                    </div> 
                </div>
            </div> 
        </div>

<?php include_once 'bottom.php' ?>