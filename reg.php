<?php 
include "./config.php";
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $phone=ltrim($phone, "+2340");
    $phone="+234".$phone;
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];

    $date = time();

    if($pass !== $cpass){
        echo '
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    Passwords do not match
                </div>
            </div>
            ';
    }else{

        $insert=mysqli_query($conn, "INSERT INTO users (name,phone,email,pwd,date_reg)VALUES
        ('$name','$phone','$email','$pass','$date')");

        if($insert == true){
            $_SESSION['user_id'] = $phone;
            $_SESSION['status'] = "Registration Successfull";
            $_SESSION['code'] = "success";
            echo "yes";
        }else{
            echo '
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    Sorry, unable to register, pls try again
                </div>
            </div>
            ';
        }
    }
}

?>