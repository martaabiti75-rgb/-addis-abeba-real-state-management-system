<?php
// Database setup script for contact messages table
require_once 'Configuration/ini.php';

try {
    $conn = new PDO(
        "mysql:host=" . SERVERHOST . ";dbname=" . SERVERDB,
        SERVERUNAME,
        SERVERPASSWORD
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create contact_messages table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(500) NOT NULL,
        message TEXT NOT NULL,
        status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "Contact messages table created successfully or already exists.";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Setup</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Contact Messages Table Setup</h2>
    <p>Run this script once to create the contact_messages table.</p>
    <p><a href="contact_us.php">Go to Contact Us Page</a></p>
    <p><a href="Syadmin/contact_us.php">Go to Admin Contact Page</a></p>
</body>
</html>