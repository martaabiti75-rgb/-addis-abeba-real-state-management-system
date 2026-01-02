<?php
echo "<h2>Testing Contact Database Connection</h2>";

// Test 1: Check database constants
echo "<h3>1. Database Configuration:</h3>";
require_once 'Configuration/ini.php';
echo "Host: " . SERVERHOST . "<br>";
echo "Username: " . SERVERUNAME . "<br>";
echo "Database: " . SERVERDB . "<br>";

// Test 2: Test database connection
echo "<h3>2. Database Connection Test:</h3>";
try {
    $conn = new PDO(
        "mysql:host=" . SERVERHOST . ";dbname=" . SERVERDB,
        SERVERUNAME,
        SERVERPASSWORD
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<span style='color: green;'>✓ Database connection successful!</span><br>";
    
    // Test 3: Create table
    echo "<h3>3. Table Creation Test:</h3>";
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
    echo "<span style='color: green;'>✓ Table created/verified successfully!</span><br>";
    
    // Test 4: Test ContactMessageHandler
    echo "<h3>4. ContactMessageHandler Test:</h3>";
    require_once 'CommonFunction/ContactMessageHandler.php';
    $handler = new ContactMessageHandler();
    echo "<span style='color: green;'>✓ ContactMessageHandler loaded successfully!</span><br>";
    
    // Test 5: Insert test message
    echo "<h3>5. Test Message Insert:</h3>";
    $result = $handler->saveContactMessage("Test User", "test@example.com", "Test Subject", "This is a test message");
    if ($result) {
        echo "<span style='color: green;'>✓ Test message saved successfully!</span><br>";
    } else {
        echo "<span style='color: red;'>✗ Failed to save test message</span><br>";
    }
    
    // Test 6: Get messages
    echo "<h3>6. Get Messages Test:</h3>";
    $messages = $handler->getAllContactMessages();
    echo "Found " . count($messages) . " messages<br>";
    
    if (!empty($messages)) {
        echo "<table border='1' style='border-collapse: collapse; margin-top: 10px;'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th>Date</th></tr>";
        foreach ($messages as $msg) {
            echo "<tr>";
            echo "<td>" . $msg['id'] . "</td>";
            echo "<td>" . htmlspecialchars($msg['name']) . "</td>";
            echo "<td>" . htmlspecialchars($msg['email']) . "</td>";
            echo "<td>" . htmlspecialchars($msg['subject']) . "</td>";
            echo "<td>" . $msg['status'] . "</td>";
            echo "<td>" . $msg['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (PDOException $e) {
    echo "<span style='color: red;'>✗ Database error: " . $e->getMessage() . "</span><br>";
} catch (Exception $e) {
    echo "<span style='color: red;'>✗ General error: " . $e->getMessage() . "</span><br>";
}

echo "<br><br>";
echo "<a href='contact_us.php'>Test Public Contact Form</a> | ";
echo "<a href='Syadmin/contact_us.php'>Test Admin Contact Page</a>";
?>