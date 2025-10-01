<?php
// login.php
session_start();
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM Staff WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        // Store user info in session
        $_SESSION['first_name'] = $user['first_name'];

        header("Location: verifySection.html");
        exit;
    } else {
        echo "Invalid email or password!";
    }
}
?>

