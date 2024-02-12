<?php
    include("db_connect.php");
    session_start();
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM staff WHERE StaffID='$id'";
    $result = mysqli_query($conn, $sql);
    $staff = mysqli_fetch_assoc($result);
?>
<?php include_once 'top.php' ?>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important; margin-top: 10px !important;"  ></div>
        <nav class="navbar navbar-toggleable-md navbar-expand-lg navbar-default navbar-light mb-10" style="background-color: rgba(255, 255, 255, 0.8);">
            <div class="container">
                <button class="navbar-toggler text-dark" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav  " style="margin: 0 auto; font-size: large;">
                        <a class="nav-item nav-link text-dark mr-5  " href="staff.php">Back</a>
                        <a class="nav-item nav-link text-dark" href="logout.php" >Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="background"></div>    
        <div class="container text-center" style="width : 50%; background-color: rgba(255, 255, 255, 0.7); margin-top: 10px; border-radius:15px; padding: 5px;">
            <h3 >Account Details</h3>
            <img src="Images/userlogo.png" style="margin:0 auto; height: 140px; width: 140px; margin-bottom: 15px;">
            <table class="text-left table table-bordered table-striped" >
                <tr><td style="font-weight:bold;">Name</td><td><?php echo $staff['Name']; ?></td></tr>
                <tr><td style="font-weight:bold;">Staff ID</td><td><?php echo $staff['StaffID']; ?></td></tr>
                <tr><td style="font-weight:bold;">Designation</td><td><?php echo $staff['Designation']; ?></td></tr>
                <tr><td style="font-weight:bold;">Gender</td><td><?php echo $staff['Gender']; ?></td></tr>
                <tr><td style="font-weight:bold;">DOB</td><td><?php echo $staff['DOB']; ?></td></tr>
                <tr><td style="font-weight:bold;">DOJ</td><td><?php echo $staff['DOJ']; ?></td></tr>
                <tr><td style="font-weight:bold;">Email</td><td><?php echo $staff['Email']; ?></td></tr>
                <tr><td style="font-weight:bold;">Mobile</td><td><?php echo $staff['Mobile']; ?></td></tr>
                <tr><td style="font-weight:bold;">Credits</td><td><?php echo $staff['Credits']; ?></td></tr>
            </table>
        </div>
<?php include_once 'bottom.php' ?>