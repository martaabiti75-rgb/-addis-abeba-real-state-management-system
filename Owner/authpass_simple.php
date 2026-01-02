<?php 
session_start();
if (isset($_SESSION['sessionID'])) {
    // code...
} else {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
}

require __DIR__.'/performOwnerAction.php';
$isPerformOwnerOBJ = new isPerformOwnerAction();
require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
$CommonOBJ = new CommonFunction();

$dataQ = $isPerformOwnerOBJ->getSessionUser($_SESSION['sessionID']);
$rowQ = $isPerformOwnerOBJ->getSessionUser($_SESSION['sessionID']);
foreach ($dataQ as $key => $value) {
    $fullname = $value['fullname'];
    $role = $value['role'];
    $AccountState = $value['account_status'];
    $url = $value['profile_picture_url'];
    $lastlogintime = $value['last_login_time'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Change Password - Real Estate Management</title>
  
  <!-- Favicons -->
  <link href="../assets/img/aacitylogo.jpg" rel="icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="../dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="../dashboard/assets/css/style.css" rel="stylesheet">
  
  <style>
    body { 
      font-family: 'Poppins', sans-serif; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    
    .card { 
      border-radius: 15px; 
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      border: none;
      margin-top: 50px;
    }
    
    .card-title {
      color: #059669;
      font-weight: 600;
    }
    
    .form-control {
      border-radius: 10px;
      border: 2px solid #e2e8f0;
      padding: 12px 15px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #10b981;
      box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15);
    }
    
    .input-group-text {
      background: #10b981;
      border: 2px solid #10b981;
      color: white;
      border-radius: 10px 0 0 10px;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: none;
      border-radius: 10px;
      padding: 12px 30px;
      font-weight: 600;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }
    
    .text-danger {
      font-size: 0.875rem;
      margin-top: 5px;
    }
    
    .text-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white !important;
      padding: 10px 15px;
      border-radius: 8px;
      font-weight: 500;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 60px; max-width: 50px;">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
  </header>

  <!-- Sidebar -->
  <?php require __DIR__.'/Component/Asidebar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1 style="color: white;">Change Password</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home (<?=$role; ?>)</a></li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Change Password</h5>
              
              <?php
              if (isset($_GET['error'])) {
                  echo '<div class="alert alert-danger">' . $_GET['error'] . '</div>';
              }
              
              // Handle form submission
              if (isset($_POST['changePasswordBtn'])) {
                  $result = $CommonOBJ->changePassword();
                  if (strpos($result, 'Success') !== false) {
                      echo '<div class="alert alert-success">' . $result . '</div>';
                  } else {
                      echo '<div class="alert alert-danger">' . $result . '</div>';
                  }
              }
              ?>
              
              <form method="post" action="" id="passwordForm">
                <div class="mb-3">
                  <label for="email" class="form-label">Email *</label>
                  <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input type="email" name="email" class="form-control" id="email" 
                           value="<?=$_SESSION['sessionID']; ?>" readonly>
                  </div>
                </div>
                
                <div class="mb-3">
                  <label for="oldPassword" class="form-label">Current Password *</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-eye-slash" id="toggleOld"></i>
                    </span>
                    <input type="password" name="oldPassword" class="form-control" id="oldPassword" required>
                  </div>
                  <div class="text-danger" id="oldPasswordError"></div>
                </div>
                
                <div class="mb-3">
                  <label for="newPassword" class="form-label">New Password *</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-eye-slash" id="toggleNew"></i>
                    </span>
                    <input type="password" name="newPassword" class="form-control" id="newPassword" required>
                  </div>
                  <div class="text-danger" id="newPasswordError"></div>
                </div>
                
                <div class="mb-3">
                  <label for="conPassword" class="form-label">Confirm Password *</label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="bi bi-eye-slash" id="toggleConfirm"></i>
                    </span>
                    <input type="password" name="conPassword" class="form-control" id="conPassword" required>
                  </div>
                  <div class="text-danger" id="conPasswordError"></div>
                </div>
                
                <div class="d-grid">
                  <button type="submit" name="changePasswordBtn" class="btn btn-primary" id="submitBtn">
                    Change Password
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Real Estate Management System</span></strong>. All rights reserved.
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dashboard/assets/js/main.js"></script>
  <script src="../dashboard/assets/ajax/jquery-2.2.4.min.js"></script>

  <script>
  $(document).ready(function() {
    
    // Toggle password visibility
    $('#toggleOld').click(function() {
      togglePassword('#oldPassword', this);
    });
    
    $('#toggleNew').click(function() {
      togglePassword('#newPassword', this);
    });
    
    $('#toggleConfirm').click(function() {
      togglePassword('#conPassword', this);
    });
    
    function togglePassword(inputId, icon) {
      const input = $(inputId);
      const type = input.attr('type') === 'password' ? 'text' : 'password';
      input.attr('type', type);
      
      if (type === 'text') {
        $(icon).removeClass('bi-eye-slash').addClass('bi-eye');
      } else {
        $(icon).removeClass('bi-eye').addClass('bi-eye-slash');
      }
    }
    
    // Form validation
    $('#passwordForm').on('submit', function(e) {
      let isValid = true;
      
      // Clear previous errors
      $('.text-danger').text('');
      $('.form-control').removeClass('is-invalid');
      
      // Validate old password
      if ($('#oldPassword').val().trim() === '') {
        $('#oldPasswordError').text('Current password is required');
        $('#oldPassword').addClass('is-invalid');
        isValid = false;
      }
      
      // Validate new password
      const newPassword = $('#newPassword').val();
      if (newPassword.trim() === '') {
        $('#newPasswordError').text('New password is required');
        $('#newPassword').addClass('is-invalid');
        isValid = false;
      } else if (newPassword.length < 6) {
        $('#newPasswordError').text('Password must be at least 6 characters');
        $('#newPassword').addClass('is-invalid');
        isValid = false;
      }
      
      // Validate confirm password
      const confirmPassword = $('#conPassword').val();
      if (confirmPassword.trim() === '') {
        $('#conPasswordError').text('Please confirm your password');
        $('#conPassword').addClass('is-invalid');
        isValid = false;
      } else if (newPassword !== confirmPassword) {
        $('#conPasswordError').text('Passwords do not match');
        $('#conPassword').addClass('is-invalid');
        isValid = false;
      }
      
      // Check if new password is different from old
      if (newPassword === $('#oldPassword').val() && newPassword !== '') {
        $('#newPasswordError').text('New password must be different from current password');
        $('#newPassword').addClass('is-invalid');
        isValid = false;
      }
      
      if (!isValid) {
        e.preventDefault();
        return false;
      }
      
      // Show loading state
      $('#submitBtn').prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Changing Password...');
    });
    
    // Real-time validation
    $('#newPassword, #conPassword').on('input', function() {
      const newPassword = $('#newPassword').val();
      const confirmPassword = $('#conPassword').val();
      
      if (newPassword && confirmPassword && newPassword !== confirmPassword) {
        $('#conPasswordError').text('Passwords do not match');
        $('#conPassword').addClass('is-invalid');
      } else {
        $('#conPasswordError').text('');
        $('#conPassword').removeClass('is-invalid');
      }
    });
    
  });
  </script>

</body>
</html>