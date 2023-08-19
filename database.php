<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$conn = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($conn->connect_errno) {
    die("Connection error: " . $conn->connect_error);
}

return $conn;

$mail->Password = "zmwgeblmdskerxcj";