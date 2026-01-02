
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

    /* Alert Styles */
    .alert-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
      border: none;
      border-radius: 15px;
      color: #ffffff !important;
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
      animation: slideInDown 0.5s ease-out;
    }
    
    .alert-success .btn-close {
      filter: brightness(0) invert(1);
    }

    /* Dashboard Cards */
    .card { 
      border-radius: 20px; 
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      border: none;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, #10b981, #f59e0b, #ef4444);
    }
    
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    /* Info Cards Specific Styling */
    .info-card {
      position: relative;
      overflow: hidden;
    }
    
    .info-card::after {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transform: rotate(45deg);
      transition: all 0.6s ease;
      opacity: 0;
    }
    
    .info-card:hover::after {
      animation: shine 0.6s ease-in-out;
    }

    /* Sales Card (Customers) - Green Theme */
    .sales-card {
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    }
    
    .sales-card .card-icon {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #ffffff;
      width: 60px;
      height: 60px;
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }

    /* Revenue Card (Managers) - Orange Theme */
    .revenue-card {
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
    }
    
    .revenue-card .card-icon {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: #ffffff;
      width: 60px;
      height: 60px;
      box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
    }

    /* Customers Card (Admins) - Red Theme */
    .customers-card {
      background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    }
    
    .customers-card .card-icon {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: #ffffff;
      width: 60px;
      height: 60px;
      box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
    }

    /* Card Content */
    .card-body h5.card-title { 
      font-weight: 700; 
      color: #1e40af;
      font-size: 1.25rem;
      margin-bottom: 1.5rem;
      position: relative;
    }
    
    .card-body h6 {
      font-size: 2.5rem;
      font-weight: 800;
      color: #1e293b;
      margin-bottom: 0.5rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .text-success {
      color: #10b981 !important;
      font-weight: 600;
    }
    
    .text-muted {
      color: #64748b !important;
      font-weight: 500;
      font-size: 0.9rem;
    }

    /* Card Icons */
    .card-icon {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .card-icon::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s ease;
    }
    
    .card:hover .card-icon::before {
      left: 100%;
    }
    
    .card-icon i {
      font-size: 1.5rem;
      transition: all 0.3s ease;
    }
    
    .card:hover .card-icon {
      transform: scale(1.1) rotate(5deg);
    }

    /* Filter Dropdown */
    .filter .dropdown-menu {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(226, 232, 240, 0.5);
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .filter .dropdown-item {
      transition: all 0.3s ease;
      border-radius: 8px;
      margin: 2px 8px;
    }
    
    .filter .dropdown-item:hover {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #ffffff;
      transform: translateX(5px);
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
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes shine {
      0% {
        opacity: 0;
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
      }
      50% {
        opacity: 1;
      }
      100% {
        opacity: 0;
        transform: translateX(100%) translateY(100%) rotate(45deg);
      }
    }
    
    @keyframes pulse {
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
    
    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
    }
    
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(-10px);
      }
      60% {
        transform: translateY(-5px);
      }
    }
    
    .card {
      animation: fadeInUp 0.6s ease-out;
    }
    
    .card:nth-child(1) {
      animation-delay: 0.1s;
    }
    
    .card:nth-child(2) {
      animation-delay: 0.2s;
    }
    
    .card:nth-child(3) {
      animation-delay: 0.3s;
    }

    /* Floating Animation for Cards */
    .info-card {
      animation: float 6s ease-in-out infinite;
    }
    
    .sales-card {
      animation-delay: 0s;
    }
    
    .revenue-card {
      animation-delay: 2s;
    }
    
    .customers-card {
      animation-delay: 4s;
    }

    /* Number Counter Animation */
    .card-body h6 {
      animation: bounce 2s infinite;
    }

    /* Special Owner Theme Colors */
    .sales-card:hover {
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.08) 100%);
    }
    
    .revenue-card:hover {
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0.08) 100%);
    }
    
    .customers-card:hover {
      background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.08) 100%);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .card-body { 
        padding: 20px; 
      }
      
      .header .logo img { 
        max-width: 50px; 
        max-height: 50px; 
      }
      
      .pagetitle h1 {
        font-size: 2rem;
      }
      
      .card-body h6 {
        font-size: 2rem;
      }
      
      .card-icon {
        width: 50px !important;
        height: 50px !important;
      }
      
      .card-icon i {
        font-size: 1.25rem;
      }
    }

    /* Special Effects */
    .card-body {
      position: relative;
      z-index: 2;
    }
    
    .d-flex.align-items-center {
      position: relative;
      z-index: 3;
    }

    /* Enhanced Typography */
    .card-title span {
      color: #64748b;
      font-weight: 500;
      font-size: 0.9rem;
    }

    /* Loading States */
    .card-body h6:empty::after {
      content: '0';
      opacity: 0.5;
    }

    /* Owner-specific accent colors */
    .card-title {
      color: #059669 !important;
    }
    
    /* Enhanced card hover effects for Owner theme */
    .card:hover .card-title {
      color: #047857 !important;
    }
  </style>
</head>

<body>

  <!-- =======================================================
  * Folder Super/Owner
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center">
        <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80PX; max-width: 60px;">
        <!-- <span class="d-none d-lg-block">Honda</span> -->
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
  <!-- Include aside bar for super Owner -->
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
        <?php if (isset($_GET['success'])) { ?>
        <div class="col-12">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #198754; color: white;">
                 Hi, &nbsp; <?= $fullname; ?> ! &nbsp;<i class="bi-hand-thumbs-up"></i>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      <?php } ?>
        <!-- Left side columns -->
       <div class="col-lg-12">
        <div class="row">

          <!-- Total Fans Card -->
          <div class="col-xxl-6 col-md-6 col-lg-6">
            <div class="card info-card sales-card">
              <?php  $CommonOBJ->confirmStatus($_SESSION['sessionID']); ?>
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Total Customers <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                          $param = 1;
                          $QtyFans = $CommonOBJ->getCustomerQty();
                    ?>
                    <h6><?= $Q = $QtyFans ? $QtyFans : 0  ?></h6>
                    <span class="text-success small pt-1 fw-bold"><?php //echo $totalFans ? $totalFans : 0 ?></span> 
                    <span class="text-muted small pt-2 ps-1">Total Customers</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Total Fans Card -->

          <!-- Total Players Card -->
          <div class="col-xxl-6 col-md-6 col-lg-6">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Total Manager <span>| This Month</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-badge-fill"></i>
                  </div>
                  <div class="ps-3">
                     <?php
                          $QtyFans = $CommonOBJ->getTotalManager();
                    ?>
                    <h6><?= $Q = $QtyFans ? $QtyFans : 0  ?></h6>
                    <span class="text-muted small pt-2 ps-1">Manager</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Total Players Card -->

          <!-- Total Owners Card -->
          <div class="col-xxl-6 col-xl-6">
            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Admins <span>| This Year</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-shield-lock-fill"></i>
                  </div>
                  <div class="ps-3">
                    <?php
                          $param = 1;
                          $QtyAdmins = $CommonOBJ->getTotalAdmins();
                    ?>
                    <h6><?= $Q = $QtyAdmins ? $QtyAdmins : 0  ?></h6>
                    <span class="text-muted small pt-2 ps-1">Admins</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Admins Card -->

    

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




</body>

</html>