<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hand Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="/index.php?page=dashboard" class="active">Home</a></li>
            <li><a href="/index.php?page=services">Services</a></li>
            <li><a href="/index.php?page=about">About Us</a></li>
            <li><a href="/index.php?page=doctors">Doctors</a></li>
            <li><a href="/index.php?page=contact">Contact</a></li>
        </ul>
    </nav>
    <!-- Rest of the HTML content remains the same -->
</body>
</html>