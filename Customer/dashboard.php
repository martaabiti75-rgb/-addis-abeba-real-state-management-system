
<?php 

  session_start();
  if (isset($_SESSION['sessionID'])) {
    // code...
  }else{
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
  }

  require __DIR__.'/performCustAction.php';
  $isPerformCustOBJ = new isPerformCustAction();
  require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
  $CommonOBJ = new CommonFunction();

  $dataQ = $isPerformCustOBJ->getSessionUser($_SESSION['sessionID']);
  $rowQ = $isPerformCustOBJ->getSessionUser($_SESSION['sessionID']);
      foreach ($dataQ as $key => $value) {
        // code...
        $fullname = $value['fullname'];
        $role = $value['role'];
        $AccountState = $value['account_status'];
        $url = $value['profile_picture_url'];
        $lastlogintime = $value['last_login_time'];
        // $cid = $value['cid'];
        $cid = $value['cid'];
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
  <link href="../assets/img/wsu.png" rel="apple-touch-icon">

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
  
  <!-- Custom CSS -->
<style>
  /* Modern Elegant Dashboard CSS */
  :root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --success-color: #27ae60;
    --warning-color: #f39c12;
    --light-bg: #ecf0f1;
    --dark-bg: #34495e;
    --white: #ffffff;
    --shadow-light: 0 2px 10px rgba(0,0,0,0.1);
    --shadow-medium: 0 5px 20px rgba(0,0,0,0.15);
    --shadow-heavy: 0 10px 30px rgba(0,0,0,0.2);
    --border-radius: 12px;
    --transition: all 0.3s ease;
  }

  * {
    box-sizing: border-box;
  }

  body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    color: var(--primary-color);
    line-height: 1.6;
    margin: 0;
    padding: 0;
  }

  /* Header Styling */
  .header { 
    background: var(--white);
    box-shadow: var(--shadow-light);
    border-bottom: 3px solid var(--secondary-color);
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .header .logo img { 
    border-radius: 50%; 
    transition: var(--transition);
    border: 3px solid var(--secondary-color);
  }

  .header .logo img:hover {
    transform: scale(1.05);
    border-color: var(--accent-color);
  }

  /* Sidebar Styling */
  #sidebar { 
    background: var(--white);
    box-shadow: var(--shadow-medium);
    border-right: 3px solid var(--light-bg);
  }

  #sidebar .nav-link { 
    color: var(--primary-color);
    transition: var(--transition);
    border-radius: var(--border-radius);
    margin: 5px 10px;
    padding: 12px 15px;
    font-weight: 500;
  }

  #sidebar .nav-link:hover {
    background: var(--secondary-color);
    color: var(--white);
    transform: translateX(5px);
    box-shadow: var(--shadow-light);
  }

  #sidebar .nav-link.active { 
    background: var(--primary-color);
    color: var(--white);
    font-weight: 600;
    box-shadow: var(--shadow-medium);
  }

  /* Main Content */
  .main {
    background: transparent;
    padding: 20px;
  }

  .pagetitle h1 {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
  }

  /* Breadcrumb */
  .breadcrumb {
    background: var(--white);
    border-radius: var(--border-radius);
    padding: 15px 20px;
    box-shadow: var(--shadow-light);
    border-left: 4px solid var(--secondary-color);
  }

  .breadcrumb-item a { 
    color: var(--secondary-color);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
  }

  .breadcrumb-item a:hover {
    color: var(--accent-color);
  }

  .breadcrumb-item.active { 
    color: var(--primary-color);
    font-weight: 600;
  }

  /* Alert Styling */
  .alert {
    border-radius: var(--border-radius);
    border: none;
    box-shadow: var(--shadow-light);
    font-weight: 500;
    padding: 20px;
  }

  .alert-success {
    background: linear-gradient(135deg, var(--success-color), #2ecc71);
    color: var(--white);
    border-left: 5px solid #1e8449;
  }

  /* Card Styling */
  .app-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    border: 1px solid #e8ecef;
    transition: var(--transition);
    overflow: hidden;
    margin-bottom: 25px;
    position: relative;
  }

  .app-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
  }

  .app-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-heavy);
    border-color: var(--secondary-color);
  }

  /* Image Styling */
  .app-card-thumb-holder {
    position: relative;
    overflow: hidden;
  }

  .thumb-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: var(--transition);
  }

  .app-card:hover .thumb-image {
    transform: scale(1.05);
  }

  .app-card-thumb::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(52, 152, 219, 0.1), rgba(231, 76, 60, 0.1));
    opacity: 0;
    transition: var(--transition);
  }

  .app-card:hover .app-card-thumb::after {
    opacity: 1;
  }

  /* Card Body */
  .app-card-body {
    padding: 20px;
  }

  .app-doc-title a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: var(--transition);
  }

  .app-doc-title a:hover {
    color: var(--secondary-color);
  }

  .app-doc-meta {
    margin: 15px 0;
  }

  .app-doc-meta li {
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .app-doc-meta li:last-child {
    border-bottom: none;
  }

  .text-muted {
    color: #6c757d !important;
    font-weight: 500;
  }

  /* Button Styling */
  .btn-primary {
    background: linear-gradient(135deg, var(--secondary-color), #2980b9);
    border: none;
    border-radius: var(--border-radius);
    padding: 12px 25px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: var(--transition);
    box-shadow: var(--shadow-light);
    position: relative;
    overflow: hidden;
  }

  .btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: var(--transition);
  }

  .btn-primary:hover::before {
    left: 100%;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, var(--accent-color), #c0392b);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
  }

  .btn-primary:active {
    transform: translateY(0);
  }

  /* Footer */
  .footer {
    background: var(--primary-color) !important;
    color: var(--white);
    box-shadow: var(--shadow-medium);
    border-top: 3px solid var(--secondary-color);
  }

  .footer a {
    color: var(--secondary-color);
    transition: var(--transition);
    font-weight: 500;
  }

  .footer a:hover {
    color: var(--warning-color);
    text-decoration: none;
  }

  /* Back to Top */
  .back-to-top {
    background: var(--secondary-color) !important;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    box-shadow: var(--shadow-medium);
    transition: var(--transition);
  }

  .back-to-top:hover {
    background: var(--accent-color) !important;
    transform: translateY(-3px);
    box-shadow: var(--shadow-heavy);
  }

  /* Success Message */
  .text-success {
    color: var(--success-color) !important;
    font-weight: 600;
  }

  /* Grid Layout */
  .row.g-4 > div {
    margin-bottom: 20px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .pagetitle h1 {
      font-size: 2rem;
    }
    
    .app-card-body {
      padding: 15px;
    }
    
    .breadcrumb {
      padding: 12px 15px;
    }
    
    .btn-primary {
      padding: 10px 20px;
      font-size: 14px;
    }
  }

  /* Smooth Animations */
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

  .app-card {
    animation: fadeInUp 0.5s ease-out;
  }

  /* Custom Scrollbar */
  ::-webkit-scrollbar {
    width: 8px;
  }

  ::-webkit-scrollbar-track {
    background: var(--light-bg);
  }

  ::-webkit-scrollbar-thumb {
    background: var(--secondary-color);
    border-radius: 4px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: var(--primary-color);
  }

  /* Loading States */
  .loading {
    opacity: 0.7;
    pointer-events: none;
  }

  /* Focus States */
  .btn:focus,
  .nav-link:focus {
    outline: 2px solid var(--secondary-color);
    outline-offset: 2px;
  }
</style>
</head>

<body>

  <style>
    .product-card {
    transition: 0.25s ease;
    border-radius: 15px;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center">
        <!-- <img src="../assets/img/wsu.png" alt="" style="max-height: 60PX; max-width: 100px;"> -->
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
        <?php if (isset($_GET['success'])) { ?>
        <div class="col-12">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #198754; color: white;">
                 Hi, &nbsp; <?= $fullname; ?> ! &nbsp;<i class="bi-hand-thumbs-up"></i>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      <?php } ?>
        <!-- Left side columns -->

<div class="row g-4 mb-4">

  <!-- Add to cart message -->
  <div class="col-md-12">
    <p class="text-center text-success spanError errorALL">
      <?= $isPerformCustOBJ->addToCart(); ?>
    </p>
  </div>

  <?php 
    $dataQ = $CommonOBJ->getProperties();
    $rowQs = $CommonOBJ->getProperties();

    if ($rowQs > 0) {
      foreach ($dataQ as $values) { 
  ?>

  <div class="col-6 col-md-6 col-xl-4 col-xxl-4">
    <div class="app-card app-card-doc shadow-sm h-100">

      <!-- Image -->
      <div class="app-card-thumb-holder p-3">
        <div class="app-card-thumb">
          <img class="thumb-image" 
               src="../files/rooms/<?= $values['Block_Url']; ?>" 
               alt="Property Image"
               style="max-width: 400px;">
        </div>
        <a class="app-card-link-mask" href="#file-link"></a>
      </div>

      <!-- Card Body -->
      <div class="app-card-body p-3 has-card-actions">

        <h4 class="app-doc-title truncate mb-0">
          <a href="#file-link"><?= $values['Address']; ?> Properties</a>
        </h4>

        <div class="app-doc-meta">
          <ul class="list-unstyled mb-0">
            <li><span class="text-muted">Price:</span> <?= $values['SalePrice']; ?></li>
            <li><span class="text-muted">RID:</span> <?= $values['RealStateId']; ?></li>
            <li><span class="text-muted">Owner:</span> <?= $values['OwnerName']; ?></li>
          </ul>
        </div>

        <!-- Add To Cart Form -->
        <form action="" method="post" class="mt-2">
          <input type="hidden" name="qty" id="QTY" required>

          <input type="hidden" name="userid" value="<?= $_SESSION['sessionID']; ?>">
          <input type="hidden" name="cid" value="<?= $cid; ?>">
          <input type="hidden" name="rid" value="<?= $values['RealStateId']; ?>">
          <input type="hidden" name="roomid" value="<?= $values['RUniqId']; ?>">
          <input type="hidden" name="oid" value="<?= $values['OwnerId']; ?>">
          <input type="hidden" name="oname" value="<?= $values['OwnerName']; ?>">
          <input type="hidden" name="price" value="<?= $values['SalePrice']; ?>">
          <input type="hidden" name="fullname" value="<?= $fullname; ?>">

          <p class="card-text">
            <input type="submit" 
                   name="addToCart" 
                   class="btn btn-primary w-100"
                   value="Request Property"
                   style="border-radius: 25px; font-size: 15px;"
                   id="addToCarts">
          </p>
        </form>

      </div> <!-- // app-card-body -->

    </div> <!-- // app-card -->
  </div> <!-- // col -->

  <?php 
      } // end foreach
    } // end if
  ?>

</div> <!-- // row -->


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