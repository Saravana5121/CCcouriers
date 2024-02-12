<?php 
    include("db_connect.php");
    session_start();
    $id = $_SESSION['adminid'];
    $sql = "SELECT * FROM admincreds WHERE adminid='$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $name = $user['adminid'];
    // code for consignments
    $sql = "SELECT * FROM arrived";
    $result = mysqli_query($conn, $sql);
    $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql = "SELECT * FROM delivered";
    $result = mysqli_query($conn, $sql);
    $delivered = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

            .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
                    color: #fff;
                    background-color: #343a40;
                }
            </style>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10"><img src="Images/logo.png" id="logo" style="height: 100px !important; margin-top: 10px !important; margin-left:10px !important; " ></div>
                <div class="col-2 dropdown">
                    <button class="btn dropdown-toggle btn2" type="button" data-toggle="dropdown" >
                        <img src="Images/userlogo.png" id="logo" style="height: 85px !important;" >
                        <br/>
                        <span><b><?php echo $name ?></b></span>
                    </button>
                    <style>
                      .btn2{
                            line-height:2.5;
                        }
                    </style>
                    <ul class="dropdown-menu text-center" id="dd-menu">
                        <li><div><a href="adminlogout.php" style="color: black; text-decoration: none;">Logout</a></div></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="background"></div>
        <div class="container mt-2">
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="ins-tab" data-toggle="tab" href="#ins" role="tab" aria-controls="ins" aria-selected="true" style="color: dark;">Staff Data</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="cus-tab" data-toggle="tab" href="#cus" role="tab" aria-controls="cus" aria-selected="false" style="color: dark;">Customer Data</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="branch-tab" data-toggle="tab" href="#branch" role="tab" aria-controls="branch" aria-selected="false" style="color: dark;">Branch Data</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="cost-tab" data-toggle="tab" href="#cost" role="tab" aria-controls="cost" aria-selected="false" style="color: dark;">Courier Cost</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="cons-tab" data-toggle="tab" href="#cons" role="tab" aria-controls="cons" aria-selected="false" style="color: dark;">Consignments</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-3" id="ins" role="tabpanel" aria-labelledby="ins-tab">
                    <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 105%;">
                        <h1>STAFF DATA <a href="addstaffdetails.php" class="btn btn-dark btn-bg-color margin-left1"><i class="fa fa-plus text-white"></i> Add staff</a>
                        </h1>
                        <style>
                        .margin-left1{
                            margin-left: 734px !important;
                        }
                        </style>
                        <hr>
                        <table class="table table-hover table-bordered table-striped table-hover" style="padding-top: 10px;">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">StaffID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Gender</th>
                                <th scope="col">DOB</th>
                                <th scope="col">DOJ</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Email</th>
                                <th scope="col">Credits</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    include("db_connect.php");
                                    
                                    $sql="select * from `staff`";
                                    $result=mysqli_query($conn,$sql);
                                    if($result){
                                        while($row=mysqli_fetch_assoc($result)){
                                            $StaffID=$row['StaffID'];
                                            $Name=$row['Name'];
                                            $Designation=$row['Designation'];
                                            $Gender=$row['Gender'];
                                            $DOB=$row['DOB'];
                                            $DOJ=$row['DOJ'];
                                            $Salary=$row['Salary'];
                                            $Mobile=$row['Mobile'];
                                            $Email=$row['Email'];
                                            $Credits=$row['Credits'];
                                            echo'  <tr>
                                    <th scope="row">'.$StaffID.'</th>
                                    <td>'.$Name.'</td>
                                    <td>'.$Designation.'</td>
                                    <td>'.$Gender.'</td>
                                    <td>'.$DOB.'</td>
                                    <td>'.$DOJ.'</td>
                                    <td>'.$Salary.'</td>
                                    <td>'.$Mobile.'</td>
                                    <td>'.$Email.'</td>
                                    <td>'.$Credits.'</td>
                                    <td>
                                    
                                    <a href="editstaff.php?updateid='.$StaffID.'" class="me-5 editstaff" title="Edit Staff"><i class="fa fa-edit text-success"></i></a>
                                    </td>
                                    <td>
                                    <a href="admindelstaff.php?deleteid='.$StaffID.'" class="me-5 deletestaff" title="Delete Staff"><i class="fa fa-trash text-danger"></i></a>
                                    </td>
                                    </tr> ';
                                        }
                                        
                                    }
                                    mysqli_close($conn);
                                
                                ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade pt-3" id="cus" role="tabpanel" aria-labelledby="cus-tab">
                    <div class="tab-content b-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="cus" role="tabpanel" aria-labelledby="cus-tab">
                            <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 105%;">
                                <h1>CUSTOMER DATA</h1>
                                <hr>
                                <table class="table table-hover table-bordered table-striped table-hover" style="padding-top: 10px;">
                                    <thead class="table-dark">
                                        <tr>
                                        <th scope="col">Login ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            include("db_connect.php");
                                            
                                            $sql="select * from `customers`";
                                            $result=mysqli_query($conn,$sql);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $loginid=$row['loginid'];
                                                    $firstname=$row['firstname'];
                                                    $lastname=$row['lastname'];
                                                    $gender=$row['gender'];
                                                    $mobile=$row['mobile'];
                                                    $address=$row['address'];
                                                    $emailid=$row['emailid'];                                                    
                                                    echo'  <tr>
                                            <th scope="row">'.$loginid.'</th>
                                            <td>'.$firstname.' '.$lastname.'</td>
                                            <td>'.$gender.'</td>
                                            <td>'.$mobile.'</td>
                                            <td>'.$address.'</td>
                                            <td>'.$emailid.'</td>                                            
                                            <td>
                                            <a href="admindelcus.php?deleteid='.$loginid.'" class="me-5 deletestaff" title="Delete Staff"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                            </tr> ';
                                                }
                                                
                                            }
                                            mysqli_close($conn);
                                        
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
                    </div> 
                </div>
                <div class="tab-pane fade pt-3" id="branch" role="tabpanel" aria-labelledby="branch-tab">
                    <div class="tab-content b-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="branch" role="tabpanel" aria-labelledby="branch-tab">
                            <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 105%;">
                                <h1>BRANCH DATA <a href="addbranch.php" class="btn btn-dark btn-bg-color margin-left2"><i class="fa fa-plus text-white"></i> Add Branch</a></h1>
                                <style>
                                .container {
                                    max-width: 1153px;
                                }
                                .margin-left2{
                                    margin-left: 650px !important;
                                }
                                </style>
                                <hr>
                                <table class="table table-hover table-bordered table-striped table-hover" style="padding-top: 10px;">
                                    <thead class="table-dark">
                                        <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            include("db_connect.php");
                                            
                                            $sql = "SELECT * FROM branches";
                                            $result = mysqli_query($conn, $sql);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $Branch_id=$row['Branch_id'];
                                                    $Address=$row['Address'];
                                                    $Contact=$row['Contact'];
                                                    $Email=$row['Email'];                                                    
                                                    echo'  <tr>
                                            <th scope="row">'.$Branch_id.'</th>
                                            <td>'.$Address.'</td>
                                            <td>'.$Contact.'</td>
                                            <td>'.$Email.'</td>        
                                            <td>
                                            <a href="editbranch.php?updateid='.$Branch_id.'" class="me-5 editstaff" title="Edit branch"><i class="fa fa-edit text-success"></i></a>
                                            </td>                                 
                                            <td>
                                            <a href="admindelbranch.php?deleteid='.$Branch_id.'" class="me-5 deletestaff" title="Delete branch"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                            </tr> ';
                                                }
                                                
                                            }
                                            mysqli_close($conn);
                                        
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
                    </div> 
                </div>  
                <div class="tab-pane fade pt-3" id="cost" role="tabpanel" aria-labelledby="cost-tab">
                    <div class="tab-content b-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="cost" role="tabpanel" aria-labelledby="cost-tab">
                            <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 105%;">
                                <h1>COURIER COST DATA <a href="addcost.php" class="btn btn-dark btn-bg-color margin-left3"><i class="fa fa-plus text-white"></i> Add Cost</a></h1>
                                <style>
                                .container {
                                    max-width: 1153px;
                                }
                                .margin-left3{
                                    margin-left: 570px !important;
                                }
                                </style>
                                <hr>
                                <table class="table table-hover table-bordered table-striped table-hover" style="padding-top: 10px;">
                                    <thead class="table-dark">
                                        <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">State 1</th>
                                        <th scope="col">State 2</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            include("db_connect.php");
                                            
                                            $sql = "SELECT * FROM pricing";
                                            $result = mysqli_query($conn, $sql);
                                            if($result){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $S_No=$row['S_No'];
                                                    $State_1=$row['State_1'];
                                                    $State_2=$row['State_2'];
                                                    $Cost=$row['Cost'];                                                    
                                                    echo'  <tr>
                                            <th scope="row">'.$S_No.'</th>
                                            <td>'.$State_1.'</td>
                                            <td>'.$State_2.'</td>
                                            <td>'.$Cost.'</td>        
                                            <td>
                                            <a href="editcost.php?updateid='.$S_No.'" class="me-5 editstaff" title="Edit branch"><i class="fa fa-edit text-success"></i></a>
                                            </td>                                 
                                            <td>
                                            <a href="admindelcost.php?deleteid='.$S_No.'" class="me-5 deletestaff" title="Delete branch"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                            </tr> ';
                                                }
                                                
                                            }
                                            mysqli_close($conn);
                                        
                                        ?>
                                    
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
                    </div> 
                </div>
                <div class="tab-pane fade" id="cons" role="tabpanel" aria-labelledby="cons-tab">
                    <ul class="nav nav-pills" id="myTab2" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="arr-tab" data-toggle="tab" href="#arr" role="tab" aria-controls="arr" aria-selected="true" style="color: dark;">Arrived</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="del-tab" data-toggle="tab" href="#del" role="tab" aria-controls="del" aria-selected="false" style="color: dark;">Delivered</a>
                        </li>
                      </ul>
                      <div class="tab-content b-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="arr" role="tabpanel" aria-labelledby="arr-tab">
                        <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 100%;">
                            <table class="table table-hover table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr><td>TrackingID</td><td>StaffID</td><td>Sender</td><td>Receiver</td><td>Weight</td><td>Price</td><td>Dispatched</td><td>Shipped</td><td>Out for delivery</td><td>Delivered</td></tr>                    
                                </thead>
                                <tbody>
                                    <?php foreach($arr as $order): ?>
                                    <tr>
                                        <td><?php echo $order['TrackingID'];?></td>
                                        <td><?php echo $order['StaffID'];?></td>
                                        <td><?php echo $order['S_Name'].', '.$order['S_Add'].', '.$order['S_City'].', '.$order['S_State'].' - '.$order['S_Contact'];?></td>
                                        <td><?php echo $order['R_Name'].', '.$order['R_Add'].', '.$order['R_City'].', '.$order['R_State'].' - '.$order['R_Contact'];?></td>
                                        <td><?php echo $order['Weight_Kg'];?></td>
                                        <td><?php echo $order['Price'];?></td>
                                        <td><?php echo $order['Dispatched_Time'];?></td>
                                        <td><?php echo $order['Shipped'];?></td>
                                        <td><?php echo $order['Out_for_delivery'];?></td>
                                        <td><?php echo $order['Delivered'];?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                                    </div>
                        </div>
                        <div class="tab-pane fade" id="del" role="tabpanel" aria-labelledby="del-tab">
                        <div class="container text-center p-3" style="background-color: rgba(255, 255, 255, 0.7); margin-top: 20px; border-radius: 15px; width: 100%;">
                        <table class="table table-hover table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr><td>TrackingID</td><td>StaffID</td><td>Sender</td><td>Receiver</td><td>Weight</td><td>Price</td><td>Dispatched</td><td>Shipped</td><td>Out for delivery</td><td>Delivered</td></tr>                    
                                </thead>
                                <tbody>
                                    <?php foreach($delivered as $order): ?>
                                    <tr>
                                        <td><?php echo $order['TrackingID'];?></td>
                                        <td><?php echo $order['StaffID'];?></td>
                                        <td><?php echo $order['S_Name'].', '.$order['S_Add'].', '.$order['S_City'].', '.$order['S_State'].' - '.$order['S_Contact'];?></td>
                                        <td><?php echo $order['R_Name'].', '.$order['R_Add'].', '.$order['R_City'].', '.$order['R_State'].' - '.$order['R_Contact'];?></td>
                                        <td><?php echo $order['Weight_Kg'];?></td>
                                        <td><?php echo $order['Price'];?></td>
                                        <td><?php echo $order['Dispatched_Time'];?></td>
                                        <td><?php echo $order['Shipped'];?></td>
                                        <td><?php echo $order['Out_for_delivery'];?></td>
                                        <td><?php echo $order['Delivered'];?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                                    </div>
                        </div>
                      </div>
                      
                </div>
            </div>


            <script>
                $(function() { 
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        localStorage.setItem('lastTab', $(this).attr('href'));
                    });
                    var lastTab = localStorage.getItem('lastTab');
                    if (lastTab) {
                        $('[href="' + lastTab + '"]').tab('show');
                    }   
                });
              </script>
        </div>





<?php include_once 'bottom.php' ?>