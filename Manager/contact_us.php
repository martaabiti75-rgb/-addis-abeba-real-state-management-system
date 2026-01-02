<?php 
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['sessionID'])) {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
    exit;
}

// Simple database connection
require __DIR__.'/../Configuration/DBconfig.php';

try {
    $database = new Database();
    $conn = $database->conn;
    
    // Get manager session info
    $sessionEmail = $_SESSION['sessionID'];
    $stmt = $conn->prepare("SELECT * FROM real_state_db.user_account a INNER JOIN user_details u ON a.account_id = u.account_id WHERE a.email = ?");
    $stmt->execute([$sessionEmail]);
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$userInfo) {
        echo "<script>window.location='../pages_login.php?login&error=Session Invalid.';</script>";
        exit;
    }
    
    $fullname = $userInfo['fullname'];
    $role = $userInfo['role'];
    $lastlogintime = $userInfo['last_login_time'];
    
    // Get contact messages - only show recent messages
    $stmt = $conn->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 50");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    $messages = [];
    $error_message = "Error loading messages: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Contact Messages - Adis Abeba Real Estate Management System</title>

<!-- Favicons -->
<link href="../assets/img/aacitylogo.jpg" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="../dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/simple-datatables/style.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="../dashboard/assets/css/style.css" rel="stylesheet">

<style>
  .contact-info { background: linear-gradient(135deg, #004aad 0%, #0066cc 100%); color: white; border-radius: 12px; padding: 30px; }
  .contact-form { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
  .form-control { border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 15px; }
  .form-control:focus { border-color: #004aad; box-shadow: 0 0 0 0.2rem rgba(0, 74, 173, 0.25); }
  .btn-primary { background-color: #004aad; border-color: #004aad; border-radius: 8px; padding: 12px 30px; }
  .contact-item { margin-bottom: 25px; }
  .contact-item i { font-size: 24px; margin-right: 15px; color: #ffd700; }
</style>
</head>

<body>

<?php if (isset($error_message)): ?>
<div style="background: red; color: white; padding: 10px; margin: 10px;">
  DEBUG ERROR: <?= $error_message ?>
</div>
<?php endif; ?>

<?php if (isset($fullname)): ?>
<div style="background: green; color: white; padding: 10px; margin: 10px;">
  DEBUG SUCCESS: User loaded - <?= $fullname ?> (<?= $role ?>)
</div>
<?php endif; ?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="dashboard" class="logo d-flex align-items-center">
      <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80px; max-width: 60px;">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <?php 
      $profilePath = __DIR__.'/profileModal.php';
      if (file_exists($profilePath)) {
          include $profilePath;
      } else {
          echo '<li><span class="text-white">Profile</span></li>';
      }
      ?>
    </ul>
  </nav>
</header>

<!-- ======= Sidebar ======= -->
<?php 
$sidebarPath = __DIR__.'/Component/Asidebar.php';
if (file_exists($sidebarPath)) {
    require $sidebarPath;
} else {
    echo '<aside id="sidebar" class="sidebar"><p>Sidebar not found</p></aside>';
}
?>

<main id="main" class="main">
<?php 
$logoutPath = __DIR__.'/Component/Logoutmodal.php';
if (file_exists($logoutPath)) {
    require $logoutPath;
}
?>

<div class="pagetitle">
  <h1>Contact Messages</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard">Home (<?=$role; ?>)</a></li>
      <li class="breadcrumb-item active">Contact Messages</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    
    <!-- Contact Messages Display -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            <i class="bi bi-envelope-open me-2"></i>Customer Messages
            <span class="badge bg-primary ms-2"><?= count($messages) ?> Messages</span>
          </h5>
          
          <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
              <i class="bi bi-exclamation-triangle me-2"></i>
              <?= $error_message ?>
            </div>
          <?php elseif (empty($messages)): ?>
            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              No messages found. Customer messages from the website will appear here.
            </div>
          <?php else: ?>
            <div class="row">
              <?php foreach ($messages as $msg): ?>
              <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 border-start border-primary border-3">
                  <div class="card-header bg-light">
                    <h6 class="mb-0 text-primary"><?= htmlspecialchars($msg['subject']) ?></h6>
                    <small class="text-muted">
                      <?= date('M d, Y - h:i A', strtotime($msg['created_at'])) ?>
                    </small>
                  </div>
                  <div class="card-body">
                    <p class="mb-2">
                      <strong>From:</strong> <?= htmlspecialchars($msg['full_name']) ?><br>
                      <strong>Email:</strong> 
                      <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" class="text-decoration-none">
                        <?= htmlspecialchars($msg['email']) ?>
                      </a>
                    </p>
                    <div class="message-content">
                      <p class="text-muted mb-0">
                        <?= nl2br(htmlspecialchars($msg['message'])) ?>
                      </p>
                    </div>
                  </div>
                  <div class="card-footer bg-light">
                    <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re: <?= urlencode($msg['subject']) ?>" 
                       class="btn btn-sm btn-primary">
                      <i class="bi bi-reply me-1"></i>Reply
                    </a>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          
          <div class="mt-3">
            <div class="alert alert-light">
              <i class="bi bi-info-circle me-2"></i>
              <strong>Note:</strong> These are messages from customers submitted through the website contact form. 
              Click "Reply" to respond via email.
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</section>
</main>

<!-- Footer -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span>Adis Abeba Real Estate Management System</span></strong>. All rights reserved.
  </div>
  <div class="credits">
    Powered By <a href="https://t.me/zolaoff/">IT Students</a>
  </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/assets/js/main.js"></script>

</body>
</html>