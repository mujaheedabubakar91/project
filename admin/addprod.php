<?php 
include "../config.php";
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST"){

    $name=$_POST['name'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $desc=$_POST['desc'];
    $qty=$_POST['qty'];

    $height=$_POST['height'];
    $width=$_POST['width'];
    $shoulder=$_POST['shoulder'];
    $hand=$_POST['hand'];

    $date = time();

    // Uploads files
  // name of the uploaded file
  $filename = $_FILES['image']['name'];

  // destination of the file on the server
  $destination = './products/' . $filename;

  // get the file extension
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

  // the physical file on a temporary uploads directory on the server
  $file = $_FILES['image']['tmp_name'];
  $size = $_FILES['image']['size'];

  if (!in_array($extension, ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'])) {
    echo '
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    Your picture file extension must be .jpg, .jpeg or .png!.
                </div>
            </div>
        ';
  } else {
      // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {

            $insert=mysqli_query($conn, "INSERT INTO products (name,cat,price,descs,qty,height,width,shoulder,hand,pic,st,dates)VALUES
            ('$name','$category','$price','$desc','$qty','$height','$width','$shoulder','$hand','$filename','0','$date')");

            if($insert == true){
                $_SESSION['status'] = "Product added successfully";
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
                        Sorry, unable to add product
                    </div>
                </div>
                ';
            }
        }else{
            echo '
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        Please upload your product picture
                    </div>
                </div>
                ';
        }
    }
}

?>