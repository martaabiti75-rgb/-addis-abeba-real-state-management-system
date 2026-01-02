
<?php 

  session_start();
  if (isset($_SESSION['sessionID'])) {
    // code...
  }else{
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
  }

  require __DIR__.'/performOwnerAction.php';
  $isPerformOwnerOBJ = new isPerformOwnerAction();
  require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
  $CommonOBJ = new CommonFunction();

  $dataQ = $isPerformOwnerOBJ->getSessionUser($_SESSION['sessionID']);
  $rowQ = $isPerformOwnerOBJ->getSessionUser($_SESSION['sessionID']);
      foreach ($dataQ as $key => $value) {
        // code...
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

  <title>Adis Abeba Real Estate Management System</title>
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
      background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
      transition: left 0.5s ease;
    }
    
    #sidebar .nav-link:hover::before {
      left: 100%;
    }
    
    #sidebar .nav-link:hover {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #ffffff;
      transform: translateX(5px);
    }
    
    #sidebar .nav-link.active { 
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      color: #ffffff;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
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
      background: linear-gradient(90deg, #10b981, #f59e0b, #ef4444, #8b5cf6);
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
      color: #059669;
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
      background: linear-gradient(90deg, #10b981, #059669);
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
      border-color: #10b981;
      box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15);
      outline: none;
      background: rgba(255, 255, 255, 0.9);
      transform: translateY(-2px);
    }
    
    .form-control:hover {
      border-color: #34d399;
      background: rgba(255, 255, 255, 0.9);
    }

    /* Input Group */
    .input-group-text {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: 2px solid #10b981;
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
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      border: none;
      border-radius: 15px;
      padding: 15px 30px;
      font-weight: 700;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
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
      box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }
    
    .btn-primary:active {
      transform: translateY(-1px);
    }

    /* Validation States */
    .form-control[style*="border-color: red"] {
      border-color: #ef4444 !important;
      box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.15) !important;
      animation: shake 0.5s ease-in-out;
    }

    .form-control[style*="border-color: green"] {
      border-color: #10b981 !important;
      box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15) !important;
      animation: pulse-success 0.5s ease-in-out;
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

    /* Password Strength Indicator */
    .password-strength {
      height: 4px;
      border-radius: 2px;
      margin-top: 8px;
      transition: all 0.3s ease;
    }
    
    .strength-weak { background: linear-gradient(90deg, #ef4444, #f87171); }
    .strength-medium { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .strength-strong { background: linear-gradient(90deg, #10b981, #34d399); }

    /* Password Requirements */
    .password-requirements {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border: 2px solid #f59e0b;
      border-radius: 12px;
      padding: 15px;
      margin-top: 10px;
      font-size: 0.875rem;
      color: #92400e;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
      display: none;
    }
    
    .password-requirements.show {
      display: block;
      animation: slideInDown 0.3s ease-out;
    }
    
    .password-requirements strong {
      color: #78350f;
      font-weight: 700;
    }
    
    .requirement {
      margin: 5px 0;
      transition: all 0.3s ease;
    }
    
    .requirement.valid {
      color: #059669;
      font-weight: 600;
    }
    
    .requirement.valid::before {
      content: '✓ ';
      color: #10b981;
    }
    
    .requirement.invalid::before {
      content: '✗ ';
      color: #ef4444;
    }

    /* Breadcrumb */
    .breadcrumb { 
      background: none; 
      padding: 0; 
      margin-bottom: 20px;
    }
    
    .breadcrumb-item a { 
      color: #10b981;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
      color: #059669;
      text-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
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
      color: #10b981; 
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    footer.footer a:hover { 
      color: #059669;
      text-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
    }

    /* Back to Top */
    .back-to-top { 
      position: fixed; 
      right: 30px; 
      bottom: 30px; 
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    
    .back-to-top:hover { 
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
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
    
    @keyframes pulse-success {
      0% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
      }
      70% {
        box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
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
      
      .form-control {
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

    /* Loading State */
    .btn-primary:disabled {
      background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
      cursor: not-allowed;
      transform: none;
    }

    /* Success Animation */
    .errorALL:not(:empty) {
      animation: pulse-success 2s infinite;
    }
  </style>

  <!-- =======================================================
  * Folder Super/Admin
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
       <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80PX; max-width: 60px;">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>

        <!-- End Search Icon-->

        <!-- Notification Bar Here start -->

        <!-- Notification Bar Here end -->

        <!-- Messsage Bar Here end -->
        <!-- Messsage Bar Here end -->

        
        <!-- End Messages Nav -->

      <?php include __DIR__.'/profileModal.php';  ?>

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <!-- Include aside bar for super admin -->
  <?php 
    require __DIR__.'/Component/Asidebar.php';
    // require __DIR__.'/Component/Logoutmodal.php';
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">
<?php 
    require __DIR__.'/Component/Logoutmodal.php';
?>
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home (<?=$role; ?>)</a></li>
          <li class="breadcrumb-item active">Last login date : <?= $lastlogintime; ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<section class="section dashboard">
      <div class="row">

        <!-- <div class="col-md-3"></div> -->
        <div class="col-md-5"></div>
        <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center pt-2">
          <div class="card ">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <a href="#" class="newlogo d-flex align-items-center w-auto">
                  <img src="ERP/assets/img/RodasNew.png" alt="" style="width: 100px;" class="">
                  <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                </a>
                    <h5 class="card-title text-center pb-0 fs-4">Change Password ?</h5>
                    
                  </div>
                  <!--class: needs-validation attribute:novalidate -->
                  <form class="row g-3 needs-validations" novalidate method="post" action="" id="forms">
                    <?php

                    if (isset($_GET['error'])) { ?>
                     <p class="text-center text-danger small fw-bold" id="displayblock"><?= $_GET['error'];  ?></p>
                    <?php } ?>
                    
                    <p class="text-center text-success spanError errorALL"><?= $CommonOBJ->changePassword(); ?></p>
               
                    <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Email *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="email" value="<?=$_SESSION['sessionID']; ?>">
                      </div>
                      <span class="text-danger spanError spanError-email"></span>
                    </div>
                    
                   <div class="col-md-12">
                   <label for="yourPassword" class="col-form-label-sm">OLD Password *</label>
                      <div class="input-group has-validation">
                      <span class="input-group-text show"><span class="bi bi-eye-slash innershow" id="togglePassword"></span></span>
                      <input type="password" name="oldPassword" class="form-control pass-key" id="oldpassword">
                    </div>
                    <span class="text-danger spanError spanError-oldpass"></span>
                  </div>

                  <div class="col-md-12">
                   <label for="yourPassword" class="col-form-label-sm">NEW Password *</label>
                      <div class="input-group has-validation">
                      <span class="input-group-text show"><span class="bi bi-eye-slash innershow" id="togglePassword"></span></span>
                      <input type="password" name="newPassword" class="form-control pass-key" id="newpassword">
                    </div>
                    <span class="text-danger spanError spanError-newpass"></span>
                  </div>

                  <div class="col-md-12">
                   <label for="yourPassword" class="col-form-label-sm">Confirm Password *</label>
                      <div class="input-group has-validation">
                      <span class="input-group-text show"><span class="bi bi-eye-slash innershow" id="togglePassword"></span></span>
                      <input type="password" name="conPassword" class="form-control pass-key" id="conpassword">
                    </div>
                    <span class="text-danger spanError spanError-conpass"></span>
                  </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="changePasswordBtn" id="AddBtn">Submit</button>
                    </div>
                  </form>

                </div>
              </div>
        </div>

      </div>
    </section>


  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="margin-top: 150px;">
    <div class="copyright">
      &copy; Copyright <strong><span>Adis Abeba Real Estate Management System</span></strong>.All right reserved.
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
  ipt src="../dashboard/assets/js/main.js"></script>
  <script src="../dashboard/assets\ajax\jquery-2.2.4.min.js"></script>
  <script src="../dashboard/assets\ajax\jquery.js"></script>
  <script src="../dashboard/assets\ajax\jquery.min.js"></script>

  <script type="text/javascript">
$(document).ready(function() {

    // Strong validation functions
    function isValidEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|gov|edu|co\.uk|co\.za|ac\.uk|ac\.za)$/i;
        return re.test(String(email).toLowerCase()) && email.length <= 100;
    }
    
    function isStrongPassword(password) {
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const hasMinLength = password.length >= 8;
        const hasMaxLength = password.length <= 128;
        const noCommonPatterns = !/(123|abc|password|admin|user|qwerty|letmein)/i.test(password);
        
        return hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChar && 
               hasMinLength && hasMaxLength && noCommonPatterns;
    }
    
    function getPasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[a-z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
        if (password.length >= 12) score++;
        if (!/(.)\1{2,}/.test(password)) score++; // No repeated characters
        
        if (score <= 2) return 'weak';
        if (score <= 4) return 'medium';
        return 'strong';
    }
    
    // Create password requirements display
    function showPasswordRequirements() {
        if (!$('#passwordHelp').length) {
            const helpText = `
                <div id="passwordHelp" class="password-requirements show">
                    <strong>Password Requirements:</strong><br>
                    <div class="requirement" id="req-length">• At least 8 characters</div>
                    <div class="requirement" id="req-upper">• One uppercase letter (A-Z)</div>
                    <div class="requirement" id="req-lower">• One lowercase letter (a-z)</div>
                    <div class="requirement" id="req-number">• One number (0-9)</div>
                    <div class="requirement" id="req-special">• One special character (!@#$%^&*)</div>
                    <div class="requirement" id="req-common">• No common patterns</div>
                </div>
            `;
            $('#newpassword').closest('.col-md-12').append(helpText);
        }
    }
    
    function updatePasswordRequirements(password) {
        const requirements = {
            'req-length': password.length >= 8,
            'req-upper': /[A-Z]/.test(password),
            'req-lower': /[a-z]/.test(password),
            'req-number': /\d/.test(password),
            'req-special': /[!@#$%^&*(),.?":{}|<>]/.test(password),
            'req-common': !/(123|abc|password|admin|user|qwerty|letmein)/i.test(password)
        };
        
        Object.keys(requirements).forEach(id => {
            const $req = $(`#${id}`);
            if (requirements[id]) {
                $req.removeClass('invalid').addClass('valid');
            } else {
                $req.removeClass('valid').addClass('invalid');
            }
        });
    }

    // Strong validation functions
    function isValidEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|gov|edu|co\.uk|co\.za|ac\.uk|ac\.za)$/i;
        return re.test(String(email).toLowerCase()) && email.length <= 100;
    }
    
    function isStrongPassword(password) {
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        const hasMinLength = password.length >= 8;
        const hasMaxLength = password.length <= 128;
        const noCommonPatterns = !/(123|abc|password|admin|user|qwerty|letmein)/i.test(password);
        
        return hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChar && 
               hasMinLength && hasMaxLength && noCommonPatterns;
    }
    
    function getPasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[a-z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
        if (password.length >= 12) score++;
        if (!/(.)\1{2,}/.test(password)) score++; // No repeated characters
        
        if (score <= 2) return 'weak';
        if (score <= 4) return 'medium';
        return 'strong';
    }
    
    // Create password requirements display
    function showPasswordRequirements() {
        if (!$('#passwordHelp').length) {
            const helpText = `
                <div id="passwordHelp" class="password-requirements show">
                    <strong>Password Requirements:</strong><br>
                    <div class="requirement" id="req-length">• At least 8 characters</div>
                    <div class="requirement" id="req-upper">• One uppercase letter (A-Z)</div>
                    <div class="requirement" id="req-lower">• One lowercase letter (a-z)</div>
                    <div class="requirement" id="req-number">• One number (0-9)</div>
                    <div class="requirement" id="req-special">• One special character (!@#$%^&*)</div>
                    <div class="requirement" id="req-common">• No common patterns</div>
                </div>
            `;
            $('#newpassword').closest('.col-md-12').append(helpText);
        }
    }
    
    function updatePasswordRequirements(password) {
        const requirements = {
            'req-length': password.length >= 8,
            'req-upper': /[A-Z]/.test(password),
            'req-lower': /[a-z]/.test(password),
            'req-number': /\d/.test(password),
            'req-special': /[!@#$%^&*(),.?":{}|<>]/.test(password),
            'req-common': !/(123|abc|password|admin|user|qwerty|letmein)/i.test(password)
        };
        
        Object.keys(requirements).forEach(id => {
            const $req = $(`#${id}`);
            if (requirements[id]) {
                $req.removeClass('invalid').addClass('valid');
            } else {
                $req.removeClass('valid').addClass('invalid');
            }
        });
    }

    // Enhanced email validation
    $("#email").on('blur keyup', function() {
        const val = $(this).val().trim();
        if(val === '') {
            $(this).css("border-color", "red");
            $(".spanError-email").html("* Email is required");
        } else if(val.length > 100) {
            $(this).css("border-color", "red");
            $(".spanError-email").html("* Email must be less than 100 characters");
        } else if(!isValidEmail(val)) {
            $(this).css("border-color", "red");
            $(".spanError-email").html("* Please enter a valid email address");
        } else {
            $(this).css("border-color", "green");
            $(".spanError-email").html('');
        }
    });

    // Current password validation
    $("#oldpassword").on('blur keyup', function() {
        const val = $(this).val();
        if(val === '') {
            $(this).css("border-color", "red");
            $(".spanError-oldpass").html("* Current password is required");
        } else if(val.length < 6) {
            $(this).css("border-color", "red");
            $(".spanError-oldpass").html("* Password must be at least 6 characters");
        } else {
            $(this).css("border-color", "green");
            $(".spanError-oldpass").html('');
        }
    });

    // New password validation with strength checking
    $("#newpassword").on('blur keyup focus', function() {
        const val = $(this).val();
        const oldPass = $("#oldpassword").val();
        
        // Show requirements on focus
        if(event.type === 'focus') {
            showPasswordRequirements();
        }
        
        // Remove existing strength indicator
        $(this).siblings('.password-strength').remove();
        
        if(val === '') {
            $(this).css("border-color", "red");
            $(".spanError-newpass").html("* New password is required");
            $('#passwordHelp').hide();
        } else if(val.length < 8) {
            $(this).css("border-color", "red");
            $(".spanError-newpass").html("* Password must be at least 8 characters");
            showPasswordRequirements();
            updatePasswordRequirements(val);
        } else if(val.length > 128) {
            $(this).css("border-color", "red");
            $(".spanError-newpass").html("* Password must be less than 128 characters");
        } else if(val === oldPass) {
            $(this).css("border-color", "red");
            $(".spanError-newpass").html("* New password must be different from current password");
        } else if(!isStrongPassword(val)) {
            $(this).css("border-color", "red");
            $(".spanError-newpass").html("* Password does not meet security requirements");
            showPasswordRequirements();
            updatePasswordRequirements(val);
        } else {
            $(this).css("border-color", "green");
            $(".spanError-newpass").html('');
            $('#passwordHelp').hide();
        }
        
        // Add password strength indicator
        if(val.length > 0) {
            const strength = getPasswordStrength(val);
            const strengthClass = `strength-${strength}`;
            $(this).after(`<div class="password-strength ${strengthClass}"></div>`);
        }
        
        // Also validate confirm password if it has a value
        if($("#conpassword").val()) {
            $("#conpassword").trigger('blur');
        }
    });

    // Confirm password validation
    $("#conpassword").on('blur keyup', function() {
        const val = $(this).val();
        const newPass = $("#newpassword").val();
        
        if(val === '') {
            $(this).css("border-color", "red");
            $(".spanError-conpass").html("* Please confirm your password");
        } else if(val !== newPass) {
            $(this).css("border-color", "red");
            $(".spanError-conpass").html("* Passwords do not match");
        } else if(!isStrongPassword(val)) {
            $(this).css("border-color", "red");
            $(".spanError-conpass").html("* Password does not meet security requirements");
        } else {
            $(this).css("border-color", "green");
            $(".spanError-conpass").html('');
        }
    });

    // Enhanced form submission with security checks
    $("#AddBtn").on('click', function(event) {
        // Trigger validation on all fields
        $("#email, #oldpassword, #newpassword, #conpassword").trigger('blur');
        
        const email = $("#email").val().trim();
        const oldPassword = $("#oldpassword").val();
        const newPassword = $("#newpassword").val();
        const conPassword = $("#conpassword").val();
        
        let hasErrors = false;
        let errorMessages = [];
        
        // Check basic validation errors
        if($(".spanError-email").html() || 
           $(".spanError-oldpass").html() || 
           $(".spanError-newpass").html() || 
           $(".spanError-conpass").html()) {
            hasErrors = true;
        }
        
        // Additional security checks
        if(newPassword && oldPassword) {
            // Check if new password is same as old
            if(newPassword === oldPassword) {
                $(".spanError-newpass").html("* New password must be different from current password");
                $("#newpassword").css("border-color", "red");
                hasErrors = true;
            }
            
            // Check if password contains email username
            if(email && newPassword.toLowerCase().includes(email.split('@')[0].toLowerCase())) {
                $(".spanError-newpass").html("* Password cannot contain your email username");
                $("#newpassword").css("border-color", "red");
                hasErrors = true;
            }
            
            // Check for common passwords
            const commonPasswords = ['password', '123456', 'password123', 'admin', 'user', 'qwerty', 'letmein', 'welcome'];
            if(commonPasswords.some(common => newPassword.toLowerCase().includes(common.toLowerCase()))) {
                $(".spanError-newpass").html("* Please avoid common passwords");
                $("#newpassword").css("border-color", "red");
                hasErrors = true;
            }
            
            // Check for sequential characters
            if(/012|123|234|345|456|567|678|789|890|abc|bcd|cde|def/i.test(newPassword)) {
                $(".spanError-newpass").html("* Avoid sequential characters");
                $("#newpassword").css("border-color", "red");
                hasErrors = true;
            }
        }
        
        // Password confirmation check
        if(newPassword && conPassword && newPassword !== conPassword) {
            $(".spanError-conpass").html("* Passwords do not match");
            $("#conpassword").css("border-color", "red");
            hasErrors = true;
        }
        
        // SQL injection prevention
        const sqlPatterns = /('|(\\')|(;)|(\\;)|(select)|(insert)|(update)|(delete)|(drop)|(create)|(alter)|(exec)|(union)|(script))/gi;
        if(sqlPatterns.test(oldPassword) || sqlPatterns.test(newPassword)) {
            alert("Invalid characters detected. Please remove special SQL characters.");
            hasErrors = true;
        }
        
        // XSS prevention
        const xssPatterns = /(<script|<\/script|javascript:|onload=|onerror=|onclick=)/gi;
        if(xssPatterns.test(oldPassword) || xssPatterns.test(newPassword)) {
            alert("Invalid characters detected. Please remove script-related content.");
            hasErrors = true;
        }
        
        if(hasErrors) {
            event.preventDefault();
            
            // Scroll to first error field
            const firstErrorField = $(".form-control[style*='border-color: red']").first();
            if(firstErrorField.length) {
                $('html, body').animate({
                    scrollTop: firstErrorField.offset().top - 100
                }, 500);
                firstErrorField.focus();
            }
            
            return false;
        }
        
        // Show loading state
        $(this).prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Updating Password...');
        
        // Re-enable button after 10 seconds (in case of server issues)
        setTimeout(() => {
            $(this).prop('disabled', false).html('Submit');
        }, 10000);
        
        // Allow form submission
        return true;
    });

    // Toggle password visibility
    $(".innershow").on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass("bi-eye bi-eye-slash");
        
        // Toggle all password fields
        $(".pass-key").each(function() {
            const type = $(this).attr("type") === "password" ? "text" : "password";
            $(this).attr("type", type);
        });
    });

    // Hide password requirements when clicking outside
    $(document).on('click', function(e) {
        if(!$(e.target).closest('#newpassword, #passwordHelp').length) {
            $('#passwordHelp').hide();
        }
    });

    // Prevent form submission on Enter key (except on submit button)
    $('input').on('keypress', function(e) {
        if(e.which === 13 && $(this).attr('type') !== 'submit') {
            e.preventDefault();
            const inputs = $('input:visible');
            const nextIndex = inputs.index(this) + 1;
            if(nextIndex < inputs.length) {
                inputs.eq(nextIndex).focus();
            } else {
                $("#AddBtn").focus();
            }
        }
    });

    // Clear validation styling on focus
    $('input').on('focus', function() {
        if($(this).attr('id') !== 'newpassword') {
            $(this).css("border-color", "");
        }
        $(this).siblings('.password-strength').remove();
    });

});
</script>


</body>

</html>