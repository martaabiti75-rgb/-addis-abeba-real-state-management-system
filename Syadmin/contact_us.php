<?php 
session_start();
if (!isset($_SESSION['sessionID'])) {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
}

require __DIR__.'/performAdminAction.php';
$isPerformAdminOBJ = new isPerformAdminAction();
require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
$CommonOBJ = new CommonFunction();

// Initialize variables
$contactHandler = null;
$contactMessages = [];
$unreadCount = 0;
$dbError = false;

// Try to load ContactMessageHandler
try {
    require_once __DIR__.'/../CommonFunction/ContactMessageHandler.php';
    $contactHandler = new ContactMessageHandler();
    
    // Get contact messages
    $contactMessages = $contactHandler->getAllContactMessages();
    $unreadCount = $contactHandler->getUnreadCount();
} catch (Exception $e) {
    $dbError = true;
    error_log("Contact handler error: " . $e->getMessage());
}

$dataQ = $isPerformAdminOBJ->getSessionUser($_SESSION['sessionID']);
foreach ($dataQ as $value) {
    $fullname = $value['fullname'];
    $role = $value['role'];
    $AccountState = $value['account_status'];
    $url = $value['profile_picture_url'];
    $lastlogintime = $value['last_login_time'];
}

// Handle actions
$message = '';
if ($_POST && $contactHandler) {
    if (isset($_POST['mark_read'])) {
        $id = intval($_POST['message_id']);
        if ($contactHandler->markAsRead($id)) {
            $message = '<div class="alert alert-success">Message marked as read.</div>';
            // Refresh data
            $contactMessages = $contactHandler->getAllContactMessages();
            $unreadCount = $contactHandler->getUnreadCount();
        }
    }
    
    if (isset($_POST['delete_message'])) {
        $id = intval($_POST['message_id']);
        if ($contactHandler->deleteMessage($id)) {
            $message = '<div class="alert alert-success">Message deleted successfully.</div>';
            // Refresh data
            $contactMessages = $contactHandler->getAllContactMessages();
            $unreadCount = $contactHandler->getUnreadCount();
        }
    }
    
    if (isset($_POST['send_message'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $user_message = htmlspecialchars($_POST['message']);
        
        if ($contactHandler->saveContactMessage($name, $email, $subject, $user_message)) {
            $message = '<div class="alert alert-success">Message sent successfully!</div>';
            // Refresh data
            $contactMessages = $contactHandler->getAllContactMessages();
            $unreadCount = $contactHandler->getUnreadCount();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Contact Us - Adis Abeba Real Estate Management System</title>

<!-- Favicons -->
<link href="../assets/img/aacitylogo.jpg" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="../dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/simple-datatables/style.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="../dashboard/assets/css/style.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
  body { font-family: 'Open Sans', sans-serif; background-color: #f7f8f9; color: #343a40; }
  .header { background-color: #004aad; color: #fff; }
  #sidebar { background-color: #1a1f36; }
  #sidebar .nav-link { color: #5998aa; }
  #sidebar .nav-link.active { background-color: #004aad; font-weight: bold; }
  .card { border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border: none; margin-bottom: 20px; }
  .contact-info { background: linear-gradient(135deg, #004aad 0%, #0066cc 100%); color: white; border-radius: 12px; padding: 30px; }
  .contact-form { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
  .form-control { border-radius: 8px; border: 2px solid #e9ecef; padding: 12px 15px; transition: all 0.3s; }
  .form-control:focus { border-color: #004aad; box-shadow: 0 0 0 0.2rem rgba(0, 74, 173, 0.25); }
  .btn-primary { background-color: #004aad; border-color: #004aad; border-radius: 8px; padding: 12px 30px; font-weight: 600; }
  .btn-primary:hover { background-color: #003d91; border-color: #003d91; }
  .contact-item { margin-bottom: 25px; }
  .contact-item i { font-size: 24px; margin-right: 15px; color: #ffd700; }
  .contact-item h5 { margin-bottom: 5px; font-weight: 600; }
  .contact-item p { margin: 0; opacity: 0.9; }
</style>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between w-100">
    <a href="dashboard" class="logo d-flex align-items-center">
      <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80px; max-width: 60px;">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <?php include __DIR__.'/profileModal.php'; ?>
      </ul>
    </nav>
  </div>
</header>

<!-- ======= Sidebar ======= -->
<?php require __DIR__.'/Component/Asidebar.php'; ?>

<main id="main" class="main">
<?php require __DIR__.'/Component/Logoutmodal.php'; ?>

<div class="pagetitle">
  <h1>Contact Us</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
      <li class="breadcrumb-item active">Contact Us</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    
    <!-- Map Section -->
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Our Location</h5>
          <div class="map-wrapper">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.6177618843845!2d38.76073631478236!3d9.005401993528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85cef5ab402d%3A0x8467b6b037a24d49!2sArat%20Kilo%2C%20Addis%20Ababa%2C%20Ethiopia!5e0!3m2!1sen!2s!4v1704067200000!5m2!1sen!2s" 
              width="100%" 
              height="300" 
              style="border:0; border-radius: 8px;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
  <!-- Messages from Public Contact Form -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            Received Messages 
            <?php if (!$dbError && $unreadCount > 0): ?>
              <span class="badge bg-danger"><?= $unreadCount ?> New</span>
            <?php endif; ?>
          </h5>
          
          <?php echo $message; ?>
          
          <?php if ($dbError): ?>
            <div class="alert alert-warning">
              <i class="bi bi-exclamation-triangle me-2"></i>
              <strong>Database Connection Issue:</strong> Unable to load contact messages. 
              <br>Please make sure the database is running and the contact_messages table exists.
              <br><a href="../setup_contact_table.php" target="_blank" class="btn btn-sm btn-primary mt-2">
                <i class="bi bi-tools me-1"></i>Setup Database Table
              </a>
            </div>
          <?php elseif (empty($contactMessages)): ?>
            <div class="alert alert-info">
              <i class="bi bi-info-circle me-2"></i>
              No messages received yet.
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($contactMessages as $msg): ?>
                    <tr class="<?= $msg['status'] == 'unread' ? 'table-warning' : '' ?>">
                      <td><?= date('M d, Y H:i', strtotime($msg['created_at'])) ?></td>
                      <td><?= htmlspecialchars($msg['name']) ?></td>
                      <td><?= htmlspecialchars($msg['email']) ?></td>
                      <td><?= htmlspecialchars($msg['subject']) ?></td>
                      <td>
                        <?php if ($msg['status'] == 'unread'): ?>
                          <span class="badge bg-warning">Unread</span>
                        <?php else: ?>
                          <span class="badge bg-success">Read</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal<?= $msg['id'] ?>">
                          <i class="bi bi-eye"></i> View
                        </button>
                        <?php if ($msg['status'] == 'unread'): ?>
                          <form method="POST" class="d-inline">
                            <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                            <button type="submit" name="mark_read" class="btn btn-sm btn-success">
                              <i class="bi bi-check"></i> Mark Read
                            </button>
                          </form>
                        <?php endif; ?>
                        <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                          <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                          <button type="submit" name="delete_message" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                    
                    <!-- Message Modal -->
                    <div class="modal fade" id="messageModal<?= $msg['id'] ?>" tabindex="-1">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Message from <?= htmlspecialchars($msg['name']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <div class="row mb-3">
                              <div class="col-md-6">
                                <strong>From:</strong> <?= htmlspecialchars($msg['name']) ?>
                              </div>
                              <div class="col-md-6">
                                <strong>Email:</strong> <?= htmlspecialchars($msg['email']) ?>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <div class="col-md-6">
                                <strong>Date:</strong> <?= date('M d, Y H:i', strtotime($msg['created_at'])) ?>
                              </div>
                              <div class="col-md-6">
                                <strong>Status:</strong> 
                                <span class="badge bg-<?= $msg['status'] == 'unread' ? 'warning' : 'success' ?>">
                                  <?= ucfirst($msg['status']) ?>
                                </span>
                              </div>
                            </div>
                            <div class="mb-3">
                              <strong>Subject:</strong> <?= htmlspecialchars($msg['subject']) ?>
                            </div>
                            <div class="mb-3">
                              <strong>Message:</strong>
                              <div class="border p-3 rounded bg-light">
                                <?= nl2br(htmlspecialchars($msg['message'])) ?>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re: <?= htmlspecialchars($msg['subject']) ?>" class="btn btn-primary">
                              <i class="bi bi-reply"></i> Reply via Email
                            </a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    
    <!-- Contact Information -->
    <div class="col-lg-4">
      <div class="contact-info">
        <h3 class="mb-4">Get in Touch</h3>
        
        <div class="contact-item">
          <i class="bi bi-geo-alt-fill"></i>
          <div>
            <h5>Address</h5>
            <p>Addis Ababa, Ethiopia<br>
            Real Estate Management Office</p>
          </div>
        </div>
        
        <div class="contact-item">
          <i class="bi bi-telephone-fill"></i>
          <div>
            <h5>Phone</h5>
            <p>+251 11 123 4567<br>
            +251 91 234 5678</p>
          </div>
        </div>
        
        <div class="contact-item">
          <i class="bi bi-envelope-fill"></i>
          <div>
            <h5>Email</h5>
            <p>info@aarealestate.com<br>
            support@aarealestate.com</p>
          </div>
        </div>
        
        <div class="contact-item">
          <i class="bi bi-clock-fill"></i>
          <div>
            <h5>Office Hours</h5>
            <p>Monday - Friday: 8:00 AM - 6:00 PM<br>
            Saturday: 9:00 AM - 4:00 PM</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Contact Form -->
    <div class="col-lg-8">
      <div class="contact-form">
        <h3 class="mb-4">Send us a Message</h3>
        
        <?php echo $message; ?>
        
        <form method="POST" action="">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Full Name *</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email Address *</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="subject" class="form-label">Subject *</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
          </div>
          
          <div class="mb-3">
            <label for="message" class="form-label">Message *</label>
            <textarea class="form-control" id="message" name="message" rows="6" required placeholder="Please describe your inquiry or feedback..."></textarea>
          </div>
          
          <button type="submit" name="send_message" class="btn btn-primary">
            <i class="bi bi-send-fill me-2"></i>Send Message
          </button>
        </form>
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

<!-- Back to Top -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../dashboard/assets/vendor/quill/quill.min.js"></script>
<script src="../dashboard/assets/js/main.js"></script>

</body>
</html>