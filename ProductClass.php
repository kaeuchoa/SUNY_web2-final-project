<?php

require_once './db.php';

class Product {

    var $product_id;
    var $price;
    var $name;
    var $description;
    var $stock;
    var $user_id;
    var $image_id;
    var $category_id;

    function __construct($price, $name, $description, $stock, $user_id, $image_id, $category_id) {
        $this->price = $price;
        $this->name = $name;
        $this->description = $description;
        $this->stock = $stock;
        $this->product_id = 0;
        $this->user_id = $user_id;
        $this->image_id = $image_id;
        $this->category_id = $category_id;
    }

    public static function insertProduct($product) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "INSERT INTO products (price,name,description,stock,"
                . "category_id,img_id,user_id) VALUES (?,?,?,?,?,?,?)"
        );

        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("dssiiii", $product->price, $product->name, $product->description, $product->stock, $product->category_id, $product->image_id, $product->user_id
                )) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    public static function findUsersProducts($user_id) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'SELECT images.reference, products.name,product_id FROM products JOIN images ON
                products.img_id = images.img_id WHERE products.user_id = ?'
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("i", $user_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_result($imageRef, $name, $product_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        $products = [];
        while ($statement->fetch()) {
            $products[] = [
                "reference" => $imageRef,
                "name" => $name,
                "id" => $product_id
            ];
        }
        return $products;
    }

    public static function findProductsByCategory($category) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "SELECT images.reference,products.product_id, category.category_id "
                . "FROM products JOIN images ON products.img_id = images.img_id "
                . "JOIN category on products.category_id = category.category_id "
                . "WHERE category.name = ?"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("s", $category)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_result($imageRef, $product_id, $category_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        $products = [];
        while ($statement->fetch()) {
            $products[] = [
                "reference" => $imageRef,
                "product_id" => $product_id,
                "category_id" => $category_id
            ];
        }
        return $products;
    }

    public static function findAllProductsRef() {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "SELECT images.reference,products.product_id "
                . "FROM products JOIN images ON products.img_id = images.img_id "
                . "ORDER BY products.product_id DESC"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_result($imageRef, $product_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        $products = [];
        while ($statement->fetch()) {
            $products[] = [
                "reference" => $imageRef,
                "product_id" => $product_id
            ];
        }
        return $products;
    }

    public static function deleteProductByID($product_id) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "DELETE FROM products WHERE product_id = ?"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('i', $product_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    static function findProductByID($product_id) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "SELECT p.product_id,p.price,p.name,p.description, p.stock,i.caption," .
                "i.reference,c.name,u.username FROM products p JOIN images i ON p.img_id = i.img_id"
                . " JOIN category c ON p.category_id = c.category_id JOIN users u ON"
                . " p.user_id = u.user_id"
                . " WHERE p.product_id = ? "
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('i', $product_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_result($p_id, $p_price, $p_name, $p_description, $p_stock, $i_caption, $i_reference, $c_name,$username)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        $statement->fetch();

        $products = [
            "product_id" => $p_id,
            "price" => $p_price,
            "name" => $p_name,
            "description" => $p_description,
            "stock" => $p_stock,
            "reference" => $i_reference,
            "caption" => $i_caption,
            "category" => $c_name,
            "username" => $username
        ];

        return $products;
    }

    static function updateProduct($info) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'UPDATE products SET name = ?,price= ?,description = ?,stock=?,'
                . 'category_id = ?, img_id = ?'
                . ' WHERE product_id = ?'
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("sdsiiii", $info['name'], $info['price'], $info['description'], $info['stock'], $info['category_id'], $info['img_id'], $info['product_id']
                )) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        header('Location: viewUserProducts.php');
    }

    static function listAllProducts() {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "SELECT p.name,p.product_id,p.price,i.reference,u.username FROM products p"
                . " JOIN images i ON p.img_id = i.img_id JOIN users u on p.user_id = u.user_id"
                . " ORDER BY p.product_id DESC"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_result($name,$product_id,$price,$imageRef,$username)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        $products = [];
        while ($statement->fetch()) {
            $products[] = [
                "reference" => $imageRef,
                "product_id" => $product_id,
                "name" => $name,
                "price" => $price,
                "username" => $username
            ];
        }
        return $products;
}

}
?>
