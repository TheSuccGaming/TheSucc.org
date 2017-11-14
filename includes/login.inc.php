<?php
session_start();

if (isset($_POST['submit'])) {
    
    include 'db.inc.php';
        
    $escapedUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $escapedPassword = mysqli_real_escape_string($conn, $_POST['password']);
    
    //Error handlers
    //Check if inputs empty
    if (empty($escapedUsername) || empty($escapedPassword)) {
        header("Location: ".$_SESSION['previous_location']."");
        exit(); 
    } else {
        $sql = "SELECT * FROM users WHERE username='$escapedUsername' OR email='$escapedUsername'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ".$_SESSION['previous_location']."");
            exit(); 
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                //De-Salting and De-Hashing password
                $salt = $row['salt'];
                $saltedPW = $escapedPassword . $salt;
                $hashedPW = hash('sha256', $saltedPW);
                $dbPassword = $row['password'];
                if ($hashedPW == $dbPassword) {
                    //Log in the user
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    header("Location: ".$_SESSION['previous_location']."");
                    exit();
                } else {
                    header("Location: ".$_SESSION['previous_location']."");
                    exit(); 
                }
            }
        }
    }
} else {
        header("Location: ".$_SESSION['previous_location']."");
        exit();
}