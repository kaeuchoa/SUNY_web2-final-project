<?php
$pageTitle = 'Admin Panel';
$cssLink = 'CSS/wrongLogin.css';
$errorCode = $_GET['error'];
$errorMessages = [
    0 => 'Username or password field are empty!',
    1 => 'Invalid username/password. Try again.'
];
include 'header.php';
?>
<form id="loginForm" action="adminLogin.php" method="POST">
    <ul>
        <img src="http://design.ubuntu.com/wp-content/uploads/ubuntu-logo32.png"/>
        <?php if (isset($errorCode) && $errorCode == 0) { ?>
            <li class="errorMessage"><?php echo $errorMessages[0] ?></li>
        <?php } else if (isset($errorCode) && $errorCode == 1) { ?>
            <li class="errorMessage"><?php echo $errorMessages[1] ?></li>
        <?php }  ?>
            
        <li><label for="username"><h4>Username</h4></label></li>
        <li><input class="input" type="text" name="username" placeholder="Username"></li>
        <li><label for="password"><h4>Password</h4></label></li>
        <li><input class="input" type="password" name="password" placeholder="Password"></li>
        <li><input class="button"type="submit" name="submit" value="Login"></li>
        <li><a href="signup.php">Sign up</a></li>
    </ul>
</form>
<?php include 'footer.php'; ?>