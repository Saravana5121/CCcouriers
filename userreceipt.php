<?php
    include("db_connect.php");
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-Y');
    $time = date('h:i:s a');

    $sql = "SELECT * FROM parcel ORDER BY TrackingID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $order = mysqli_fetch_assoc($result);
    }else{
        echo 'Data fetch Error : '.mysqli_error($conn);
    }
    if(isset($_POST['back'])){
        header("Location: userorder.php");
    }
?>
<?php include_once 'top.php' ?>
    <body style="font-family: Arial, Helvetica, sans-serif;">
        <div ><img src="Images/logo.png" id="logo" style="height: 100px !important; margin-top: 10px !important;"  ></div>
        <div class="background"></div>  
        <div class="container p-5"  style="background-color: rgba(255, 255, 255, 0.7); margin-top: 10px !important">
            <h2 class="display-4 text-center" style="border-bottom: 2px solid black; margin-bottom:15px !important;">Receipt</h2>
            <p><span class="font-weight-bold">Date-Time : </span><?php echo $date.'  '.$time; ?> </p>
            <p><span class="font-weight-bold">Tracking ID : </span><?php echo $order['TrackingID']; ?> </p>
            <p> <span class="font-weight-bold">User ID : </span> <?php echo $order['loginid']; ?> </p>
            <p><span class="font-weight-bold">Sender : </span> <?php echo $order['S_Name'].', '.$order['S_Add'].', '.$order['S_City'].', '.$order['S_State'].' - '.$order['S_Contact']; ?> </p>
            <p><span class="font-weight-bold">Receiver : </span><?php echo $order['R_Name'].', '.$order['R_Add'].', '.$order['R_City'].', '.$order['R_State'].' - '.$order['R_Contact']; ?></p>
            <p><span class="font-weight-bold">Weight : </span><?php echo $order['Weight_Kg'].' KG'; ?> </p>
            <p><span class="font-weight-bold">Price : </span><?php echo 'Rs '.$order['Price']; ?> </p>
            <form method="POST" action="" class="text-center">        
                <input type="submit" name="back" value="Back" class="btn btn-dark">
                <input type="submit" name="print" value="Print" class="btn btn-info" onclick="window.print()">
            </form>
        </div>
<?php include_once 'bottom.php' ?>