<?php
session_start();
include 'config.php';
unset ($_SESSION['username']);
unset ($_SESSION['loginstatus']);
unset ($_SESSION['user_id']);
$conn->close();
header('location:product.php');
?>
