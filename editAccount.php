<?php
include './UserClass.php';
include './Session.php';
require_once './fileUpload.php';
SessionClient::checkIfLoggedIn();
var_dump($_POST['userID']);
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $img_id = FileUpload::uploadPicture($file,'no caption','products/');
}
$info = [
    "username"=> $_POST['username'],
    "firstName"=> $_POST['firstName'],
    "lastName" => $_POST['lastName'],
    "type"=> $_POST['type'],
    "userID"=> $_POST['userID']
];

$_SESSION['currentUser']['username'] = $info['username'];
//var_dump($_SESSION['currentUser']['username']);
User::updateUser($info);

 ?>
