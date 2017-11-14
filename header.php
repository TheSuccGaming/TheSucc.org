<?php
    session_start();
    $_SESSION['previous_location'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>TheSucc -<?php
        echo $page;
        ?></title>
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    </head>

    <body>
        <header>
            <div class='nav-bar'>
                <a href='https://TheSucc.org'>
                    <h1>TheSucc</h1>
                </a>

                <nav>
                    <div class="nav-login">
                    <?php
                    
                        if (isset($_SESSION['uid'])) {
                            echo '<div class="login-text">Logged In As: '.$_SESSION['username'].'</div><form class="logout-button" action="includes/logout.inc.php" method="post">
                                <button type="submit" name="submit">Logout</button>
                            </form>';
                        } else {
                            echo '<form action="includes/login.inc.php" method="post">
                                <input type="text" name="username" placeholder="Username/Email">
                                <input type="password" name="password" placeholder="Password">
                                <button type="submit" name="submit">Login</button>
                            </form>
                            <a href="signup.php">Sign Up</a>';
                        }
                    ?>
                        </div>
                </nav>
            </div>
        </header>