<?php
$page = ' Sign Up';
include_once 'header.php';
?>
    <div class='header'>
        <div class='content'>
            <h1>Sign Up</h1>
            <h3>Be sure to fill in all the information</h3>
            <!--<a href='button'>Start here</a>-->
            <form class="signup-form" action="includes/signup.inc.php" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="password2" placeholder="Confirm">
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
    </div>
    
<?php
include_once 'footer.php';
?>