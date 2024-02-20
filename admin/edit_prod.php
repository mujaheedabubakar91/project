<?php
session_start();
include "../config.php";

$id = $_POST['userid'];

$cats = "SELECT * FROM products WHERE id = '$id'";
$results = $conn->query($cats);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        $prod_id = $row["id"];
        $name = $row["name"];
        $desc = $row["descs"];
        $price = $row["price"];
        $pic = $row["pic"];
        $cat = $row["cat"];
        $qty = $row["qty"];

        $height = $row["height"];
        $width = $row["width"];
        $shoulder = $row["shoulder"];
        $hand = $row["hand"];

        $st = $row["st"];
        $date = $row["dates"];
    }
}

if(isset($_POST['edit'])){
    $ids=$_POST['id'];
    
    
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $catss = $_POST["category"];

    $old = $_POST["old_cat"];

    $qty = $_POST["qty"];

    $height = $_POST["height"];
    $width = $_POST["width"];
    $shoulder = $_POST["shoulder"];
    $hand = $_POST["hand"];



    if($catss ==  "empty"){

        $catss = $old;

        $update = mysqli_query($conn, "UPDATE products SET name = '$name', cat = '$catss', price = '$price', descs = '$desc', qty = '$qty', height = '$height', width = '$width', shoulder = '$shoulder', hand = '$hand' WHERE id = '$ids'");
        if($update == true){
            $_SESSION['status'] = "Product Update successfully";
            $_SESSION['code'] = "success";
            header("location:product.php");
        }else{
            $_SESSION['status'] = "Unable to update product";
            $_SESSION['code'] = "error";
            header("location:product.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href=""
      rel="stylesheet"
    />
    <title></title>
  </head>
  <body>
    <div class="px-6 py-6 lg:px-8">
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Product</h3>
        <form action="edit_prod.php" method="post" enctype="multipart/form-data" class="space-y-6">
            <input hidden name="id" value="<?php echo $id ?>">
            <input hidden name="old_cat" value="<?php echo $cat ?>">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                <input type="text" name="name" value="<?php echo $name ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Product Name" required>
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                <input type="text" name="price" value="<?php echo $price ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Price" required>
            </div>
            <div class="w-full flex gap-2">
                <div class="w-1/4">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height</label>
                    <input type="text" name="height" value="<?php echo $height ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Height">
                </div>
                <div class="w-1/4">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Width</label>
                    <input type="text" name="width" value="<?php echo $width ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Width">
                </div>
                <div class="w-1/4">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shoulder</label>
                    <input type="text" name="shoulder" value="<?php echo $shoulder ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Shoulder">
                </div>
                <div class="w-1/4">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hand</label>
                    <input type="text" name="hand" value="<?php echo $hand ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Hand">
                </div>
            </div>
            <div>
                <label for="qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                <input type="number" name="qty" value="<?php echo $qty ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Quantity" required>
            </div>
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
                <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="empty">-- Select Category --</option>
                    <?php
                        $cats = "SELECT * FROM category";
                        $results = $conn->query($cats);
                        if ($results->num_rows > 0) {
                            while($row = $results->fetch_assoc()) {
                                $theid = $row["id"];
                                $catname = $row["catname"];
                    ?>
                    <option value="<?php echo $theid ?>"><?php echo $catname ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <input type="text" name="desc" placeholder="Description" value="<?php echo $desc ?>" class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required></textarea>
            </div>
            <!-- <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
                <input type="file" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div> -->
            <button name="edit" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save
            </button>
        </form>
    </div>
  </body>
</html>