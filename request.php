<?php
include "./config.php";
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    if(!isset($_SESSION['user_id'])){
        $_SESSION['status'] = "Please signin to send request";
        $_SESSION['code'] = "success";
        echo "not";
    }else{
        
    $pid = $_POST["pid"];
    $height = $_POST["height"];
    $width = $_POST["width"];
    $shoulder = $_POST["shoulder"];
    $hand = $_POST["hand"];
    $date=time();

    $carts = "SELECT * FROM cart WHERE prod_id = '$pid' AND status='0'";
    $results = $conn->query($carts);
    if ($results->num_rows > 0) {
        $_SESSION['status'] = "Item already added to cart";
        $_SESSION['code'] = "error";
        echo "avail";
    }else{

    $prod = "SELECT * FROM products WHERE id='$pid'";
    $result = $conn->query($prod);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $price = $row["price"];
        }
    }

    $insert=mysqli_query($conn, "INSERT INTO request (prod_id,user_id,height,width,shoulder,hand,st,dates)
    VALUES('$pid','".$_SESSION['user_id']."','$height','$width','$shoulder','$hand','0','$date')");
    
    $insert2=mysqli_query($conn, "INSERT INTO cart (user_id,prod_id,p_price,qty,height,width,shoulder,hand,status,address,date)VALUES
    ('".$_SESSION['user_id']."','$pid','$price','','','','','','0','','$date')");

    // $insert2=mysqli_query($conn, "INSERT INTO cart (user_id,prod_id,p_price,qty,status,date)
    // VALUES ('".$_SESSION['user_id']."','$pid','$price','','0','$date')");

    if($insert == true && $insert2 == true){
        $_SESSION['status'] = "You request has been successfully sent";
        $_SESSION['code'] = "success";
        echo "yes";
    }else{
        $_SESSION['status'] = "Unable to send request pls try again";
        $_SESSION['code'] = "error";
        echo "error";
    }
}
    }
}
?>