<?php
$pageTitle = 'Edit Profile';
$cssLink = 'CSS/signup.css';
include 'header.php';
if (!$loggedIn) {
    header("Location: index.php");
}
$profilePic = User::getProfilePic($currentUser->userID);
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profilePic')
                        .attr('src', e.target.result)

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<section id="signupImgBox">
    <h1>Profile Picture</h1>
    <img id="profilePic" src="<?php echo $profilePic ?>" >
</section>
<section id="formBox">
    <h1>Edit Account</h1>
    <hr>
    <form action="editAccount.php" class="form-group" method="POST" enctype="multipart/form-data">
        <label for="username"><h4>Username</h4></label>
        <input class="input" type="text" name="username" value="<?php echo $currentUser->username ?>">
        <hr>
        <!--PROFILE PICTURE-->
        <label for="profilePic"><h4>Choose a Profile Picture</h4></label>
        <label for="file-upload" class="button">
            Upload Picture
        </label>
        <input id="file-upload" name="file" type="file" value="" onchange="readURL(this);" />   
        <hr>    
        <label for="firstName"><h4>First Name</h4></label>
        <input class="input" type="text" name="firstName" value="<?php echo $currentUser->firstName ?>">
        <hr>
        <label for="lastName"><h4>Last Name</h4></label>
        <input class="input"  type="text" name="lastName" value="<?php echo $currentUser->lastName ?>">
        <hr>
        <label for="type"><h4>Select the type of your account<h4></label>
           <?php if ($currentUser->type == 'individual') { ?>
               <select class="select" name="type" >
                  <option disabled="Choose here">Choose here</option>
                  <option selected value='individual'>Individual</option>
                  <option value='company'>Company</option>
               </select>
           <?php } else { ?>
                <select class="select" name="type" >
                   <option disabled="Choose here">Choose here</option>
                   <option value='individual'>Individual</option>
                   <option selected value='company'>Company</option>
                </select>
           <?php } ?>
         <hr>
         <input type="number" name="userID" value="<?php echo $currentUser->userID ?>" hidden>
         <input type="submit" class="button" value="Submit">
    </form>
    </section>
<?php include 'footer.php'; ?>
