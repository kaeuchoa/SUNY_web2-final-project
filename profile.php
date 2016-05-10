<?php
$pageTitle = 'Profile Page';
$cssLink = "CSS/profile.css";
require_once './ProductClass.php';
require_once './ImageClass.php';
include './header.php';
$usersProducts = Product::findUsersProducts($currentUser->userID);
$profilePic = Image::findImageByID($currentUser->profile_pic);
if (!$loggedIn) {
    header("Location: index.php");
}
//var_dump($usersProducts);
?>
<section>
    <h1>Welcome, <?php echo $currentUser->username ?></h1>
    <hr>
</section>

<section id="personalInformation">
    <div class="titleBar">
        <h2>Personal Information 
            <span class="profile-options">
                <a href="editProfile.php"> 
                    <img src="images/icons/edit-pencil.png">Edit</a>
            </span>
        </h2>
    </div>
    <div id="profileImgBox" >
        <img src="<?php echo $profilePic ?>"/>
    </div>
    <div id="informationBox">
        <ul style="border-left: solid 1px black;">
            <li><h3>First Name: <?php echo $currentUser->firstName ?></h3></li><br>
            <li><h3>Last Name: <?php echo $currentUser->lastName ?> </h3></li><br>
            <li><h3>Account Type: <?php echo $currentUser->type ?></h3></li><br>
        </ul>
        <a class="button" id="deleteButton"  
           href="deleteAccount.php?id=<?php echo $currentUser->userID; ?>" 
           onclick="return confirm('Are you sure you want to delete your account?')">
            <p style="margin:5px">
                Delete Account
                <img src="images/icons/garbage-can.png" class="iconImg"/>
            </p>
        </a>
    </div>
</section>

<section id="myRecentProducts" >
    <div class="titleBar">
        <h2>
            My Recent Products
            <span class="profile-options">
                <a href="viewUserProducts.php?id=<?php echo $currentUser->userID; ?>"><img src="images/icons/list.png"/>View all </a>
            </span>
        </h2>
    </div>
    <?php if (count($usersProducts) != 0) { ?>
        <div class="rowContainer">
            <!--<ul>-->
            <?php
            for ($i = 0; $i < count($usersProducts); $i++) {
                if ($i > 3) {
                    break;
                }
                ?>
                <div class="productBox">
                    <img style="" src="<?php echo $usersProducts[$i]["reference"] ?>" alt="" />
                </div>
            <?php } ?>
            <!--</ul>-->
        </div>
    <?php } ?>
    <a class="button" style="float: right" href="addProduct.php">
        <p style="margin:5px">
            Add Product
            <img src="images/icons/plus-sign.png" style="width:17px;height:20px;" />
        </p>
    </a>
</section>

<?php include './footer.php'; ?>
