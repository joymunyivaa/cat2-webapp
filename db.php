<?php
$host = "localhost";
$user = "cns_admin";
$pass = "Admin@1234";
$dbname = "CAT2";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>