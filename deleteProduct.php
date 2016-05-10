<?php
include './Session.php';
include './ProductClass.php';
SessionClient::checkIfLoggedIn();
Product::deleteProductByID($_GET['id']);
header("Location: viewUserProducts.php");



?>