<?php
$servername = "localhost";
$username = "yonatan";
$password = "123";
$dbname = "sfp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
