<?php
$pageTitle = 'All Products';
$cssLink = './CSS/viewUserProducts.css';
include './ProductClass.php';
include './header.php';
if (!$loggedIn) {
    header("Location: index.php");
}
$counter = 0;
$usersProducts = Product::findUsersProducts($currentUser->userID);
?>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.rawgit.com/nnattawat/flip/v1.0.20/dist/jquery.flip.min.js"></script>

<script type="text/javascript">
    $(function () {
        $(".card").flip({
            trigger: "click"
        });
    });
    function confirmation() {
        ;
    }
</script>
<section>
    <h2>Here are all your products, <?php echo $currentUser->firstName; ?></h2>
    <hr>

</section>
<?php
while ($counter < count($usersProducts)) {
    ?>
    <section class="rowContainer">
        <?php for ($i = $counter; $i < $counter + 4 && ($i < count($usersProducts)); $i++) { ?>
            <div class="productBox card">
                <div class="front">
                    <img src="<?php echo $usersProducts[$i]["reference"] ?>"/>
                </div>
                <div class="back cardOptions">
                    <ul>
                        <li><h3 style="color:white;">Options for <?php echo $usersProducts[$i]["name"] ?></h3></li>
                        <br>
                        <li class="button"><a href="editProduct.php?id=<?php echo $usersProducts[$i]["id"]; ?> ">Edit</a></li>
                        <br>
                        <li class="button">
                            <a style="width: 100%;" href="deleteProduct.php?id=<?php echo $usersProducts[$i]["id"]; ?> "
                               onclick="return confirm('Are you sure you want to delete this item?')">
                                Delete
                            </a>
                        </li>

                    </ul>

                </div>

            </div>
        <?php }
        ?>
    </section>
    <?php
    $counter+=4;
}
?>


<?php include 'footer.php'; ?>
