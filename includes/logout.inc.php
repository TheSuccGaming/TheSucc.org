<?php

if (isset($_POST['submit'])) {
    session_start();
    header("Location: ".$_SESSION['previous_location']."");
    session_unset();
    session_destroy();
    exit();
}

?>