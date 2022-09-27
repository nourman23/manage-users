<?php
$servername = "localhost";
$username = "root";
$password = "root";



try {
    $conn = new PDO("mysql:host=$servername;dbname=orange", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "connected successfully <br>";
} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();
}