<?php
include './Session.php';
include './CategoryClass.php';

Category::deleteByID($_GET['id']);
header("Location: adminPanel.php");
?>