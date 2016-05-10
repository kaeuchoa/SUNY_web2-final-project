<?php
$pageTitle = 'Sign Up';
$cssLink = 'CSS/signup.css';
include 'header.php';
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profilePic')
                        .attr('src', e.target.result)
                        .removeAttr('hidden')
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<section id="signupImgBox">
    <h1>Profile Picture</h1>
    <img id="profilePic" src="#" hidden>
</section>
<section id="formBox">
    <h1>New Account</h1>
    <hr>
    <?php if (isset($_GET['error']) && $_GET['error'] == 1) { ?>
        <div class="errorMessage">
            Passwords don't match
        </div>
    <?php } else if (isset($_GET['error']) && $_GET['error'] == 0) { ?>
        <div class="errorMessage">
            You need to fill all the fields.
        </div>
    <?php } ?>
    <form action="createAccount.php" method="POST" enctype="multipart/form-data">
        <label for="username"><h4>Username</h4></label>
        <input class="input" type="text" name="username" placeholder="Type your username">
        <hr>
        <!--PROFILE PICTURE-->
        <label for="profilePic"><h4>Choose a Profile Picture</h4></label>
        <label for="file-upload" class="button">
            Upload Picture
        </label>
        <input id="file-upload" name="file" type="file" value="" onchange="readURL(this);" />
        <hr>
        <label for="firstName"><h4>First Name</h4></label>
        <input class="input" type="text" name="firstName" placeholder="Type your first name">
        <hr>
        <label for="lastName"><h4>Last Name</h4></label>
        <input  class="input" type="text" name="lastName" placeholder="Type your last name">
        <hr>
        <label for="password"><h4>Password</h4></label>
        <input class="input" type="password" name="password" placeholder="Type your password">
        <hr>
        <label for="confirmPassword"><h4>Confirm your Password</h4></label>
        <input class="input" type="password" name="confirmPassword" placeholder="Type your password again">
        <hr>
        <label for="type"><h4>Select the type of your account</h4></label>
        <select class="select" name="type" >
            <option selected disabled="Choose here">Choose here</option>
            <option value='individual'>Individual</option>
            <option value='company'>Company</option>
        </select>
        <hr>
        <input type="submit" class="button" value="Submit">
    </form>
</section>

<?php include 'footer.php'; ?>
