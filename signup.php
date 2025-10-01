<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    // 👉 Hash the password before saving
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO Staff (email, password_hash, first_name, last_name) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$email, $passwordHash, $firstName, $lastName]);

        // Redirect to login page after success
        header("Location: login.html?signup=success");
        exit;
    } catch (PDOException $e) {
        echo "Signup failed: " . $e->getMessage();
    }
}
?>

