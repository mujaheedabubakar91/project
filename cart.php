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
if(isset($_POST['submit'])){
    $amt = $_POST['total_amt'];
    $prod_id = $_POST['prod_id'];
    $qty = $_POST['qty'];
    $pri = $_POST['price'];

    $_SESSION['total_amt'] = $amt;
    $_SESSION['prod_id'] = $prod_id;
    $_SESSION['qty'] = $qty;
    $_SESSION['price'] = $pri;

    header("location:checkout.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css"/>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="">

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
                            <?php
                            $car = "SELECT * FROM cart WHERE user_id ='".$_SESSION['user_id']."'";
                            $re = $conn->query($car);
                            if ($re->num_rows > 0) {
                                echo $re->num_rows;
                            }else{
                            ?>
                            0
                            <?php
                            }
                            ?>
                            </span>
                        </a>
                        <a href="logout.php" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Logout
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

  <div class="bg-white">
    <div class="text-slate-700 relative flex flex-col overflow-hidden px-4 md:flex-row md:items-center">
    </div>
  </div>
   <div class=" relative overflow-hidden rounded-t-lg py-32 text-center ">
    <h1 class="mt-2 text-5xl font-bold text-white uppercase">Shopping Cart</h1>
    <div class="mt-2 text-white text-center space-x-4 items-center">
      <a class="font-bold text-xl" href="./">Home </a> 
      <a class="font-semibold text-xl" href="#">My Cart</a>
  </div>
    <img class="-z-10 absolute top-0 left-0 mt-10 h-2/3 w-full object-cover" src="https://images.unsplash.com/photo-1504672281656-e4981d70414b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" />
  </div>

     
 
    <section class="h-screen md:-mt-32 -mt-20 py-12 sm:py-16 lg:py-20">
        <form action="cart.php" method="post" class="mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex items-center justify-center">
          </div>
      
          <div class="mx-auto max-w-2xl top-20 shadow-md md:mt-12">
            <div class="bg-white shadow">
                <?php
                $carts = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."'";
                $result = $conn->query($carts);
                if ($result->num_rows > 0) {
                ?>
              <div class="px-4 py-6 sm:px-8 sm:py-10">
                <div class="flow-root">
                  <ul class="-my-8">

                    <?php
                        $carts = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."'";
                        $result = $conn->query($carts);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $prod_id = $row["prod_id"];

                        $prods = "SELECT * FROM products WHERE id='$prod_id'";
                        $res = $conn->query($prods);
                        if ($res->num_rows > 0) {
                            while($row2 = $res->fetch_assoc()) {
                                $name = $row2["name"];
                                $price = $row2["price"];
                                $pic = $row2["pic"];
                            }
                        }

                    ?>
                    <li class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                      <div class="shrink-0">
                        <img class="h-24 w-24 max-w-full rounded-lg object-cover" src="./admin/products/<?php echo $pic ?>" alt="">
                      </div>

                      <input hidden type="text" name="prod_id" id="prod" value="<?php echo $prod_id ?>">
                      <input hidden type="text" name="qty" value="1">
                      <input hidden type="text" name="price" value="<?php echo $price ?>">

                      <div class="relative flex flex-1 flex-col justify-between">
                        <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                          <div class="pr-8 sm:pr-5">
                            <p class="text-base font-semibold text-gray-900"><?php echo $name ?></p>
                            <!-- <p class="mx-0 mt-1 mb-0 text-sm text-gray-400">23 </p> -->
                          </div>
      
                          <div class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                            <p class="shrink-0 w-20 text-base font-semibold text-blue-900 sm:order-2 sm:ml-8 sm:text-right">NGN <?php echo $price ?></p>
      
                            <div class="sm:order-1">
                              <div class="mx-auto flex h-8 items-stretch text-gray-600">
                                <button class="flex items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-blue-900 hover:text-white">-</button>
                                <div class="flex w-full items-center justify-center bg-gray-100 px-4 text-xs uppercase transition">1</div>
                                <button class="flex items-center justify-center rounded-r-md bg-gray-200 px-4 transition hover:bg-blue-900 hover:text-white">+</button>
                              </div>
                            </div>
                          </div>
                        </div>
      
                        <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                          <button type="submit" id="delete" class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
                            <div class="text-gray-600 cursor-pointer ml-8 hover:text-blue-900">
                              <i class="fas fa-trash"></i>
                            </div>
                          </button>
                        </div>
                      </div>
                    </li>                                                                                                                                                                               
                    <?php
                        }
                    }
                    ?>

                  </ul>
                </div>

                <?php
                ?>
                <div class="mt-6 border-t border-b py-2">
                  <div class="flex items-center justify-between">
                    <p class="text-sm text-blue-900">Subtotal</p>
                    <?php
                        $sum = "SELECT SUM(p_price) as total_cost FROM cart WHERE user_id='".$_SESSION['user_id']."'";
                        $result2 = $conn->query($sum);

                        if ($result2->num_rows > 0) {
                            while($rows = $result2->fetch_assoc()) {
                    ?>
                    <p class="text-lg font-semibold text-gray-900">NGN <?php echo $rows["total_cost"]; ?></p>
                    <?php
                            }
                        }
                    ?>
                  </div>
                  <div class="flex items-center justify-between">
                    <p class="text-sm text-blue-900">Shipping</p>
                    <p class="text-lg font-semibold text-gray-900">NGN1500.00</p>
                  </div>
                </div>
                <div class="mt-6 flex items-center justify-between">
                  <p class="text-sm font-medium text-gray-900">Total</p>
                  <?php
                  $sum = "SELECT SUM(p_price) as total_cost FROM cart WHERE user_id='".$_SESSION['user_id']."'";
                  $result2 = $conn->query($sum);

                  if ($result2->num_rows > 0) {
                      while($rows = $result2->fetch_assoc()) {
                  ?>
                  <input hidden type="text" name="total_amt" value="<?php echo $rows["total_cost"]+1500; ?>">
                  <p class="text-2xl font-semibold text-gray-900"><span class="text-xs font-normal text-gray-400">NGN</span> <?php echo $rows["total_cost"]+1500; ?></p>
                  <?php
                  
                        }
                    }
                  ?>
                </div>
      
                <div class="mt-6 text-center">
                    <button type="submit" name="submit" class="group inline-flex w-full items-center justify-center rounded-md bg-blue-900 px-6 py-4 text-lg font-semibold text-white hover:text-blue-900 transition-all duration-200 ease-in-out focus:shadow hover:bg-white">
                        Checkout
                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
              </div>
              <?php
                }
              ?>
            </div>
          </div>
        </form>
      </section>
      
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	AOS.init();
  </script>

</html>