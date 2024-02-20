<?php
session_start();
include "../config.php";

$id = $_POST['userid'];

$cats = "SELECT * FROM category WHERE id = '$id'";
$results = $conn->query($cats);
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        $catid = $row["id"];
        $catname = $row["catname"];
        $desc = $row["descs"];
        $st = $row["st"];
    }
}

if(isset($_POST['edit'])){
    $ids=$_POST['id'];
    $name=$_POST['name'];
    $desc=$_POST['desc'];

    $update = mysqli_query($conn, "UPDATE category SET catname = '$name', descs = '$desc' WHERE id = '$ids'");
    if($update == true){
        $_SESSION['status'] = "Category Update successfully";
        $_SESSION['code'] = "success";
        header("location:category.php");
    }else{
        $_SESSION['status'] = "Unable to update category";
        $_SESSION['code'] = "error";
        header("location:category.php");
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
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Category</h3>
        <form action="edit_cat.php" method="post" class="space-y-6">
            <input hidden name="id" value="<?php echo $id ?>">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                <input type="text" value="<?php echo $catname ?>" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Category Name" required>
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <input type="text" value="<?php echo $desc ?>" name="desc" class="h-14 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required>
            </div>
            <button type="submit" name="edit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save
            </button>
        </form>
    </div>
  </body>
</html>