<?php
require_once './ProductClass.php';
//include './Session.php';
require_once './CategoryClass.php';
require_once './ImageClass.php';
require_once './fileUpload.php';
//SessionClient::checkIfLoggedIn();
$category_id = Category::getCategoryID($_POST['category']);
if($category_id == NULL){
    Category::insertCategory($_POST['category']);
    $category_id = Category::getCategoryID($_POST['category']);
}
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileCaption = $_POST['caption'];
    $img_id = FileUpload::uploadPicture($file,$fileCaption,'products/');
}
$info = [
    "name"=> $_POST['name'],
    "price"=> $_POST['price'],
    "description" => $_POST['description'],
    "stock"=> $_POST['stock'],
    "category_id"=> $category_id,
    "img_id" => $img_id,
    "product_id" => $_POST['product_id']
];


Product::updateProduct($info);

 ?>
