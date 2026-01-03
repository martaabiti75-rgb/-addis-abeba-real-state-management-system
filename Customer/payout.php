
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
        $cid = $value['cid'];
      }

    error_reporting(0);
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
  <link rel="stylesheet" type="text/css" href="bnlogos.css">
   <!-- Custom CSS -->
  <style>
    /* Advanced Modern CSS Styling */
    :root {
      --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --card-shadow: 0 20px 40px rgba(0,0,0,0.1);
      --hover-shadow: 0 25px 50px rgba(0,0,0,0.15);
      --border-radius: 20px;
      --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body { 
      font-family: 'Poppins', sans-serif; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      color: #2c3e50;
    }

    .header { 
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .header .logo img { 
      border-radius: 50%; 
      transition: var(--transition);
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
    }

    .header .logo img:hover {
      transform: scale(1.05) rotate(5deg);
    }

    #sidebar { 
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-right: 1px solid rgba(255, 255, 255, 0.2);
    }

    #sidebar .nav-link { 
      color: #667eea;
      transition: var(--transition);
      border-radius: 12px;
      margin: 4px 8px;
    }

    #sidebar .nav-link:hover {
      background: var(--primary-gradient);
      color: white;
      transform: translateX(8px);
    }

    #sidebar .nav-link.active { 
      background: var(--primary-gradient);
      color: white;
      font-weight: 600;
      box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
    }

    .main {
      background: transparent;
    }

    .pagetitle h1 {
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
      font-size: 2.5rem;
    }

    .breadcrumb {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 25px;
      padding: 12px 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .breadcrumb-item a { 
      color: #fff;
      text-decoration: none;
      transition: var(--transition);
    }

    .breadcrumb-item a:hover {
      color: #f093fb;
    }

    .breadcrumb-item.active { 
      color: rgba(255, 255, 255, 0.8);
    }

    /* Advanced Card Styling */
    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: var(--transition);
      overflow: hidden;
      position: relative;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--primary-gradient);
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: var(--hover-shadow);
    }

    .card-header {
      background: var(--primary-gradient) !important;
      border: none;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    .card-header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .card-header h4 {
      position: relative;
      z-index: 2;
      margin: 0;
      font-weight: 600;
      text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-body {
      padding: 30px;
      position: relative;
    }

    /* Advanced List Group Styling */
    .list-group-item {
      background: rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px !important;
      margin-bottom: 8px;
      transition: var(--transition);
      backdrop-filter: blur(10px);
    }

    .list-group-item:hover {
      background: rgba(255, 255, 255, 0.8);
      transform: translateX(5px);
    }

    /* Advanced Wallet Dropdown Styling */
    .wallet-dropdown {
      position: relative;
      margin-bottom: 20px;
    }

    .wallet-selected {
      background: rgba(255, 255, 255, 0.9);
      border: 2px solid transparent;
      border-radius: 15px;
      padding: 15px 20px;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .wallet-selected:hover {
      border-color: #667eea;
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(102, 126, 234, 0.2);
    }

    .wallet-options {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.2);
      z-index: 1000;
      display: none;
      max-height: 300px;
      overflow-y: auto;
      margin-top: 8px;
    }

    .wallet-item, .wallet-item-owner {
      padding: 15px 20px;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .wallet-item:hover, .wallet-item-owner:hover {
      background: var(--primary-gradient);
      color: white;
      transform: translateX(8px);
    }

    .wallet-item:last-child, .wallet-item-owner:last-child {
      border-bottom: none;
    }

    .wallet-item.active-wallet, .wallet-item-owner.active-wallet {
      background: var(--success-gradient);
      color: white;
    }

    .wallet-icon {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      margin-right: 12px;
      object-fit: cover;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Advanced Form Styling */
    .form-control {
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 12px;
      padding: 15px 20px;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      transition: var(--transition);
      font-size: 16px;
    }

    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      background: rgba(255, 255, 255, 1);
      transform: translateY(-2px);
    }

    .form-label {
      font-weight: 600;
      color: #2c3e50;
      margin-bottom: 8px;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Advanced Button Styling */
    .btn-primary {
      background: var(--primary-gradient);
      border: none;
      border-radius: 12px;
      padding: 15px 30px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: var(--transition);
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
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    /* Advanced Footer Styling */
    .footer {
      background: rgba(0, 0, 0, 0.8) !important;
      backdrop-filter: blur(20px);
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.8);
    }

    .footer a {
      color: #667eea;
      transition: var(--transition);
    }

    .footer a:hover {
      color: #f093fb;
      text-decoration: none;
    }

    /* Advanced Back to Top Button */
    .back-to-top {
      background: var(--primary-gradient) !important;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
      transition: var(--transition);
    }

    .back-to-top:hover {
      transform: translateY(-5px) scale(1.1);
      box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
    }

    /* Advanced Animations */
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

    .card {
      animation: fadeInUp 0.6s ease-out;
    }

    /* Advanced Responsive Design */
    @media (max-width: 768px) {
      .card-body { 
        padding: 20px; 
      }
      
      .pagetitle h1 {
        font-size: 2rem;
      }
      
      .wallet-selected {
        padding: 12px 16px;
      }
      
      .form-control {
        padding: 12px 16px;
      }
    }

    /* Advanced Scrollbar Styling */
    .wallet-options::-webkit-scrollbar {
      width: 6px;
    }

    .wallet-options::-webkit-scrollbar-track {
      background: rgba(0,0,0,0.1);
      border-radius: 3px;
    }

    .wallet-options::-webkit-scrollbar-thumb {
      background: var(--primary-gradient);
      border-radius: 3px;
    }

    .wallet-options::-webkit-scrollbar-thumb:hover {
      background: var(--secondary-gradient);
    }

    /* Advanced Text Styling */
    .text-primary {
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 600;
    }

    .fw-bold {
      font-weight: 700;
    }

    .text-secondary {
      color: #6c757d;
      font-weight: 500;
    }

    /* Advanced Border Styling */
    .border-top {
      border-top: 2px solid rgba(102, 126, 234, 0.2) !important;
      padding-top: 20px;
      margin-top: 20px;
    }

    /* Advanced Success Message Styling */
    .text-success {
      color: #28a745;
      font-weight: 600;
      text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* Advanced Error Message Styling */
    .text-danger {
      color: #dc3545;
      font-weight: 500;
      font-size: 12px;
    }

    /* Advanced Input Group Styling */
    .input-group-text {
      background: var(--primary-gradient);
      color: white;
      border: none;
      border-radius: 12px 0 0 12px;
    }
  </style>
</head>

<body>

  <!-- =======================================================
  * Folder Super/Admin
  ======================================================== -->
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
        <div class="col-md-5"></div>

        <div class="col-md-6">
  <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    
    <div class="card-header bg-primary text-white text-center py-3">
      <h4 class="fw-bold m-0">Order Summary</h4>
    </div>

    <div class="card-body p-4">

      <p class="text-center text-success fw-semibold mb-3"><?= $CommonOBJ->proceedCheckOut(); ?></p>

      <form class="form" method="post" id="userForm" enctype="multipart/form-data">

        <!-- Price breakdown -->
        <ul class="list-group list-group-flush mb-4">

          <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <span class="text-secondary">Total Price</span>
            <span class="fw-bold text-dark">
              <?= $_GET['tPrice']; ?> ETB
            </span>
          </li>

          <input type="hidden" name="totalPrice" value="<?= $_GET['tPrice']; ?>">
          <input type="hidden" name="payerName" value="<?= $fullname; ?>">
          <input type="hidden" name="payerEmail" value="<?= $_SESSION['sessionID']; ?>">
          <input type="hidden" class="form-control" id="email" value="<?=$cid; ?>"   name="cid">

          <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <span class="text-secondary">Price</span>
            <span class="fw-bold text-dark"><?= $_GET['tPrice']; ?> ETB</span>
            <input type="hidden" name="Fee" value="<?= $_GET['tPrice']; ?>">
          </li>
        </ul>

        <!-- Total Section -->
        <div class="border-top pt-3">
          <div class="d-flex justify-content-between align-items-center fw-bold h5">
            <span>Total</span>
            <span class="text-primary"><?= $_GET['tPrice']; ?> ETB</span>
          </div>
        </div>

       <?php 

          $ocid = $_GET['ocid'];
          $dataQOW = $CommonOBJ->getOwnerDetail($ocid);
          foreach ($dataQOW as $key => $dataQOW) {
            // code...
            $email = $dataQOW['email'];
          }
       ?>

      <div>
      <!-- here -->
        <div class="wallet-dropdown">
          <div class="wallet-selected" id="walletDisplayOwner">
              <img src="" id="walletIconOwner" class="wallet-icon">
              <span id="walletTextOwner">Select Wallet / Bank</span>
          </div>
         <?php
                $dataQBn = $CommonOBJ->getBindAccount($email);

                if ($dataQBn) {
                ?>

                <div class="wallet-options" id="walletOptionsOwner">

                <?php
                    foreach ($dataQBn as $values) {

                        $bank = strtolower($values['bank_name']);
                        $logo = "";

                        if ($bank === "mpessa") $logo = "../files/bnlogos/mpessa.png";
                        if ($bank === "awash")  $logo = "../files/bnlogos/awash.jfif";
                        if ($bank === "dashen") $logo = "../files/bnlogos/dashen.png";
                        if ($bank === "cbe")    $logo = "../files/bnlogos/cbe1.jfif";
                        if ($bank === "tellbirr")  $logo = "../files/bnlogos/telebirr.png";
                        if ($bank === "wegagen")  $logo = "../files/bnlogos/wegagen.png";
                        if ($bank === "nib")  $logo = "../files/bnlogos/nib.jpg";
                ?>
                    
                    <div class="wallet-item-owner"
                         data-value="<?= htmlspecialchars($values['bank_name']); ?>"
                         data-img="<?= $logo; ?>">

                        <img src="<?= $logo; ?>" style="height:30px; width: 60px; margin-right:8px;">
                        <?= htmlspecialchars($values['bank_name']); ?>

                    </div>

                <?php
                    } // end foreach
                ?>
                </div>

                <?php
                } // end if
                ?>
          <input type="hidden" name="walletSelectOwner" id="walletInpuOwner">
          <input type="hidden" name="walletSelectOwner" id="walletSelectOwner">
          <input type="hidden" name="ownerEmail" value="<?=$email; ?>">
      </div>


<script>
document.getElementById("walletDisplayOwner").onclick = function () {
    document.getElementById("walletOptionsOwner").style.display =
        document.getElementById("walletOptionsOwner").style.display === "block"
            ? "none"
            : "block";
};

document.querySelectorAll(".wallet-item-owner").forEach(item => {
    item.onclick = function () {
        let img = this.getAttribute("data-img");
        let text = this.innerText;
        let value = this.getAttribute("data-value");

        document.getElementById("walletIconOwner").src = img;
        document.getElementById("walletIconOwner").style.display = "inline-block";
        document.getElementById("walletTextOwner").innerText = text;

        document.getElementById("walletInpuOwner").value = value;
        document.getElementById("walletOptionsOwner").style.display = "none";
    };
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const items = document.querySelectorAll(".wallet-item-owner");
    const input = document.getElementById("walletSelectOwner");

    items.forEach(item => {
        item.addEventListener("click", function () {

            // remove previous selected
            items.forEach(i => i.classList.remove("active-wallet"));

            // set new selected
            this.classList.add("active-wallet");

            // store value to hidden input
            input.value = this.getAttribute("data-value");
        });
    });

});
</script>

      </div>

      <div class="mt-4">

        <div class="wallet-dropdown">
          <div class="wallet-selected" id="walletDisplay">
              <img src="" id="walletIcon" class="wallet-icon">
              <span id="walletText">Select Wallet / Bank</span>
          </div>
         <?php
                $dataQBn = $CommonOBJ->getBindAccount($_SESSION['sessionID']);

                if ($dataQBn) {
                ?>

                <div class="wallet-options" id="walletOptions">

                <?php
                    foreach ($dataQBn as $values) {

                        $bank = strtolower($values['bank_name']);
                        $logo = "";

                        if ($bank === "mpessa") $logo = "../files/bnlogos/mpessa.png";
                        if ($bank === "awash")  $logo = "../files/bnlogos/awash.jfif";
                        if ($bank === "dashen") $logo = "../files/bnlogos/dashen.png";
                        if ($bank === "cbe")    $logo = "../files/bnlogos/cbe1.jfif";
                        if ($bank === "tellbirr")  $logo = "../files/bnlogos/telebirr.png";
                        if ($bank === "wegagen")  $logo = "../files/bnlogos/wegagen.png";
                        if ($bank === "nib")  $logo = "../files/bnlogos/nib.jpg";
                ?>
                    
                    <div class="wallet-item"
                         data-value="<?= htmlspecialchars($values['bank_name']); ?>"
                         data-img="<?= $logo; ?>">

                        <img src="<?= $logo; ?>" style="height:30px; width: 60px; margin-right:8px;">
                        <?= htmlspecialchars($values['bank_name']); ?>

                    </div>

                <?php
                    } // end foreach
                ?>
                </div>

                <?php
                } // end if
                ?>

          <input type="hidden" name="walletSelect" id="walletInput">
          <input type="hidden" name="walletSelect" id="walletSelect">
          <input type="hidden" class="form-control" name="ocid" id="qty" value="<?=$_GET['ocid']; ?>">
          <input type="hidden" class="form-control" name="reqid" value="<?=$_GET['rid']; ?>">
          <input type="hidden" name="Fee" value="<?= $_GET['tPrice']; ?>">
          <input type="hidden" name="payerName" value="<?= $fullname; ?>">
          <input type="hidden" name="payerEmail" value="<?= $_SESSION['sessionID']; ?>">
          <input type="hidden" class="form-control" value="<?=$phone; ?>" name="phone">
          <input type="hidden" class="form-control" value="<?=$cid; ?>" name="cid">

      </div>

       <!-- Account Input -->
        <div class="mt-4">
          <label for="cbe" class="form-label fw-semibold">Account Number <span class="text-danger">*</span></label>
          <input 
            type="number" 
            id="acnumber" 
            name="acnumber" 
            class="form-control form-control-lg shadow-sm" 
            placeholder="10000000******"
            style="height: 38px; font-size: 12px;"
          >
          <span class="text-danger small" id="spanError-acnumber"></span>
          <span class="text-success small" id="spanError-cbecounter"></span>
        </div>
    </div>

        <!-- Checkout Button -->
        <button 
          class="btn btn-primary btn-sm w-100 mt-3 py-2 fw-bold rounded-3 shadow-sm" 
          id="PayOut" 
          name="proceedCheckOut"
          style="font-size: 16px; letter-spacing: .5px;"
        >
          Proceed to Checkout
        </button>

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
  <!-- Template Main JS File -->
  <script src="../dashboard/assets/js/main.js"></script>
  <script src="../dashboard/assets\ajax\jquery-2.2.4.min.js"></script>
  <script src="../dashboard/assets\ajax\jquery.js"></script>
  <script src="../dashboard/assets\ajax\jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  // Helper: validate a field and show error message
  function validateField(fieldSelector, errorSelector, validator) {
    const $field = $(fieldSelector);
    const $error = $(errorSelector);
    const value = ($field.val() || '').toString().trim();
    const res = validator(value);

    if (res.valid) {
      $field.css("border-color", "green");
      $error.text('');
    } else {
      $field.css("border-color", "red");
      $error.text(res.message);
    }
    return res.valid;
  }

  // Validators
  const notEmptyValidator = (fieldName) => (val) => ({
    valid: val !== '',
    message: `* ${fieldName} is required.`
  });

  const acNumberValidator = (val) => {
    if (val === '') {
      return { valid: false, message: '* Account number is required.' };
    }
    // check digits only and minimum length - adjust minLen if needed
    const digitsOnly = /^\d+$/;
    const minLen = 8;
    if (!digitsOnly.test(val)) {
      return { valid: false, message: '* Account number must contain digits only.' };
    }
    if (val.length < minLen) {
      return { valid: false, message: `* Account number must be at least ${minLen} digits.` };
    }
    return { valid: true, message: '' };
  };

  // Inline validation events (live feedback)
  $('#acnumber').on('input blur', function() {
    validateField('#acnumber', '#spanError-acnumber', acNumberValidator);
  });

  // Validate on form submit
  $('#userForm').on('submit', function (e) {
    const validAc = validateField('#acnumber', '#spanError-acnumber', acNumberValidator);

    if (!validAc) {
      e.preventDefault(); // stop submission
      // optionally focus first invalid field
      $('#acnumber').focus();
      return false;
    }
    // if all valid, let the form submit naturally
  });
});
</script>

<script>
// document.addEventListener("DOMContentLoaded", function() {
//     const select = document.getElementById("walletSelect");

//     for (let i = 0; i < select.options.length; i++) {
//         const option = select.options[i];
//         const icon = option.getAttribute("data-icon");
//         if (icon) {
//             option.style.backgroundImage = `url('${icon}')`;
//         }
//     }
// });
</script>
<script>
document.getElementById("walletDisplay").onclick = function () {
    document.getElementById("walletOptions").style.display =
        document.getElementById("walletOptions").style.display === "block"
            ? "none"
            : "block";
};

document.querySelectorAll(".wallet-item").forEach(item => {
    item.onclick = function () {
        let img = this.getAttribute("data-img");
        let text = this.innerText;
        let value = this.getAttribute("data-value");

        document.getElementById("walletIcon").src = img;
        document.getElementById("walletIcon").style.display = "inline-block";
        document.getElementById("walletText").innerText = text;

        document.getElementById("walletInput").value = value;
        document.getElementById("walletOptions").style.display = "none";
    };
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const items = document.querySelectorAll(".wallet-item");
    const input = document.getElementById("walletSelect");

    items.forEach(item => {
        item.addEventListener("click", function () {

            // remove previous selected
            items.forEach(i => i.classList.remove("active-wallet"));

            // set new selected
            this.classList.add("active-wallet");

            // store value to hidden input
            input.value = this.getAttribute("data-value");
        });
    });

});
</script>



</body>

</html>
 