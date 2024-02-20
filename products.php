<?php
session_start();
include "./config.php";
if(isset($_SESSION['user_id'])){
    // header("location:login.php");

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
}
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

  <script src="./js/jquery.min.js"></script>
  <script src="./js/sweetalert.min.js"></script>

</head>

    <style>

        .header{
            display: flex;
            flex-wrap:wrap ;
            align-items: center;
            gap: 1.5rem;
            position: absolute;
        }
        .header text{ 
            flex: 1 1 21rem;
        } 
        body {
			overflow-x: hidden;
		}
		button{
			background-color:rgb(2, 2, 40) ; 
			cursor: pointer;
			display: inline-block;
			color: white;
			font-size:15px ;
			border-radius:10px ;
			text-align: center;
			padding-left: 18px;
			padding-right: 15px;
			padding-bottom: 8px;
			padding-top: 8px;
		}
      /* <button style="margin-bottom: -15px;" class="text-white font-medium rounded-lg text-sm px-12 py-2 text-center mr-4 mb-2 ">Add To Cart</button> */
		.debug {
			border: 1px red solid;
		}

		/* header {
			 min-height: 80vh;
			width: 100%; 
			background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url(picsss/bgr.jpg); 
			background-position: center; 
			background-size: cover;
			position: relative; 
		} */

		.text-box {
			width: 90%;
			color: #fff;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			text-align: center;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			-webkit-transform: translate(-50%, -50%);
			-moz-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			-o-transform: translate(-50%, -50%);
		}
 
		.text-box h1 {
			font-size: 62px;
		}

		.text-box p {
			margin: 10px 0 40px;
			font-size: 14px;
			color: #fff;
			font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
		}
		.galleryimg:hover{
			transition: 5s ease-in-out;
			transform: translateX(20);
        }
    </style>
<body>

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
                    <button data-modal-target="authentication-modal2" data-modal-toggle="authentication-modal2" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Signin</button>
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

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
       <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
          <ul class="space-y-2 font-medium">
                <?php
                    $details = "SELECT * FROM category ORDER BY ID DESC";
                    $result = $conn->query($details);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $catid = $row["id"];
                            $catname = $row["catname"];
                            $descs = $row["descs"];
                            $pic = $row["pic"];
                ?>
                 <li>
                    <a href="category.php?cat=<?php echo base64_encode($catid) ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                       <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                          <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                       </svg>
                       <span class="ml-3"><?php echo $catname ?></span>
                    </a>
                 </li>
             <?php
                    }
                }
                ?>
             
             
          </ul>
       </div>
    </aside>

    <div class="p-4 sm:ml-64">
       <div class="p-4 mt-14">
          <div  class="grid grid-cols-1 md:grid-cols-4 gap-6  "> 
                <?php
                    $details = "SELECT * FROM products ORDER BY ID DESC";
                    $result = $conn->query($details);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $prod_id = $row["id"];
                            $name = $row["name"];
                            $cat = $row["cat"];
                            $price = $row["price"];
                            $desc = $row["descs"];
                            $img = $row["pic"];
                ?>
                <div class="p-2 overflow-hidden group hover:border-blue-900 transform hover:scale-105 ">
                    <div class="relative">
                        <a class="cursor-pointer" href="details.php?prod=<?php echo base64_encode($prod_id) ?>"><img style=" height:220px ;" class="w-full" src="./admin/products/<?php echo $img ?>" alt="">
                        </a>
                        <form action="addcart.php" method="post" class="absolute left-0 top-0 right-48 bg-blue-950 bg-opacity-40 items-center  justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <input hidden type="text" name="cart_item" value="<?php echo $prod_id ?>">
                            <button type="submit" id="cart" class="text-white text-xl w-9 h-8 rounded-full bg-blue-950 flex items-center hover:text-blue-900 justify-center hover:bg-blue-300 transition" href="cart.html"><i class="fas fa-shopping-cart"></i></button>
                            <a id="search-bar" class="text-white text-xl w-9 h-8 rounded-full bg-blue-950 flex items-center hover:text-blue-900 justify-center hover:bg-blue-300 transition" href="#"><i class="fas fa-search"></i></a>
                            <a id="whishlist"  class="text-white text-xl w-9 h-8 rounded-full bg-blue-950 flex items-center hover:text-blue-900 justify-center hover:bg-blue-300 transition" href="#"><i class="fas fa-heart"></i></a> 
                        </form>
                    </div>
                    <div class=" px-4">
                        <a class="uppercase font-medium text-sm font-serif hover:text-blue-300 text-blue-800  transition" href="#"><?php echo $name ?></a>
                        <div class="flex item-baseline mb-1 space-x-2 font-roboto ">
                            <p class="text-sm  text-gray-500 font-semibold"><span class="line-through">N</span><?php echo number_format($price) ?></p>
                            <!-- <p class="text-sm text-gray-500 line-through"> ₦100,000</p> -->
                        </div>
                        <div class="flex items-center">
                            <div class="text-yellow-400  flex gap-1  text-sm ">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
       </div>
    </div>




        <!-- Footer container -->
	
    </main>

    


<!-- Register modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Register</h3>
                <form id="reg" method="post" class="space-y-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fullname</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Fullname" required>
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Phone Number" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Create Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Create Password" required>
                    </div>
                    <div>
                        <label for="cpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <input type="cpassword" name="cpassword" id="cpassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Confirm Password" required>
                    </div>
                    <div id="resp"></div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Account</button>
                    <!-- <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div> 



<!-- Login modal -->
<div id="authentication-modal2" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal2">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                <form id="login" method="post" class="space-y-6">
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Phone Number" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div id="resp3"></div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 



</body>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
	    AOS.init();
    </script>

    <script>
        $(document).ready(function () {
            // submit add book

            $("#reg").submit(function (e) {
                e.preventDefault();

                $("#resp").html("");
                $("#log").html("<div role='status'> <svg aria-hidden='true' class='inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-gray-100' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/> <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/> </svg> <span class='sr-only'>Loading...</span> </div>");
                var formData = new FormData(this);

                $.ajax({
                    url: 'reg.php',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        if (data == 'yes') {
                            window.location.reload();
                            // window.location.href = "./teacher/dashboard.php";
                        } else {
                            $("#resp").html(data);
                            $("#log").html("");
                        }
                        // $("#aform")[0].reset();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $("#login").submit(function (e) {
                e.preventDefault();

                $("#resp3").html("");
                $("#log").html("<div role='status'> <svg aria-hidden='true' class='inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-gray-100' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/> <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/> </svg> <span class='sr-only'>Loading...</span> </div>");
                var formData = new FormData(this);

                $.ajax({
                    url: 'log.php',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        if (data == 'yes') {
                            window.location.reload();
                            // window.location.href = "./teacher/dashboard.php";
                        } else {
                            $("#resp3").html(data);
                            $("#log").html("");
                        }
                        // $("#aform")[0].reset();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            // $("#addcart").submit(function (e) {
            //     e.preventDefault();

            //     $("#resp2").html("");
            //     $("#log2").html("<div role='status'> <svg aria-hidden='true' class='inline w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-gray-100' viewBox='0 0 100 101' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z' fill='currentColor'/> <path d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z' fill='currentFill'/> </svg> <span class='sr-only'>Loading...</span> </div>");
            //     var formData = new FormData(this);

            //     $.ajax({
            //         url: 'addcart.php',
            //         type: 'POST',
            //         data: formData,
            //         success: function (data) {
            //             if (data == 'yes') {
            //                 $("#resp2").html("<div class='p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400' role='alert'><span class='font-medium'>Added!</span> Item successfully added to cart</div>");
                            
            //                 // window.location.reload();
            //                 // window.location.href = "./teacher/dashboard.php";
            //             } else {
            //                 $("#resp2").html(data);
            //                 $("#log").html("");
            //             }
            //             // $("#aform")[0].reset();
            //         },
            //         cache: false,
            //         contentType: false,
            //         processData: false
            //     });
            // });

        });
    </script>
    <?php
        if(isset($_SESSION['status'])){
        ?>
        <script>
            swal({
        title: "<?php if($_SESSION['code'] == "success"){
            echo "Success";
        }else{
            echo"Oops";
        } ?>",
        text: "<?php echo $_SESSION['status'] ?>!",
        icon: "<?php echo $_SESSION['code'] ?>",
        button: "OK!",
        });
        </script>
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['code']);
        }
    ?>

</html>