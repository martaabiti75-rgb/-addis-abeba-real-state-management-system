<?php
class ContactMessageHandler {
    private $conn;
    
    public function __construct() {
        require_once __DIR__ . '/../Configuration/ini.php';
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . SERVERHOST . ";dbname=" . SERVERDB,
                SERVERUNAME,
                SERVERPASSWORD
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create table if it doesn't exist
            $this->createTableIfNotExists();
            
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            $this->conn = null;
        }
    }
    
    // Create contact_messages table if it doesn't exist
    private function createTableIfNotExists() {
        if (!$this->conn) return;
        
        try {
            $sql = "CREATE TABLE IF NOT EXISTS contact_messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                subject VARCHAR(500) NOT NULL,
                message TEXT NOT NULL,
                status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
                manager_comment TEXT NULL,
                manager_name VARCHAR(255) NULL,
                replied_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            
            $this->conn->exec($sql);
            
            // Create comments table for multiple comments per message
            $commentsSql = "CREATE TABLE IF NOT EXISTS message_comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                message_id INT NOT NULL,
                manager_name VARCHAR(255) NOT NULL,
                comment TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (message_id) REFERENCES contact_messages(id) ON DELETE CASCADE
            )";
            
            $this->conn->exec($commentsSql);
        } catch (PDOException $e) {
            error_log("Error creating contact_messages table: " . $e->getMessage());
        }
    }
    
    // Save contact message from public form
    public function saveContactMessage($name, $email, $subject, $message) {
        if (!$this->conn) return false;
        
        try {
            $stmt = $this->conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$name, $email, $subject, $message]);
        } catch (PDOException $e) {
            error_log("Error saving contact message: " . $e->getMessage());
            return false;
        }
    }
    
    // Get all contact messages for admin
    public function getAllContactMessages() {
        if (!$this->conn) return [];
        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting contact messages: " . $e->getMessage());
            return [];
        }
    }
    
    // Get unread messages count
    public function getUnreadCount() {
        if (!$this->conn) return 0;
        
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM contact_messages WHERE status = 'unread'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            error_log("Error getting unread count: " . $e->getMessage());
            return 0;
        }
    }
    
    // Mark message as read
    public function markAsRead($id) {
        if (!$this->conn) return false;
        
        try {
            $stmt = $this->conn->prepare("UPDATE contact_messages SET status = 'read' WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error marking message as read: " . $e->getMessage());
            return false;
        }
    }
    
    // Delete message
    public function deleteMessage($id) {
        if (!$this->conn) return false;
        
        try {
            $stmt = $this->conn->prepare("DELETE FROM contact_messages WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting message: " . $e->getMessage());
            return false;
        }
    }
    
    // Add comment to message
    public function addComment($messageId, $managerName, $comment) {
        if (!$this->conn) return false;
        
        try {
            $stmt = $this->conn->prepare("INSERT INTO message_comments (message_id, manager_name, comment) VALUES (?, ?, ?)");
            $result = $stmt->execute([$messageId, $managerName, $comment]);
            
            // Update message status to replied
            if ($result) {
                $updateStmt = $this->conn->prepare("UPDATE contact_messages SET status = 'replied', manager_comment = ?, manager_name = ?, replied_at = NOW() WHERE id = ?");
                $updateStmt->execute([$comment, $managerName, $messageId]);
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Error adding comment: " . $e->getMessage());
            return false;
        }
    }
    
    // Get comments for a message
    public function getMessageComments($messageId) {
        if (!$this->conn) return [];
        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM message_comments WHERE message_id = ? ORDER BY created_at ASC");
            $stmt->execute([$messageId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting comments: " . $e->getMessage());
            return [];
        }
    }
    
    // Get single message with comments
    public function getMessageWithComments($id) {
        if (!$this->conn) return null;
        
        try {
            $stmt = $this->conn->prepare("SELECT * FROM contact_messages WHERE id = ?");
            $stmt->execute([$id]);
            $message = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($message) {
                $message['comments'] = $this->getMessageComments($id);
            }
            
            return $message;
        } catch (PDOException $e) {
            error_log("Error getting message with comments: " . $e->getMessage());
            return null;
        }
    }
}
?>