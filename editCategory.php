<?php
include './CategoryClass.php';
Category::updateCategoryByName($_POST['oldName'],$_POST['newName']);
header("Location:adminPanel.php");


?>

