<?php
    include("db_connect.php");
    $sql = "SELECT * FROM branches";
    $result = mysqli_query($conn, $sql);
    $branches = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include_once 'top.php' ?>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important;  margin-top: 10px !important; "  ></div>
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
                        <a class="nav-item nav-link text-dark mr-5" href="tracking.php">Tracking</a>
                        <a class="nav-item nav-link text-dark mr-5 active" href="#">Branches</a>
                        <a class="nav-item nav-link text-dark mr-5" href="index.php#contact">Contact Us</a>
                        <a class="nav-item nav-link text-dark mr-5" href="userlogin.php">User Login</a>
                        <a class="nav-item nav-link text-dark mr-5" href="login.php">Staff Login</a>
                        <a href="adminlogin.php" class="nav-item nav-link "><i class="fa fa-lock"></i> Admin</a>    
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
            <?php foreach($branches as $branch) : ?>
                
                <div class="p-3 col-12" style="background-color: rgba(255, 255, 255, 0.7); margin-top:5px !important;">
                    <ul style="list-style-type:none;">
                        <li><a href="#" class="fa fa-map-marker m-1" style="pointer-events: none;"></a><?php echo '  '.$branch['Address']; ?></li>
                        <li><a href="#" class="fa fa-phone m-1" style="pointer-events: none;"></a><?php echo '  '.$branch['Contact']; ?></li>
                        <li><a href="#" class="fa fa-envelope m-1" style="pointer-events: none;"></a><?php echo '  '.$branch['Email']; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
<?php include_once 'bottom.php' ?>