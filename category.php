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

$cid=base64_decode($_GET["cat"]);
$cats = "SELECT * FROM category WHERE id='$cid'";
$results = $conn->query($cats);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        $cname = $row["catname"];
        // $phone = $row["phone"];
        // $email = $row["email"];
        // $img = $row["pic"];
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cufflinks</title>
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
	</header>
    <div class="bg-white">
        <div class="text-slate-700 relative flex flex-col overflow-hidden px-4 md:flex-row md:items-center">
        </div>
      </div>
       <div class=" relative overflow-hidden rounded-t-lg py-32 text-center ">
        <h1 class="mt-2 text-5xl font-bold text-white uppercase"><?php echo $cname ?></h1>

        <img class="-z-10 absolute top-0 left-0 mt-10 h-2/3 w-full object-cover" src="https://images.unsplash.com/photo-1504672281656-e4981d70414b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="" />
        <div class="flex w-full mt-2 text-white justify-center space-x-4 items-center">
            <a class="font-bold text-xl" href="./">Home</a>
            <p class="font-semibold text-xl"><?php echo $cname ?></p>
        </div>
      </div>
      
 <header >
    <div class="flex flex-wrap">
        <div class="grid grid-cols-2 z-40 gap">
            <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <aside style="top: 400px; " id="sidebar-multi-level-sidebar" class="absolute  left-0 w-64 h-auto transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="./" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" viewBox="0 0 24 24" fill="currentColor" className="w-6 h-6">
                                <path d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                <path d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                            </svg>
                            <span class="ml-3">Home</span>
                        </a>
                    </li>
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
                    <li class="border-b-2 ">
                        <a href="category.php?cat=<?php echo base64_encode($catid) ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="w-6 h-6">
                                <path fillRule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm8.25 5.25a.75.75 0 01.75-.75h8.25a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75z" clipRule="evenodd" />
                              </svg>
                            <span class="ml-3"><?php echo $catname ?></span>
                        </a>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </div>
            </aside>
        
        </div>
        <section class=" relative p-4 sm:ml-64">
        <div  class="grid grid-cols-1 md:grid-cols-4 gap-6  "> 
                <?php
                    $details = "SELECT * FROM products WHERE cat = '$cid' ORDER BY ID DESC";
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
                        <form action="addcart2.php" method="post" class="absolute left-0 top-0 right-48 bg-blue-950 bg-opacity-40 items-center  justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
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
            
        </section>
    </div>
 </header>

 <footer
	class="bg-neutral-100 text-center mt-44 text-neutral-600 dark:bg-neutral-600 dark:text-neutral-200 lg:text-left">
	<div
	class="flex items-center justify-center border-b-2 border-neutral-200 p-6 dark:border-neutral-500 lg:justify-between">
	<div class="mr-12 hidden lg:block">
		<span>Get connected with us on social networks:</span>
	</div>
	<!-- Social network icons container -->
	<div class="flex justify-center">
		<a href="#!" class="mr-6 text-neutral-600 dark:text-neutral-200">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			class="h-4 w-4"
			fill="currentColor"
			viewBox="0 0 24 24">
			<path
			d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
		</svg>
		</a>
		
		<a href="#!" class="mr-6 text-neutral-600 dark:text-neutral-200">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			class="h-5 w-5"
			fill="currentColor"
			viewBox="0 0 24 24">
			<path
			d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"
			fill-rule="evenodd"
			clip-rule="evenodd" />
		</svg>
		</a>
		<a href="#!" class="mr-6 text-neutral-600 dark:text-neutral-200">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			class="h-4 w-4"
			fill="currentColor"
			viewBox="0 0 24 24">
			<path
			d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
		</svg>
		</a>
	</div>
	</div>

	<!-- Main container div: holds the entire content of the footer, including four sections (Tailwind Elements, Products, Useful links, and Contact), with responsive styling and appropriate padding/margins. -->
	<div class="mx-6 py-10 text-center md:text-left">
	<div class="grid-1 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
		<!-- Tailwind Elements section -->
		<div class="">
		<h6
			class="mb-4 flex items-center justify-center font-semibold uppercase md:justify-start">
			<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			fill="currentColor"
			class="mr-3 h-4 w-4">
			<path
				d="M12.378 1.602a.75.75 0 00-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03zM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 00.372-.648V7.93zM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 00.372.648l8.628 5.033z" />
			</svg>
			Fashion Design
		</h6>
		<p>
			Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat, fuga.
		</p>
		</div>
		<!-- Products section -->
		<div class="">
		<h6
			class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
			Products
		</h6>
		<p class="mb-4">
			<a href="mencap.html" class="text-neutral-600 dark:text-neutral-200"
			>Men's cap</a
			>
		</p>
		<p class="mb-4">
			<a href="agbada.html" class="text-neutral-600 dark:text-neutral-200"
			>Agbada</a
			>
		</p>
		<p class="mb-4">
			<a href="kaften.html" class="text-neutral-600 dark:text-neutral-200"
			>Kaften</a
			>
		</p>
		<p class="mb-4">
			<a href="m" class="text-neutral-600 dark:text-neutral-200"
			>Men's Shoe</a
			>
		</p>
		<p>
			<a href="cufflinks.html" class="text-neutral-600 dark:text-neutral-200"
			>Cufflinks</a
			>
		</p>
		</div>
		<!-- Useful links section -->
		<div class="">
		<h6
			class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
			Useful links
		</h6>
		<p class="mb-4">
			<a href="#" class="text-neutral-600 dark:text-neutral-200"
			>Home</a
			>
		</p>
		<p class="mb-4">
			<a href="#" class="text-neutral-600 dark:text-neutral-200"
			>Categories</a
			>
		</p>
		<p class="mb-4">
			<a href="#!" class="text-neutral-600 dark:text-neutral-200"
			>About</a
			>
		</p>
		<p class="mb-4">
			<a href="#!" class="text-neutral-600 dark:text-neutral-200"
			>Account</a
			>
		</p>
		<p class="mb-4">
			<a href="#!" class="text-neutral-600 dark:text-neutral-200"
			>Contact</a
			>
		</p>
		
		</div>
		<!-- Contact section -->
		<div>
		<h6
			class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
			Contact
		</h6>
		<p class="mb-4 flex items-center justify-center md:justify-start">
			<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			fill="currentColor"
			class="mr-3 h-5 w-5">
			<path
				d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
			<path
				d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
			</svg>
			Kano Nigeria
		</p>
		<p class="mb-4 flex items-center justify-center md:justify-start">
			<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			fill="currentColor"
			class="mr-3 h-5 w-5">
			<path
				d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
			<path
				d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
			</svg>
			kano@gmail.com
		</p>
		<p class="mb-4 flex items-center justify-center md:justify-start">
			<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			fill="currentColor"
			class="mr-3 h-5 w-5">
			<path
				fill-rule="evenodd"
				d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
				clip-rule="evenodd" />
			</svg>
			+2349138148156
		</p>
		<p class="flex items-center justify-center md:justify-start">
			<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			fill="currentColor"
			class="mr-3 h-5 w-5">
			<path
				fill-rule="evenodd"
				d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z"
				clip-rule="evenodd" />
			</svg>
			+ 01 234 567 89
		</p>
		</div>
	</div>
	</div>

	<!--Copyright section-->
	<div class="bg-neutral-200 p-6 text-center dark:bg-neutral-700">
	<span>© 2023 Copyright:</span>
	<a
		class="font-semibold text-neutral-600 dark:text-neutral-400"
		href="https://tailwind-elements.com/"
		>Zee Tech</a
	>
	</div>
	</footer>

    
   
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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