<?php 
include "./config.php";
session_start();
if(isset($_SESSION['user_id'])){
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $cart=$_POST['cart_item'];

    $carts = "SELECT * FROM cart WHERE prod_id = '$cart' AND status='0'";
    $results = $conn->query($carts);
    if ($results->num_rows > 0) {
        $_SESSION['status'] = "Item already added to cart";
        $_SESSION['code'] = "error";
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }else{

        $cdetails = "SELECT * FROM products WHERE id = '$cart'";
        $result = $conn->query($cdetails);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prod_id = $row["id"];
                $name = $row["name"];
                $cat = $row["cat"];
                $price = $row["price"];
                $desc = $row["descs"];
                $img = $row["pic"];
            }
        }

        $date = time();
        
                $insert=mysqli_query($conn, "INSERT INTO cart (user_id,prod_id,p_price,qty,height,width,shoulder,hand,status,address,date)VALUES
        ('".$_SESSION['user_id']."','$cart','$price','','','','','','0','','$date')");

        // $insert=mysqli_query($conn, "INSERT INTO cart (user_id,prod_id,p_price,qty,status,date)VALUES
        // ('".$_SESSION['user_id']."','$cart','$price','','0','$date')");

        if($insert == true){
        $_SESSION['status'] = "Added to cart";
        $_SESSION['code'] = "success";
        ?>
        <script>
            window.history.back();
        </script>
        <?php
        }else{
            // echo '
            // <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            //     <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            //         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            //     </svg>
            //     <span class="sr-only">Info</span>
            //     <div>
            //         Sorry, unable to register, pls try again
            //     </div>
            // </div>
            // ';
            $_SESSION['status'] = "Sorry, unable to add to cart, pls try again";
    $_SESSION['code'] = "error";
    ?>
    <script>
            window.history.back();
        </script>
    <?php
        }
    }
}
}else{
    // echo '
    // <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    //     <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    //         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    //     </svg>
    //     <span class="sr-only">Info</span>
    //     <div>
    //         Signin to added product to cart
    //     </div>
    // </div>
    // ';
    $_SESSION['status'] = "Signin to added product to cart";
    $_SESSION['code'] = "error";
    ?>
    <script>
            window.history.back();
        </script>
    <?php
}
?>