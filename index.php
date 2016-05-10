<?php
$cssLink = 'CSS/index.css';
include 'header.php';
require_once './ProductClass.php';
$productsReference = Product::findAllProductsRef();
?>
<section id="ad">
    <img src="http://media02.hongkiat.com/creative_pepsi_ads/pepsi-pool.jpg"/>
</section>
<br>
<section style="float: left;">
    <h1>New Items Featured</h1>
    <hr>
    <div class="box">
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/61EyE7D9tCL._SS280.jpg">
        </div>
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/51hXwPF67yL._SS280.jpg">
        </div>
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/71xyNJ59zxL._SL1200_.jpg">
        </div>
        <img class="thumbnails" src="images/base_photos/517b2A56j2L._SS280.jpg">
    </div>
</section>
<section style="float: left; margin-left: 50px;">
    <h1>Deals</h1>
    <hr>
    <div class="box">
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/r.jpg">
        </div>
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/71uQYNKiKCL._SL1500_.jpg">
        </div>
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/71lTXF9i3jL._SL1500_.jpg">
        </div>
        <img class="thumbnails" src="images/base_photos/41UW6EurNZL.jpg">
    </div>
</section>
<section style="float: left; margin-left: 50px;">
    <h1>Offers</h1>
    <hr>
    <div class="rightBox">
        <div class="insideBox">
            <img class="thumbnails" src="images/base_photos/61EyE7D9tCL._SS280.jpg">
            <img class="thumbnails" src="images/base_photos/51hXwPF67yL._SS280.jpg">
        </div>

    </div>
</section>
<br>
<?php include 'footer.php' ?>
