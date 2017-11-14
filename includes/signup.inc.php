<?php

    if(isset($_POST['submit'])) {
        if($_POST['password'] == $_POST['password2']) {
            
            include 'db.inc.php';
            
            $escapedUsername = mysqli_real_escape_string($conn, $_POST['username']);
            $escapedEmail = mysqli_real_escape_string($conn, $_POST['email']);
            $escapedPW = mysqli_real_escape_string($conn, $_POST['password']);
            
            //Error handlers
            //Check for empty fields
            if (empty($escapedUsername) || empty($escapedEmail) || empty($escapedPW)) {   
                header("Location: ../signup.php?signup=empty");
                exit();
            } else {
                //Check if input characters are valid
                if (!preg_match("/^[a-zA-Z0-9]*$/", $escapedUsername) || !preg_match("/#(\w*[a-zA-Z0-9_]+)/", $escapedPW)) {
                    header("Location: ../signup.php?signup=invalidsymbol");
                    exit(); 
                } else {
                    //Check if email is valid
                    if (!filter_var($escapedEmail, FILTER_VALIDATE_EMAIL)) {
                        header("Location: ../signup.php?signup=invalidEmail");
                        exit(); 
                    } else {
                        $sql = "SELECT * FROM users WHERE username='$escapedUsername'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        
                        if ($resultCheck > 0) {
                            header("Location: ../signup.php?signup=invalidEmail");
                            exit(); 
                        } else {
                            //Salting and Hashing password
                            $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
                            $saltedPW = $escapedPW . $salt;
                            $hashedPW = hash('sha256', $saltedPW);
                            
                            //Insert user into database
                            if ($conn) {
                                                            
                                $sql = "INSERT INTO users (username, email, password, salt) VALUES ('$escapedUsername', '$escapedEmail', '$hashedPW', '$salt')";
                                $result = mysqli_query($conn, $sql);
                            
                                if ($result) {
                                header("Location: ../index.php?signup=success");
                                exit();
                                } else {
                                    header("Location: ../signup.php?signup=failure");
                                    exit();
                                }
                            } else {
                                header("Location: ../signup.php?signup=noConn");
                                exit();
                            }
                        }
                    }
                }
            }
            
        } else {
            header("Location: ../signup.php");
            exit();
        }
    } else {
        header("Location: ../signup.php");
        exit();
    }
