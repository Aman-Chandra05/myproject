<?php

 $dbhost="localhost";
 $dbuser="root";
 $dbpassword="";
 $dbname="project";

 // Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>