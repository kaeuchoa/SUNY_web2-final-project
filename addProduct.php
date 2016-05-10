<?php
$pageTitle = "Add product";
$cssLink = 'CSS/addProduct.css';
require_once './CategoryClass.php';
$categoriesNames = Category::getAllCategoriesName();
include 'header.php';
if (!$loggedIn) {
    header("Location: index.php");
}
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#productPic')
                        .attr('src', e.target.result)
                        .removeAttr('hidden')
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<section id="productImgBox">
    <h1>Product Picture</h1>
    <img id="productPic" src="<?php echo "images/ps4.jpg" ?>" hidden/>
</section>

<section id="formBox">
    <h1>New Product</h1>
    <hr>
    <form action="createProduct.php" method="POST" enctype="multipart/form-data">
        <!--NAME INPUT-->
        <label for="name"><h4>Name</h4></label>
        <input class="input "type="text" name="name" placeholder="Type your name of your product">
        <hr>

        <!--PRICE INPUT-->
        <label for="price"><h4>Price</h4></label>
        <div class="price">
            <input class="input "type="number" step="0.01" min="1" max="9999999" name="price" placeholder="0.00" >
        </div>
        <hr>

        <!--CATEGORY INPUT-->
        <label for="category"><h4>Category</h4></label>
        <input class="input "type="text" name="category" placeholder="Type categories separeted by comma">
        <div>
            <br>
            Suggestions: <span id="categorySugestion">?</span>  
        </div>
        <script>
//            Transfer php array to js to use on the browser
            var categories = <?php echo json_encode($categoriesNames) ?>;
            console.log(categories);
//            grab the tag input field
            var categoryInput = document.querySelector('input[name="category"]');
//            set an event for when they change to suggest taggs
            categoryInput.oninput = function () {
                var currentValue = categoryInput.value;
                var suggestedCategory = [];
                categories.forEach(function (category) {
                    var enteredCategories = currentValue.split(',');
                    if (category.name.match(enteredCategories[enteredCategories.length - 1].trim())) {
                        suggestedCategory.push(category);
                    }
                });
                var suggestionString = suggestedCategory.map(t = > t.name).join(',');
                document.querySelector('#categorySugestion').innerHTML = suggestionString;
            }

        </script>


        <br>
        <hr>

        <!--DESCRIPTION INPUT-->
        <label for="description"><h4>Description</h4></label>
        <textarea type="text" name="description" class="textArea" placeholder="Type the description of your product"></textarea>
        <hr>

        <!--STOCK INPUT-->
        <label for="stock"><h4>Amount in stock</h4></label>
        <input class="input "type="number" name="stock" min="1"name="stock" placeholder="1">       
        <hr>

        <!--PRODUCT PICTURE-->
        <label for="stock"><h4>Choose a Picture</h4></label>

        <label for="file-upload" class="button">
            Upload Picture
        </label>
        <input id="file-upload" name="file" type="file" onchange="readURL(this)"/>
        <hr>
        <!--CAPTION-->
        <label><h4>Picture Caption</h4></label>
        <input type="text" name="caption" class="input" placeholder="Type a good caption!">


        <!--USER ID-->
        <input type="number" name="user_id" value="<?php echo $currentUser->userID ?>"  hidden>

        <!--BUTTON-->
        <hr>
        <input type="submit" class="button" value="Submit">
    </form>
</section>





<?php include 'footer.php'; ?>
