<?php 
session_start();
if (!isset($_SESSION['sessionID'])) {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
    exit();
}

require __DIR__.'/performAdminAction.php';
$isPerformAdminOBJ = new isPerformAdminAction();
require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
$CommonOBJ = new CommonFunction();

// Get current user data
$dataQ = $isPerformAdminOBJ->getSessionUser($_SESSION['sessionID']);
foreach ($dataQ as $value) {
    $fullname = $value['fullname'];
    $role = $value['role'];
    $AccountState = $value['account_status'];
    $url = $value['profile_picture_url'];
    $lastlogintime = $value['last_login_time'];
}

// Check if edit parameter exists
if(!isset($_GET['e']) || empty($_GET['e'])){
    echo "<script>window.location='dashboard?error=Invalid request';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Adis Abeba Real Estate Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Organization Favicons -->
  <link href="../assets/img/Honda.Jpg" rel="icon">
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
  
  <!-- Advanced Custom CSS -->
  <style>
    /* Base Styles */
    body { 
      font-family: 'Poppins', sans-serif; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #2c3e50;
      min-height: 100vh;
      position: relative;
    }
    
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.05"/><circle cx="50" cy="10" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="10" cy="60" r="1" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
      pointer-events: none;
      z-index: -1;
    }

    /* Header Styles */
    .header { 
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: #ffffff;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .header .logo img { 
      border-radius: 50%; 
      transition: transform 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .header .logo img:hover {
      transform: scale(1.05);
    }

    /* Sidebar Styles */
    #sidebar { 
      background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
      box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
    }
    
    #sidebar .nav-link { 
      color: #475569;
      transition: all 0.3s ease;
      border-radius: 8px;
      margin: 2px 8px;
      position: relative;
      overflow: hidden;
    }
    
    #sidebar .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
      transition: left 0.5s ease;
    }
    
    #sidebar .nav-link:hover::before {
      left: 100%;
    }
    
    #sidebar .nav-link:hover {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      color: #ffffff;
      transform: translateX(5px);
    }
    
    #sidebar .nav-link.active { 
      background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
      color: #ffffff;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
    }

    /* Main Card Styles */
    .card { 
      border-radius: 25px; 
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
      border: none;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
      position: relative;
      overflow: hidden;
      transition: all 0.4s ease;
      margin-top: 20px;
    }
    
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #3b82f6, #8b5cf6, #06b6d4, #10b981);
    }
    
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 35px 70px rgba(0, 0, 0, 0.2);
    }

    /* Card Body */
    .card-body {
      padding: 40px;
      position: relative;
      z-index: 2;
    }

    /* Card Title */
    .card-title {
      font-weight: 700;
      color: #1e40af;
      font-size: 1.75rem;
      margin-bottom: 2rem;
      text-align: center;
      position: relative;
    }
    
    .card-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #3b82f6, #8b5cf6);
      border-radius: 2px;
    }

    /* Form Styles */
    .form-control {
      border-radius: 15px;
      border: 2px solid #e2e8f0;
      padding: 15px 20px;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease;
      background: rgba(248, 250, 252, 0.8);
      backdrop-filter: blur(5px);
    }
    
    .form-control:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
      outline: none;
      background: rgba(255, 255, 255, 0.9);
      transform: translateY(-2px);
    }
    
    .form-control:hover {
      border-color: #60a5fa;
      background: rgba(255, 255, 255, 0.9);
    }

    /* Form Select */
    .form-select {
      border-radius: 15px;
      border: 2px solid #e2e8f0;
      padding: 15px 20px;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease;
      background: rgba(248, 250, 252, 0.8);
      backdrop-filter: blur(5px);
    }
    
    .form-select:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
      outline: none;
      background: rgba(255, 255, 255, 0.9);
      transform: translateY(-2px);
    }

    /* Input Group */
    .input-group-text {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      border: 2px solid #3b82f6;
      color: #ffffff;
      border-radius: 15px 0 0 15px;
      font-weight: 600;
      transition: all 0.3s ease;
      padding: 15px 20px;
    }
    
    .input-group .form-control {
      border-left: none;
      border-radius: 0 15px 15px 0;
    }
    
    .input-group .form-select {
      border-left: none;
      border-radius: 0 15px 15px 0;
    }

    /* Password Toggle */
    .show {
      background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
      border: 2px solid #6b7280;
      color: #ffffff;
      border-radius: 15px 0 0 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      padding: 15px 20px;
    }
    
    .show:hover {
      background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
      transform: scale(1.05);
    }
    
    .bi-eye, .bi-eye-slash {
      font-size: 18px;
      transition: all 0.3s ease;
    }

    /* Labels */
    .col-form-label-sm {
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
      font-size: 0.95rem;
    }

    /* Button Styles */
    .btn-primary {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      border: none;
      border-radius: 15px;
      padding: 15px 30px;
      font-weight: 700;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    
    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }
    
    .btn-primary:hover::before {
      left: 100%;
    }
    
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
      background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    }
    
    .btn-primary:active {
      transform: translateY(-1px);
    }

    /* Error Messages */
    .spanError {
      font-size: 0.875rem;
      font-weight: 500;
      margin-top: 5px;
      display: block;
      animation: fadeInUp 0.3s ease-out;
    }
    
    .text-danger {
      color: #ef4444 !important;
    }
    
    .text-success {
      color: #10b981 !important;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #ffffff !important;
      padding: 12px 20px;
      border-radius: 12px;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
      animation: slideInDown 0.5s ease-out;
    }

    /* Error State for Inputs */
    .form-control[style*="border-color: red"], .form-select[style*="border-color: red"] {
      border-color: #ef4444 !important;
      box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.15) !important;
      animation: shake 0.5s ease-in-out;
    }

    /* Breadcrumb */
    .breadcrumb { 
      background: none; 
      padding: 0; 
      margin-bottom: 20px;
    }
    
    .breadcrumb-item a { 
      color: #1e40af;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
      color: #3b82f6;
      text-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }
    
    .breadcrumb-item.active { 
      color: #64748b;
      font-weight: 500;
    }

    /* Page Title */
    .pagetitle h1 {
      color: #ffffff;
      font-weight: 700;
      text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      margin-bottom: 10px;
      font-size: 2.5rem;
    }

    /* Footer */
    footer.footer { 
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      padding: 30px 0; 
      text-align: center; 
      border-top: 1px solid rgba(226, 232, 240, 0.1);
      font-size: 14px; 
      color: #94a3b8;
      margin-top: 50px;
    }
    
    footer.footer a { 
      color: #60a5fa; 
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    footer.footer a:hover { 
      color: #3b82f6;
      text-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }

    /* Back to Top */
    .back-to-top { 
      position: fixed; 
      right: 30px; 
      bottom: 30px; 
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      color: #fff; 
      width: 50px; 
      height: 50px; 
      border-radius: 50%; 
      text-align: center; 
      line-height: 50px; 
      font-size: 20px; 
      display: none; 
      z-index: 9999;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .back-to-top:hover { 
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    /* Animation Classes */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes shake {
      0%, 100% {
        transform: translateX(0);
      }
      10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
      }
      20%, 40%, 60%, 80% {
        transform: translateX(5px);
      }
    }
    
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
      }
      70% {
        box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
      }
    }
    
    .card {
      animation: fadeInUp 0.6s ease-out;
    }

    /* Form Group Spacing */
    .col-md-12 {
      margin-bottom: 1.5rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .card-body { 
        padding: 25px; 
      }
      
      .header .logo img { 
        max-width: 50px; 
        max-height: 50px; 
      }
      
      .pagetitle h1 {
        font-size: 2rem;
      }
      
      .card-title {
        font-size: 1.5rem;
      }
      
      .form-control, .form-select {
        padding: 12px 15px;
        font-size: 14px;
      }
      
      .input-group-text, .show {
        padding: 12px 15px;
      }
      
      .btn-primary {
        padding: 12px 25px;
        font-size: 1rem;
      }
    }

    /* Focus States */
    .form-control:focus + .spanError,
    .form-select:focus + .spanError {
      color: #3b82f6;
    }

    /* Loading State */
    .btn-primary:disabled {
      background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
      cursor: not-allowed;
      transform: none;
    }

    /* Success Animation */
    .errorALL:not(:empty) {
      animation: pulse 2s infinite;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center">
        <img src="../assets/img/dichaLogoCurrent1.jpg" alt="" style="max-height: 60PX; max-width: 60px;">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle" href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <?php include __DIR__.'/profileModal.php'; ?>
      </ul>
    </nav>
  </header>

  <!-- ======= Sidebar ======= -->
  <?php 
    require __DIR__.'/Component/Asidebar.php';
  ?>

  <main id="main" class="main">
    <?php require __DIR__.'/Component/Logoutmodal.php'; ?>
    
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home (<?=$role; ?>)</a></li>
          <li class="breadcrumb-item active">Last login date : <?= $lastlogintime; ?></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center pt-2">
          <div class="card">
            <div class="card-body">
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Edit User Form</h5>
              </div>
              
              <form class="row g-3 needs-validations" novalidate method="post" action="" id="forms">
                <?php
                if (isset($_GET['error'])) { ?>
                  <p class="text-center text-danger small fw-bold" id="displayblock"><?= $_GET['error']; ?></p>
                <?php } ?>
                
                <p class="text-center text-success spanError errorALL">
                  <?php 
                  if(isset($_POST['UpdateUserMethod'])) {
                    echo $isPerformAdminOBJ->UpdateUserMethod(); 
                  }
                  ?>
                </p>
                
                <?php 
                try {
                  $urlId = base64_decode($_GET['e']);
                  $getUserDataByEmail = $isPerformAdminOBJ->getUserByParam($urlId);
                  
                  if(empty($getUserDataByEmail)) {
                    echo "<script>window.location='dashboard?error=User not found';</script>";
                    exit();
                  }
                  
                  foreach ($getUserDataByEmail as $values) { 
                ?>
                <div class="col-md-12">
                  <label for="yourUsername" class="col-form-label-sm">Fullname *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" name="Fullname" class="form-control" id="name" value="<?= htmlspecialchars($values['fullname']); ?>" required>
                  </div>
                  <span class="text-danger spanError spanError-name"></span>
                </div>

                <div class="col-md-12">
                  <label for="yourUsername" class="col-form-label-sm">Email *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="email" name="Email" class="form-control" id="email-id" value="<?= htmlspecialchars($values['email']); ?>" required>
                    <input type="hidden" name="urlid" class="form-control" id="urlid" value="<?= htmlspecialchars($values['account_id']); ?>">
                  </div>
                  <span class="text-danger spanError spanError-1"></span>
                </div>

                <div class="col-md-12">
                  <label for="yourUsername" class="col-form-label-sm">Mobile Number *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" name="PhoneNumber" class="form-control" id="phone" value="<?= htmlspecialchars($values['phone_number'] ?? ''); ?>" required>
                  </div>
                  <span class="text-danger spanError spanError-phone"></span>
                </div>

                <div class="col-md-12">
                  <label for="yourUsername" class="col-form-label-sm">Role *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <select id="accountype" name="Role" class="form-select" required>
                      <option value="">Choose...</option>
                      <option value="System administrator" <?= ($values['role'] == 'System administrator') ? 'selected' : ''; ?>>System administrator</option>
                      <option value="Owner" <?= ($values['role'] == 'Owner') ? 'selected' : ''; ?>>Owner</option>
                    </select>
                  </div>
                  <span class="text-danger spanError spanError-accountype"></span>
                </div>

                <div class="col-md-12">
                  <label for="yourPassword" class="col-form-label-sm">Password (Leave blank to keep current password)</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text show">
                      <span class="bi bi-eye-slash innershow" id="togglePassword"></span>
                    </span>
                    <input type="password" name="Password" class="form-control pass-key" id="password" placeholder="Enter new password">
                  </div>
                  <span class="text-danger spanError spanError-2"></span>
                </div>

                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit" name="UpdateUserMethod" id="AddBtn">Update User</button>
                </div>
                <?php 
                  }
                } catch (Exception $e) {
                  echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
                }
                ?>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="margin-top: 150px;">
    <div class="copyright">
      &copy; Copyright <strong><span>Adis Abeba Real Estate Management System</span></strong>.All right reserved.
    </div>
    <div class="credits">
      Powered By <a href="https://t.me/zolaoff/">It Students</a>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

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
  <script src="../dashboard/assets/ajax/jquery.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function() {
      // Toggle password visibility
      $(".innershow").on('click', function(e) {
          e.preventDefault();
          $(this).toggleClass("bi-eye bi-eye-slash");
          var pass_field = $(".pass-key");
          pass_field.attr("type", pass_field.attr("type") === "password" ? "text" : "password");
      });

      // Inline validation on button click
      $("#AddBtn").on('click', function(event) {
          var name = $("#name").val().trim();
          var phone = $("#phone").val().trim();
          var email = $("#email-id").val().trim();
          var password = $("#password").val().trim();
          var accountype = $("#accountype").val();
          var valid = true;

          // Email validation helper
          function isValidEmail(email) {
              const re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
              return re.test(String(email).toLowerCase());
          }

          // Clear previous errors
          $(".spanError").html('');
          $("input, select").css("border-color", "");

          // Name validation
          if (name === '') {
              valid = false;
              $("#name").css("border-color", "red");
              $(".spanError-name").html("* This field is required.");
          }

          // Phone validation
          if (phone === '') {
              valid = false;
              $("#phone").css("border-color", "red");
              $(".spanError-phone").html("* This field is required.");
          } else if (phone.length !== 10 || !phone.startsWith('09')) {
              valid = false;
              $("#phone").css("border-color", "red");
              $(".spanError-phone").html("* Phone number must start with 09 and be 10 digits.");
          }

          // Account type validation
          if (accountype === '') {
              valid = false;
              $("#accountype").css("border-color", "red");
              $(".spanError-accountype").html("* This field is required.");
          }

          // Email validation
          if (email === '') {
              valid = false;
              $("#email-id").css("border-color", "red");
              $(".spanError-1").html("* This field is required.");
          } else if (!isValidEmail(email)) {
              valid = false;
              $("#email-id").css("border-color", "red");
              $(".spanError-1").html("* Please enter a valid email.");
          }

          // Password is optional for updates, so no validation needed
          // If password is provided but too short, you can add validation here

          // Prevent submission if invalid
          if (!valid) {
              event.preventDefault();
          }
      });
  });
  </script>
</body>
</html>