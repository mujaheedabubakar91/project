<?php
session_start();
include "./config.php";
// if(!isset($_SESSION['admin_id'])){
//     header("location:login.php");
// }
$details = "SELECT * FROM users WHERE phone='".$_SESSION['user_id']."'";
$result = $conn->query($details);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $phone = $row["phone"];
        $email = $row["email"];
        // $img = $row["pic"];
    }
}
if(isset($_POST['place'])){

    $state = $_POST['state'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $u_id = $_SESSION['user_id'];
    $amt = $_SESSION['total_amt'];
    $prod_id = $_SESSION['prod_id'];
    $qty = $_SESSION['qty'];
    $price = $_SESSION['price'];

    function generateOrderID($length = 8) {
        // Characters to use in the order ID
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        $orderID = '';
    
        // Generate a random order ID based on the specified length
        for ($i = 0; $i < $length; $i++) {
            // Pick a random character from the available characters
            $randomIndex = rand(0, strlen($characters) - 1);
            $orderID .= $characters[$randomIndex];
        }
    
        return $orderID;
    }
    
    // Example usage
    $orderID = generateOrderID(10); // Change the length as needed
    // echo "Generated Order ID: $orderID";


    $insert = mysqli_query($conn, "INSERT INTO orders (user_id,product_id,product_price,ordered_address,ordered_state,ordered_email,delivery_mode,order_id,order_status,product_qty,total_amount,dates)
    VALUES('$u_id','$prod_id','$price','$address','$state','$email','pickup','$orderID','pending','$qty','$amt','".time()."')");

    mysqli_query($conn, "UPDATE request SET st = '1' WHERE user_id = '$u_id'");
     if($insert == true){

        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '".$_SESSION['user_id']."'");
        header("location:confirm.php");
     }else{
        echo "error placing order";
     }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css"/>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/sweetalert.min.js"></script>

</head>
<body>
    <header>
        <nav class="bg-white dark:bg-gray-900 fixed w-full z-50 top-0 left-0 border-gray-200 dark:border-gray-600">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="./" class="flex items-center">
                    <img src="./images/logo.jpg" class="h-8 mr-3" alt="Flowbite Logo">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
                </a>
                <div class="flex md:order-2">
                    <div class="flex gap-2">
                        <?php
                        if(!isset($_SESSION['user_id'])){
                            // header("location:login.php");
                        ?>
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Signin</button>
                        <?php
                        }else{
                        ?>
                        <!-- <i class="mr-2 cursor-pointer text-xl fa-solid fa-cart-shopping"></i> -->
                        
                            <a href="cart.php" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <i class="mr-2 cursor-pointer text-xl fa-solid fa-cart-shopping"></i> Cart
                                <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                2
                                </span>
                            </a>

                        <?php
                        }
                        ?>
                    </div>
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="./products.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Products</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="grid md:grid-cols-12 gap-6 mx-10 md:mx-44"> 
        <div action="" class=" mt-20 col-span-8 max-w-2xl bg-white shadow-md p-5">
            <h2 class="text-2xl font-semibold my-5">Checkout</h2>
            <div class="mb-6">
                <input value="<?php echo $name ?>" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"placeholder="Fullname" required>
            </div>
            <div class="mb-6">
                <input value="<?php echo $phone ?>" type="text" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"placeholder="Phone" required>
            </div>
            <div class="mb-6">
                <input value="<?php echo $email ?>" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
            </div>
        </div>
        <form action="checkout.php" method="post" class="mt-20 w-full bg-white col-span-4 shadow-md p-5 max-h-fit rounded-md">
            <h2 class="text-lg font-semibold my-5">ORDER SUMMARY</h2>
            <div class="flex flex-col justify-between border-gray-300 my-5 items-center">
                
                <div class="hidden mb-6">
                    <input value="<?php echo $email ?>" type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
                </div>
                <div class="mb-6">
                    <input type="text" name="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Town/City" required>
                </div>
                <div class="mb-6">
                    <input type="text" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"placeholder="Street Address" required>
                </div>
                <div>
                    <p class="font-medium font-serif uppercase">total</p>
                </div>
                <div>
                    <p class="font-medium font-sans">NGN <?php echo $_SESSION['total_amt']; ?></p>
                </div>
            </div>
            <button type="submit" name="place" class="text-white w-full bg-blue-700 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 uppercase">
                Place order
            </button>
        </form>
    </div>
  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

</html>