<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // Sanitize and validate inputs
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    if (!$email) {
        die("Invalid email address.");
    }
    if (empty($password) || empty($firstName) || empty($lastName)) {
        die("Please fill all fields.");
    }

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Optional: Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            die("Email already registered.");
        }

        // Insert new staff member
        $stmt = $pdo->prepare("
            INSERT INTO users (email, password_hash, first_name, last_name) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$email, $passwordHash, $firstName, $lastName]);

        // Redirect after successful signup
        header("Location: CardRBIv2/login.php?signup=success");
        exit;
    } catch (PDOException $e) {
        // Log error instead of displaying
        error_log($e->getMessage());
        echo $e;
        echo "Signup failed. Please try again.";
    }
}
?>