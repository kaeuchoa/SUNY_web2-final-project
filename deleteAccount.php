<?php
include './Session.php';
include './UserClass.php';
SessionClient::checkIfLoggedIn();
User::deleteByID($_GET['id']);
SessionClient::finishSession();


?>

