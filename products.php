<?php
$pageTitle = 'Products';
$cssLink = 'CSS/products.css';
include 'ProductClass.php';
include 'header.php';
$products = Product::listAllProducts();
//var_dump($products);
?>
<h2>Products in Stock</h2>
<hr>
<?php foreach ($products as $product) { ?>
    <div class="rowContainer">
        <div class="productBox">
            <img src="<?php echo $product["reference"] ?>"/>
        </div>
        <div class="detailsBox">
            <h4>Name:</h4> <?php echo $product["name"] ?>
            <h4>Price:</h4>$<?php echo $product["price"] ?>
            <h4>Sold by:</h4><?php echo $product["username"] ?>
            <br>
            <a href="showProduct.php?id=<?php echo $product["product_id"] ?>" class="button">View More</a>
        </div>
    </div>
    <hr>
<?php } ?>

<?php include 'footer.php'; ?>