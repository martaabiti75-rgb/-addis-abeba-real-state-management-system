<?php
// Simple Contact Form Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $response = "<div class='alert alert-danger'>Please fill all required fields.</div>";
    } else {
        try {
            // Database connection
            require_once 'Configuration/DBconfig.php';
            $database = new Database();
            $conn = $database->conn;
            
            // Insert message into database
            $stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
            $result = $stmt->execute([$name, $email, $subject, $message]);
            
            if ($result) {
                $response = "<div class='alert alert-success'>Thank you! Your message has been sent successfully.</div>";
            } else {
                $response = "<div class='alert alert-danger'>Sorry, there was an error sending your message.</div>";
            }
            
        } catch (Exception $e) {
            $response = "<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>";
        }
    }
}
?>