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

  // Handle actions
  $message = '';
  if ($_POST) {
      if (isset($_POST['mark_read'])) {
          $id = $_POST['message_id'];
          if ($contactHandler->markAsRead($id)) {
              $message = '<div class="alert alert-success">Message marked as read successfully!</div>';
          }
      }
      
      if (isset($_POST['delete_message'])) {
          $id = $_POST['message_id'];
          if ($contactHandler->deleteMessage($id)) {
              $message = '<div class="alert alert-success">Message deleted successfully!</div>';
          }
      }
  }

  // Get all contact messages
  $contactMessages = $contactHandler->getAllContactMessages();
  $unreadCount = $contactHandler->getUnreadCount();
  
  // Add comment count to each message
  foreach ($contactMessages as &$msg) {
      $msg['comment_count'] = count($contactHandler->getMessageComments($msg['id']));
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contact Messages - Adis Abeba Real Estate Management System</title>
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
    .message-card {
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }
    
    .message-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .message-card.unread {
      border-left: 4px solid #007bff;
      background: linear-gradient(135deg, rgba(0,123,255,0.05), rgba(0,123,255,0.02));
    }
    
    .message-card.read {
      border-left: 4px solid #28a745;
      background: #fff;
    }
    
    .message-card.replied {
      border-left: 4px solid #17a2b8;
      background: linear-gradient(135deg, rgba(23,162,184,0.05), rgba(23,162,184,0.02));
    }
    
    .status-badge {
      font-size: 0.75rem;
      padding: 4px 8px;
      border-radius: 12px;
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
      <h1>Contact Messages</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home (<?=$role; ?>)</a></li>
          <li class="breadcrumb-item active">Contact Messages</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <?php echo $message; ?>
          
          <!-- Statistics -->
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="text-primary"><?= count($contactMessages) ?></h3>
                  <p class="mb-0">Total Messages</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="text-warning"><?= $unreadCount ?></h3>
                  <p class="mb-0">Unread Messages</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="text-success"><?= count($contactMessages) - $unreadCount ?></h3>
                  <p class="mb-0">Read Messages</p>
                </div>
              </div>
            </div>
          </div>
          
          <?php if (empty($contactMessages)): ?>
            <div class="card">
              <div class="card-body text-center py-5">
                <i class="bi bi-envelope" style="font-size: 4rem; color: #6c757d;"></i>
                <h4 class="mt-3">No Messages Yet</h4>
                <p class="text-muted">When customers send messages through the contact form, they will appear here.</p>
              </div>
            </div>
          <?php else: ?>
            
            <?php foreach ($contactMessages as $msg): ?>
              <div class="card message-card <?= $msg['status'] ?>">
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <h5 class="mb-1"><?= htmlspecialchars($msg['subject']) ?></h5>
                      <small class="text-muted">
                        From: <strong><?= htmlspecialchars($msg['name']) ?></strong> 
                        (<?= htmlspecialchars($msg['email']) ?>)
                      </small>
                    </div>
                    <div class="col-md-4 text-end">
                      <span class="badge status-badge status-<?= $msg['status'] ?>">
                        <?= ucfirst($msg['status']) ?>
                      </span>
                      <?php if ($msg['comment_count'] > 0): ?>
                        <span class="badge bg-info ms-1">
                          <i class="bi bi-chat-dots"></i> <?= $msg['comment_count'] ?>
                        </span>
                      <?php endif; ?>
                      <br>
                      <small class="text-muted">
                        <?= date('M j, Y g:i A', strtotime($msg['created_at'])) ?>
                      </small>
                    </div>
                  </div>
                </div>
                
                <div class="card-body">
                  <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                </div>
                
                <div class="card-footer">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <a href="message_detail.php?id=<?= $msg['id'] ?>" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i> View Details
                      </a>
                      
                      <?php if ($msg['status'] == 'unread'): ?>
                        <form method="POST" style="display: inline;">
                          <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                          <button type="submit" name="mark_read" class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle"></i> Mark as Read
                          </button>
                        </form>
                      <?php endif; ?>
                      
                      <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re: <?= htmlspecialchars($msg['subject']) ?>" 
                         class="btn btn-primary btn-sm">
                        <i class="bi bi-reply"></i> Reply via Email
                      </a>
                    </div>
                    
                    <div class="col-md-4 text-end">
                      <form method="POST" style="display: inline;" 
                            onsubmit="return confirm('Are you sure you want to delete this message?')">
                        <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
                        <button type="submit" name="delete_message" class="btn btn-danger btn-sm">
                          <i class="bi bi-trash"></i> Delete
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            
          <?php endif; ?>
          
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
  <script src="../dashboard/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dashboard/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../dashboard/assets/vendor/quill/quill.min.js"></script>
  <script src="../dashboard/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../dashboard/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../dashboard/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../dashboard/assets/js/main.js"></script>

</body>

</html>