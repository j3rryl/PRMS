<?php
// Starting session
session_start();
header("Location: ../login.php");
// Destroying session
session_destroy();
?>
