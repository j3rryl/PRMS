<?php

require 'users.php'; 

session_start();
if (isset($_SESSION["username"])) {
    updateAccount();
} else {
    $_SESSION['error_message'] = "User not logged in.";
    header('Location: /PRMS/login.php');
    exit;
}

?>
