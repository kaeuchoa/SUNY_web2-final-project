<?php
$pageTitle = 'Show Product';
require_once './ProductClass.php';
$product = Product::findProductByID($_GET['id']);
include 'header.php';
?>
<style>
    footer{
        position: absolute;
        bottom: 0;
    }
    .productInfo .button{
        float: right;
    }
</style>

<div class="rowContainer" style="margin-top: 10%;">
    <div class="productBox">
        <img src="<?php echo $product["reference"] ?>"/>
        <div class="caption"><?php echo $product["caption"] ?></div>
    </div>
    <div class="productInfo">
        <h2><?php echo $product["name"] ?></h2>
        <h4>by <?php echo $product["username"] ?></h4>
        <hr>
        <h4>Price: </h4>$<?php echo $product["price"] ?>
        <h4>Description: </h4><?php echo $product["description"] ?>
        <h4>Amount in Stock: </h4><?php echo $product["stock"] ?> Unit(s)
        <h4>Category: </h4><a href="categories.php#<?php echo $product["category"] ?>"><?php echo $product["category"] ?> </a>
        <br>
        <a class="button" href="buy.php">Add to my Cart</a>
    </div>
</div>



<?php include 'footer.php'; ?>

