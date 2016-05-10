<?php
$pageTitle = 'Categories';
require_once './CategoryClass.php';
require_once './ProductClass.php';
include 'header.php';
$categoriesNames = Category::getAllCategoriesName();
?>
<?php foreach ($categoriesNames as $category) { ?>   
    <div style="margin-bottom: 10px;">
        <div class="titleBar" id="<?php echo $category["name"] ?>"> 
            <h2><?php echo $category["name"] ?></h2>
            <?php $productsByCategory = Product::findProductsByCategory($category["name"]); ?>
        </div>
        <div class="rowContainer">
            <?php for ($i = 0; ($i < 4) && ($i < count($productsByCategory)); $i++) { ?>
                <div class="productBox">
                    <img src="<?php echo $productsByCategory[$i]["reference"] ?>"/>
                </div>
            <?php } ?>
        </div>
        <a class="button" type="submit" href="#" >View All </a>
    </div>
<?php } ?>


<?php include 'footer.php'; ?>