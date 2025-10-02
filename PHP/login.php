<?php
// login.php
session_start();
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Client WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['first_name'] = $user['first_name'];
                header("Location: verifySection.php");
                exit;
            } else {
                $error = "Invalid email or password!";
            }
        } catch (PDOException $e) {
            // Handle database errors
            $error = "An error occurred. Please try again later.";
        }
    } else {
        $error = "Please enter a valid email and password.";
    }
}
?>

