<?php
include './session.php';
include './UserClass.php';
$loggedIn = SessionClient::checkIfLoggedIn();
?>


<html>
    <head>
        <?php if (isset($pageTitle)) { ?>
            <title>
                <?php echo $pageTitle; ?>
            </title>
        <?php } else { ?>
            <title>Welcome!</title>
        <?php } ?>
        <meta charset="utf-8">
        <link href="CSS/baseLayout.css" rel="stylesheet">
        <link href="CSS/elementsClasses.css" rel="stylesheet">
        <link href="CSS/textStyles.css" rel="stylesheet">
        <link href="CSS/imagesStyles.css" rel="stylesheet">
        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
        <?php if (isset($cssLink)) { ?>
            <link rel = "stylesheet" href = "<?php echo $cssLink ?>" />
        <?php } ?>
    </head>
    <body>
        <nav class="myNavBar">
            <div class="links">
                <div id="storeLogo"><a href="index.php"><img src="http://design.ubuntu.com/wp-content/uploads/ubuntu-logo32.png"></a></div>
                <ul style="display: inline-block;float: left;">
                    <li><a href="products.php">Products</a></li>
                    <li><a href="categories.php">Categories</a></li>
                </ul>
            </div>
            <div class="searchBar">
                <form action="search.php" method="POST">
                    <input id="searchInput"  type="text" class="input" placeholder="Type your search here">
                    <input type="submit" class="button" value="Search!" style="width: 100px;float: right;">
                </form>
            </div>
            <div id="loginArea">
                <?php
                if ($loggedIn) {
                    $currentUser = User::findUserWhereUsername($_SESSION['currentUser']['username']);
                    ?>
                    <div id="userOptions">
                        <p>
                            Hello, <?php echo $currentUser->firstName ?>
                            <a href="profile.php">
                                <img class="navIcon" src="images/icons/user.png">
                            </a>
                            <a id="logout"href="logout.php">
                                <img class="navIcon" src="images/icons/logout.png">
                            </a>
                        </p>
                    </div>

                <?php } else { ?>
                    <form  action="login.php" method="POST">
                        <ul>
                            <li><label for="username">Username</label></li>
                            <li><input class="input" type="text" name="username" placeholder="Username"></li>
                            <li><label for="password">Password</label></li>
                            <li><input class="input" type="password" name="password" placeholder="Password"></li>
                            <li><input class="button"type="submit" name="submit" value="Login"></li>
                            <li><a href="signup.php">Sign up</a></li>
                        </ul>
                    </form>
                <?php } ?>
            </div>
        </nav>
        <div class="container">
