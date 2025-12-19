<?php
$host = "localhost";
$dbname = "saudi_vibes";
$username = "root";
$password = "";
$dsn = "mysql:host=" . $host . ";dbname=" . $dbname . ";charset=utf8mb4";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $username, $password, $options);
?>
