<?php 

  session_start();
  if (isset($_SESSION['sessionID'])) {
    // code...
  }else{
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
  }

  require __DIR__.'/performMgAction.php';
  $isPerformMgOBJ = new isPerformMgAction();
  require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
  $CommonOBJ = new CommonFunction();

  $dataQ = $isPerformMgOBJ->getSessionUser($_SESSION['sessionID']);
  $rowQ = $isPerformMgOBJ->getSessionUser($_SESSION['sessionID']);
      foreach ($dataQ as $key => $value) {
        // code...
        $fullname = $value['fullname'];
        $role = $value['role'];
        $AccountState = $value['account_status'];
        $url = $value['profile_picture_url'];
        $lastlogintime = $value['last_login_time'];
      }

  // Include contact handler
  require __DIR__.'/../CommonFunction/ContactMessageHandler.php';
  $contactHandler = new ContactMessageHandler();

  // Get message ID from URL
  $messageId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  
  if (!$messageId) {
      echo "<script>window.location='contact_messages.php';</script>";
      exit;
  }

  // Handle comment submission
  $message = '';
  if ($_POST && isset($_POST['add_comment'])) {
      $comment = trim($_POST['comment']);
      if (!empty($comment)) {
          if ($contactHandler->addComment($messageId, $fullname, $comment)) {
              $message = '<div class="alert alert-success">Comment added successfully!</div>';
              // Mark as read when commenting
              $contactHandler->markAsRead($messageId);
          } else {
              $message = '<div class="alert alert-danger">Error adding comment. Please try again.</div>';
          }
      } else {
          $message = '<div class="alert alert-warning">Please enter a comment before submitting.</div>';
      }
  }

  // Get message with comments
  $messageData = $contactHandler->getMessageWithComments($messageId);
  
  if (!$messageData) {
      echo "<script>window.location='contact_messages.php';</script>";
      exit;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Message Detail - Adis Abeba Real Estate Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Organization Favicons -->
  <link href="../assets/img/aacitylogo.jpg" rel="icon">
  <link href="../dashboard/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
  <link href="../dashboard/assets/css/logo.css" rel="stylesheet">

  <style>
    .message-detail-card {
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    
    .message-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 15px 15px 0 0;
      padding: 25px;
    }
    
    .message-body {
      padding: 30px;
      background: #fff;
    }
    
    .comment-section {
      background: #f8f9fa;
      border-radius: 0 0 15px 15px;
      padding: 25px;
    }
    
    .comment-item {
      background: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      border-left: 4px solid #007bff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .comment-form {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .status-badge {
      font-size: 0.9rem;
      padding: 8px 15px;
      border-radius: 20px;
      font-weight: 600;
    }
    
    .status-unread {
      background: #007bff;
      color: white;
    }
    
    .status-read {
      background: #28a745;
      color: white;
    }
    
    .status-replied {
      background: #17a2b8;
      color: white;
    }
    
    .customer-info {
      background: linear-gradient(135deg, rgba(0,123,255,0.1), rgba(0,123,255,0.05));
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }
    
    .action-buttons {
      margin-top: 20px;
    }
    
    .btn-action {
      margin-right: 10px;
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 500;
    }
    
    .comment-meta {
      font-size: 0.85rem;
      color: #6c757d;
      margin-bottom: 10px;
    }
    
    .original-message {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
      border-radius: 10px;
      padding: 20px;
      border-left: 4px solid #667eea;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center">
        <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80PX; max-width: 60px;">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <?php include __DIR__.'/profileModal.php';  ?>
      </ul>
    </nav>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php 
    require __DIR__.'/Component/Asidebar.php';
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">
<?php 
    require __DIR__.'/Component/Logoutmodal.php';
?>
    <div class="pagetitle">
      <h1>Message Detail</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home (<?=$role; ?>)</a></li>
          <li class="breadcrumb-item"><a href="contact_messages">Contact Messages</a></li>
          <li class="breadcrumb-item active">Message Detail</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <?php echo $message; ?>
          
          <!-- Back Button -->
          <div class="mb-3">
            <a href="contact_messages.php" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Back to Messages
            </a>
          </div>
          
          <!-- Message Detail Card -->
          <div class="card message-detail-card">
            
            <!-- Message Header -->
            <div class="message-header">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <h3 class="mb-2"><?= htmlspecialchars($messageData['subject']) ?></h3>
                  <p class="mb-0 opacity-75">
                    <i class="bi bi-calendar"></i> 
                    Received: <?= date('F j, Y \a\t g:i A', strtotime($messageData['created_at'])) ?>
                  </p>
                </div>
                <div class="col-md-4 text-end">
                  <span class="status-badge status-<?= $messageData['status'] ?>">
                    <i class="bi bi-circle-fill me-1"></i>
                    <?= ucfirst($messageData['status']) ?>
                  </span>
                </div>
              </div>
            </div>
            
            <!-- Message Body -->
            <div class="message-body">
              
              <!-- Customer Information -->
              <div class="customer-info">
                <h5><i class="bi bi-person-circle"></i> Customer Information</h5>
                <div class="row">
                  <div class="col-md-6">
                    <strong>Name:</strong> <?= htmlspecialchars($messageData['name']) ?>
                  </div>
                  <div class="col-md-6">
                    <strong>Email:</strong> 
                    <a href="mailto:<?= htmlspecialchars($messageData['email']) ?>">
                      <?= htmlspecialchars($messageData['email']) ?>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Original Message -->
              <div class="original-message">
                <h5><i class="bi bi-envelope"></i> Original Message</h5>
                <p class="mb-0"><?= nl2br(htmlspecialchars($messageData['message'])) ?></p>
              </div>
              
              <!-- Action Buttons -->
              <div class="action-buttons">
                <a href="mailto:<?= htmlspecialchars($messageData['email']) ?>?subject=Re: <?= htmlspecialchars($messageData['subject']) ?>&body=Dear <?= htmlspecialchars($messageData['name']) ?>,%0D%0A%0D%0AThank you for contacting us.%0D%0A%0D%0ABest regards,%0D%0A<?= htmlspecialchars($fullname) ?>%0D%0AAdis Abeba Real Estate" 
                   class="btn btn-primary btn-action">
                  <i class="bi bi-reply"></i> Reply via Email
                </a>
                
                <button type="button" class="btn btn-info btn-action" onclick="window.print()">
                  <i class="bi bi-printer"></i> Print Message
                </button>
                
                <a href="contact_messages.php" class="btn btn-success btn-action">
                  <i class="bi bi-list"></i> View All Messages
                </a>
              </div>
              
            </div>
            
            <!-- Comments Section -->
            <div class="comment-section">
              <h5><i class="bi bi-chat-dots"></i> Manager Comments & Notes</h5>
              
              <!-- Existing Comments -->
              <?php if (!empty($messageData['comments'])): ?>
                <div class="mb-4">
                  <?php foreach ($messageData['comments'] as $comment): ?>
                    <div class="comment-item">
                      <div class="comment-meta">
                        <strong><?= htmlspecialchars($comment['manager_name']) ?></strong>
                        <span class="text-muted">
                          • <?= date('M j, Y \a\t g:i A', strtotime($comment['created_at'])) ?>
                        </span>
                      </div>
                      <p class="mb-0"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p class="text-muted mb-4">No comments yet. Add the first comment below.</p>
              <?php endif; ?>
              
              <!-- Add Comment Form -->
              <div class="comment-form">
                <h6><i class="bi bi-plus-circle"></i> Add New Comment</h6>
                <form method="POST">
                  <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment/Note:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" 
                              placeholder="Add your comment, notes, or follow-up actions here..." required></textarea>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                      <i class="bi bi-info-circle"></i> 
                      This comment will be saved as a note from <?= htmlspecialchars($fullname) ?>
                    </small>
                    <button type="submit" name="add_comment" class="btn btn-primary">
                      <i class="bi bi-send"></i> Add Comment
                    </button>
                  </div>
                </form>
              </div>
              
            </div>
            
          </div>
          
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="margin-top: 50px;">
    <div class="copyright">
      &copy; Copyright <strong><span>Adis Abeba Real Estate Management System</span></strong>. All right reserved.
    </div>
    <div class="credits">
      Powered By <a href="https://t.me/zolaoff/">It Students</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dashboard/assets/js/main.js"></script>

  <script>
    // Auto-resize textarea
    document.getElementById('comment').addEventListener('input', function() {
      this.style.height = 'auto';
      this.style.height = (this.scrollHeight) + 'px';
    });
    
    // Confirmation for form submission
    document.querySelector('form').addEventListener('submit', function(e) {
      const comment = document.getElementById('comment').value.trim();
      if (comment.length < 5) {
        e.preventDefault();
        alert('Please enter a meaningful comment (at least 5 characters).');
        return false;
      }
    });
  </script>

</body>

</html>