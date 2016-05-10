<?php
require_once './fileUpload.php';
require_once './ProductClass.php';
require_once './CategoryClass.php';
//perfom some action for the image
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileCaption = $_POST['caption'];
    $img_id = FileUpload::uploadPicture($file,$fileCaption,'products/');
}
//find the category ID

$category_id = Category::getCategoryID($_POST['category']);
if ($category_id == NULL) {
Category::insertCategory($_POST['category']);
$category_id = Category::getCategoryID($_POST['category']);
}

$product = new Product($_POST["price"], $_POST["name"], $_POST["description"], 
        $_POST["stock"], $_POST["user_id"], $img_id, $category_id);
Product::insertProduct($product);
header("Location: viewUserProducts.php");    
?>

