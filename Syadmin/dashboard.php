<?php 
session_start();
if (!isset($_SESSION['sessionID'])) {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
}

require __DIR__.'/performAdminAction.php';
$isPerformAdminOBJ = new isPerformAdminAction();
require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
$CommonOBJ = new CommonFunction();

$dataQ = $isPerformAdminOBJ->getSessionUser($_SESSION['sessionID']);
foreach ($dataQ as $value) {
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
  body { font-family: 'Open Sans', sans-serif; background-color: #f7f8f9; color: #343a40; transition: all 0.3s; }
  .header { background-color: #004aad; color: #fff; }
  #sidebar { background-color: #1a1f36; }
  #sidebar .nav-link { color: #5998aa; }
  #sidebar .nav-link.active { background-color: #004aad; font-weight: bold; }
  .card { border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border: none; margin-bottom: 20px; transition: all 0.3s; }
  footer.footer { background-color: #4d85bc; padding: 20px 0; text-align: center; color: #fff; }
  
  /* Dark Mode Styles */
  body.dark-mode { background-color: #1e1e2f; color: #cfd1d8; }
  body.dark-mode .header { background-color: #0c0d1c; color: #fff; }
  body.dark-mode #sidebar { background-color: #0c0c1f; }
  body.dark-mode #sidebar .nav-link { color: #a0a8c0; }
  body.dark-mode #sidebar .nav-link.active { background-color: #2e2e50; }
  body.dark-mode .card { background-color: #2a2b3c; color: #cfd1d8; box-shadow: 0 5px 20px rgba(0,0,0,0.5); }
  body.dark-mode footer.footer { background-color: #111228; color: #ccc; }

  /* Dark Mode Button */
  #darkModeToggle {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 9999;
    background-color: #004aad;
    color: #fff;
    border: none;
    padding: 10px 14px;
    border-radius: 50px;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: all 0.3s;
  }
  #darkModeToggle:hover { background-color: #002f6c; }

  /* Responsive */
  @media (max-width: 768px) {
      .card-body { padding: 15px; }
  }
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
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home (<?=$role; ?>)</a></li>
      <li class="breadcrumb-item active">Last login: <?= $lastlogintime; ?></li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">

        <!-- Total Customers -->
        <div class="col-xxl-6 col-md-6 col-lg-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Customers</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people-fill"></i>
                </div>
                <div class="ps-3">
                  <?php $QtyFans = $CommonOBJ->getCustomerQty(); ?>
                  <h6><?= $QtyFans ? $QtyFans : 0 ?></h6>
                  <span class="text-muted small pt-2 ps-1">All Customers</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Players -->
        <div class="col-xxl-6 col-md-6 col-lg-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Total Players</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-badge-fill"></i>
                </div>
                <div class="ps-3">
                  <?php $QtyFans = $CommonOBJ->getTotalManager(); ?>
                  <h6><?= $QtyFans ? $QtyFans : 0 ?></h6>
                  <span class="text-muted small pt-2 ps-1">Players</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Admins -->
        <div class="col-xxl-12 col-xl-12">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div class="ps-3">
                  <?php $QtyAdmins = $CommonOBJ->getTotalAdmins(); ?>
                  <h6><?= $QtyAdmins ? $QtyAdmins : 0 ?></h6>
                  <span class="text-muted small pt-2 ps-1">Admins</span>
                </div>
              </div>
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

<!-- Back to Top -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Dark Mode Toggle Button -->
<button id="darkModeToggle" title="Toggle Dark Mode">🌙</button>

<!-- Vendor JS Files -->
<script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../dashboard/assets/vendor/quill/quill.min.js"></script>
<script src="../dashboard/assets/js/main.js"></script>

<!-- Dark Mode Script -->
<script>
const toggleBtn = document.getElementById('darkModeToggle');
const body = document.body;

// Load dark mode preference
if(localStorage.getItem('darkMode') === 'enabled'){
    body.classList.add('dark-mode');
}

// Toggle dark mode
toggleBtn.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    if(body.classList.contains('dark-mode')){
        localStorage.setItem('darkMode', 'enabled');
        toggleBtn.textContent = '☀️';
    } else {
        localStorage.setItem('darkMode', 'disabled');
        toggleBtn.textContent = '🌙';
    }
});

// Initialize button icon
toggleBtn.textContent = body.classList.contains('dark-mode') ? '☀️' : '🌙';
</script>

</body>
</html>
