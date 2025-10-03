<?php
    session_start(); 
    include("header.php");
    require("PHP/database.php");

    if ($_SESSION['role'] != 'admin'){ header("Location: index.php");}

    $stmt = $pdo->prepare("SELECT * FROM users ORDER BY created_at DESC");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CARD RBI - Microfinance Services</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="styles/adminStyle.css">
</head>
<body>
    <div class="forTable">
        <p>Recently Logged Members</p>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Created_account_at</th>      
        </tr>
        <?php foreach ($users as $user):?>
        <tr>
            <td><?= $user['id'];?></td>
            <td><?= htmlspecialchars($user['first_name']); ?></td>
            <td><?= htmlspecialchars($user['last_name']); ?></td>
            <td><?= $user['role'];?></td>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= $user['created_at'];?></td>
        </tr>
        <?php endforeach;?>
    </table>

    
</body>
</html>
