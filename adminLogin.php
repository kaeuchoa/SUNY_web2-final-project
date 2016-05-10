<?php
include './session.php';
include './UserClass.php';

if ((empty($_POST['username']) == true )|| (empty($_POST['password']) == true)) {
    header('Location: adminPage.php?error=1');
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
        header('Location: adminPanel.php');
    } else {
        header('Location: adminPage.php?error=1');
    }
}
?>