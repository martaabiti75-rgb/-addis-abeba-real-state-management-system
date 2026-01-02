<?php
// Debug script for contact system
echo "<h2>Contact System Debug</h2>";

// Check if files exist
echo "<h3>File Existence Check:</h3>";
$files = [
    'Configuration/ini.php',
    'CommonFunction/ContactMessageHandler.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<span style='color: green;'>✓ $file exists</span><br>";
    } else {
        echo "<span style='color: red;'>✗ $file missing</span><br>";
    }
}

// Test database connection directly
echo "<h3>Direct Database Test:</h3>";
try {
    require_once 'Configuration/ini.php';
    
    $pdo = new PDO(
        "mysql:host=" . SERVERHOST . ";dbname=" . SERVERDB,
        SERVERUNAME,
        SERVERPASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<span style='color: green;'>✓ PDO connection successful</span><br>";
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'contact_messages'");
    if ($stmt->rowCount() > 0) {
        echo "<span style='color: green;'>✓ contact_messages table exists</span><br>";
        
        // Count records
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM contact_messages");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Records in table: " . $result['count'] . "<br>";
        
    } else {
        echo "<span style='color: orange;'>! contact_messages table does not exist - creating...</span><br>";
        
        $sql = "CREATE TABLE contact_messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(500) NOT NULL,
            message TEXT NOT NULL,
            status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql);
        echo "<span style='color: green;'>✓ Table created successfully</span><br>";
    }
    
} catch (Exception $e) {
    echo "<span style='color: red;'>✗ Error: " . $e->getMessage() . "</span><br>";
}

// Test ContactMessageHandler
echo "<h3>ContactMessageHandler Test:</h3>";
try {
    require_once 'CommonFunction/ContactMessageHandler.php';
    $handler = new ContactMessageHandler();
    echo "<span style='color: green;'>✓ Handler created successfully</span><br>";
    
    // Test save
    $result = $handler->saveContactMessage("Debug Test", "debug@test.com", "Debug Subject", "Debug message content");
    if ($result) {
        echo "<span style='color: green;'>✓ Test message saved</span><br>";
    } else {
        echo "<span style='color: red;'>✗ Failed to save test message</span><br>";
    }
    
    // Test get messages
    $messages = $handler->getAllContactMessages();
    echo "Retrieved " . count($messages) . " messages<br>";
    
    // Test unread count
    $unread = $handler->getUnreadCount();
    echo "Unread messages: $unread<br>";
    
} catch (Exception $e) {
    echo "<span style='color: red;'>✗ Handler error: " . $e->getMessage() . "</span><br>";
    echo "Stack trace:<br><pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<br><hr><br>";
echo "<a href='contact_us.php'>Go to Public Contact</a> | ";
echo "<a href='Syadmin/contact_us.php'>Go to Admin Contact</a>";
?>