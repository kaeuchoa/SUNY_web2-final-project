<?php

include './session.php';
include './UserClass.php';

if ((empty($_POST['username']) == true ) || (empty($_POST['password']) == true)) {
    header('Location: wrongLogin.php?error=0');
} else {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $selectedUser = User::findUserWhereUsername($username);
    if ($password == $selectedUser->password) {
        SessionClient::setLoggedIn();
        $loggedIn = $_SESSION['loggedIn'];
        $_SESSION['currentUser'] = [
            "username" => $selectedUser->username
        ];
        header('Location: profile.php');
    } else {
        header('Location: wrongLogin.php?error=1');
    }
}
?>
