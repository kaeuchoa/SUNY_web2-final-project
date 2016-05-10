<?php

require_once './UserClass.php';
require_once './session.php';
require_once './fileUpload.php';

if($_POST){
  if ($_POST['password'] === $_POST['confirmPassword']) {
      if (isset($_FILES['file'])) {
          $file = $_FILES['file'];
          $fileCaption = "no caption";
          $img_id = FileUpload::uploadPicture($file, $fileCaption,'profile/');
      }
      $user = new User(
              $_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['password'], $_POST['type'], $img_id
      );
      User::insertUser($user);
      SessionClient::setLoggedIn();
      $loggedIn = $_SESSION['loggedIn'];
      $_SESSION['currentUser'] = [
          "username" => $user->username
      ];
      header("Location: index.php");
  } else {
      header("Location: signup.php?error=1");
  }
}else{
    // print_r($_POST);
    // print_r(!isset($_POST));
    header("Location: signup.php?error=0");
}
?>
