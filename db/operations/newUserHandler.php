<?php

require 'users.php'; 

session_start();
if (isset($_SESSION["username"])) {
    newUser();
} else {
    $_SESSION['error_message'] = "User not logged in.";
    header('Location: /PRMS/login.php');
    exit;
}

?>
