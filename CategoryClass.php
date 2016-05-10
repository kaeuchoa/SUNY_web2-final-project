<?php

require_once './db.php';

class Category {

    var $name;
    var $category_id;

    function __construct() {

    }

    public static function insertCategory($name) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "INSERT INTO category (name) VALUES (?)"
        );
        if (!$statement)
          header("HTTP/1.0 500 Internal Server Error");
        if (!$statement->bind_param('s', $name))
          header("HTTP/1.0 500 Internal Server Error");
        if (!$statement->execute())
            header("HTTP/1.0 500 Internal Server Error");
    }

    public static function getCategoryID($name) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "SELECT category_id FROM category WHERE name = ?"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
            // die($connection->error);
        }if (!$statement->bind_param('s', $name)) {
            // die($statement->error);
            header("HTTP/1.0 500 Internal Server Error");
        }if (!$statement->execute()) {
            // die($statement->error);
            header("HTTP/1.0 500 Internal Server Error");
        }if (!$statement->bind_result($category_id)) {
            // die($statement->error);
            header("HTTP/1.0 500 Internal Server Error");
        }if (!$statement->fetch()) {
            $category_id = NULL;
            header("HTTP/1.0 500 Internal Server Error");
        }

        return $category_id;
    }

    public static function getAllCategoriesName() {
        $connection = DB::connection();
        $results = $connection->query("SELECT name FROM category");
        $categoriesName = [];
        while ($row = $results->fetch_assoc()) {
            $categoriesName[] = $row;
        }

        return $categoriesName;
    }
    
    public static function deleteByID($id){
        $connection = DB::connection();
        $statement = $connection->prepare(
                "DELETE FROM category WHERE category_id = ?"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
            // die($connection->error);
        }if (!$statement->bind_param('i', $id)) {
            // die($statement->error);
            header("HTTP/1.0 500 Internal Server Error");
        }if (!$statement->execute()) {
            // die($statement->error);
            header("HTTP/1.0 500 Internal Server Error");
        }
    }
    
    static function updateCategoryByName($oldName,$newName) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'UPDATE category SET name = ? WHERE name  = ? '
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("ss",$newName,$oldName)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        header('Location: profile.php');
    }
}
?>
