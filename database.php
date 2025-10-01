<?php
// database.php
$host = "localhost";
$dbname = "Microfinance_System";
$username = "root";   // change if needed
$password = "admin";       // change if you have a MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>