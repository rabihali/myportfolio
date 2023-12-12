<?php

$servername_host = 'localhost';
$port_num = '3306';
$username = 'root';
$password = "root";
$db = 'gym';

try {
    $conn = new PDO('mysql:host=' . $servername_host . ';port=' . $port_num . ';dbname=' . $db, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conection Failed -- Error: " . $e->getMessage());
}
?>