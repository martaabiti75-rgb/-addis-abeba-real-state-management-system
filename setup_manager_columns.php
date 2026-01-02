<?php
// Setup script to add manager columns to room table
require_once 'Configuration/ini.php';

echo "<h2>Setting up Manager Columns for Room Table</h2>";

try {
    $conn = new PDO(
        "mysql:host=" . SERVERHOST . ";dbname=" . SERVERDB,
        SERVERUNAME,
        SERVERPASSWORD
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p>✓ Database connection successful!</p>";
    
    // Check if columns already exist
    $stmt = $conn->prepare("SHOW COLUMNS FROM `room` LIKE 'ManagerEmail'");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: orange;'>⚠ Manager columns already exist in room table.</p>";
    } else {
        // Add manager columns
        $sql = "ALTER TABLE `room` 
                ADD COLUMN `ManagerEmail` VARCHAR(255) NULL DEFAULT NULL,
                ADD COLUMN `ManagerName` VARCHAR(255) NULL DEFAULT NULL,
                ADD COLUMN `ManagerPhone` VARCHAR(20) NULL DEFAULT NULL";
        
        $conn->exec($sql);
        echo "<p style='color: green;'>✓ Manager columns added successfully!</p>";
        
        // Add index for better performance
        $indexSql = "ALTER TABLE `room` ADD INDEX `idx_manager_email` (`ManagerEmail`)";
        $conn->exec($indexSql);
        echo "<p style='color: green;'>✓ Manager email index added successfully!</p>";
    }
    
    echo "<h3>Manager Columns Setup Complete!</h3>";
    echo "<p><a href='Owner/create_room.php'>Go to Create Room Page</a></p>";
    echo "<p><a href='Owner/dashboard.php'>Go to Owner Dashboard</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Error: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Columns Setup</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }
        h2 { color: #004aad; }
        p { margin: 10px 0; }
        a { color: #004aad; text-decoration: none; padding: 8px 15px; background: #f0f8ff; border-radius: 5px; display: inline-block; margin: 5px; }
        a:hover { background: #004aad; color: white; }
    </style>
</head>
<body>
</body>
</html>