<?php 
// Debug version to identify the issue
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Starting debug...<br>";

session_start();
echo "Session started...<br>";

if (isset($_SESSION['sessionID'])) {
    echo "Session ID found: " . $_SESSION['sessionID'] . "<br>";
} else {
    echo "No session ID found, redirecting...<br>";
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
    exit;
}

echo "Trying to include performMgAction.php...<br>";
try {
    require __DIR__.'/performMgAction.php';
    echo "performMgAction.php included successfully<br>";
    $isPerformMgOBJ = new isPerformMgAction();
    echo "isPerformMgAction object created<br>";
} catch (Exception $e) {
    echo "Error with performMgAction.php: " . $e->getMessage() . "<br>";
}

echo "Trying to include CommenForEveryUserFunction.php...<br>";
try {
    require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
    echo "CommenForEveryUserFunction.php included successfully<br>";
    $CommonOBJ = new CommonFunction();
    echo "CommonFunction object created<br>";
} catch (Exception $e) {
    echo "Error with CommenForEveryUserFunction.php: " . $e->getMessage() . "<br>";
}

echo "Trying to include ContactMessageHandler.php...<br>";
try {
    require __DIR__.'/../CommonFunction/ContactMessageHandler.php';
    echo "ContactMessageHandler.php included successfully<br>";
    $contactHandler = new ContactMessageHandler();
    echo "ContactMessageHandler object created<br>";
} catch (Exception $e) {
    echo "Error with ContactMessageHandler.php: " . $e->getMessage() . "<br>";
}

echo "Trying to get session user data...<br>";
try {
    $dataQ = $isPerformMgOBJ->getSessionUser($_SESSION['sessionID']);
    echo "Session user data retrieved<br>";
    
    foreach ($dataQ as $key => $value) {
        $fullname = $value['fullname'];
        $role = $value['role'];
        $AccountState = $value['account_status'];
        $url = $value['profile_picture_url'];
        $lastlogintime = $value['last_login_time'];
    }
    echo "User data processed: " . $fullname . " (" . $role . ")<br>";
} catch (Exception $e) {
    echo "Error getting session user: " . $e->getMessage() . "<br>";
}

echo "Trying to get contact messages...<br>";
try {
    $contactMessages = $contactHandler->getAllContactMessages();
    echo "Contact messages retrieved: " . count($contactMessages) . " messages<br>";
    
    $unreadCount = $contactHandler->getUnreadCount();
    echo "Unread count: " . $unreadCount . "<br>";
} catch (Exception $e) {
    echo "Error getting contact messages: " . $e->getMessage() . "<br>";
}

echo "<br><strong>Debug completed successfully!</strong><br>";
echo "<a href='contact_messages.php'>Try the main page now</a>";
?>