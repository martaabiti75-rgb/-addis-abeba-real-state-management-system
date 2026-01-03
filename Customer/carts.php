
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
  <link href="cart.css" rel="stylesheet">
  <!-- Custom CSS -->
<style>
  body { font-family: 'Open Sans', sans-serif; background-color: #f7f8f9ff; color: #343a40; }
  .header { background-color: #004aad; color: #0c2338ff; }
  .header .logo img { border-radius: 50%; }
  #sidebar { background-color: #1a1f36; }
  #sidebar .nav-link { color: #5998aaff; }
  #sidebar .nav-link.active { background-color: #004aad; font-weight: bold; }
  .card { border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border: none; margin-bottom: 20px; }
  .card .card-title { font-weight: 600; color: #6585c6ff; }
  .card-icon { background-color: #2162a4ff; color: #004aad; width: 50px; height: 50px; font-size: 24px; }
  .breadcrumb { background: none; padding: 0; margin-bottom: 10px; }
  .breadcrumb-item a { color: #004aad; }
  .breadcrumb-item.active { color: #495057; }
  .alert { border-radius: 10px; font-weight: 500; }
  footer.footer { background-color: #4d85bcff; padding: 20px 0; text-align: center; border-top: 1px solid #dee2e6; font-size: 14px; color: #6c757d; }
  footer.footer a { color: #0f3141ff; text-decoration: none; }
  footer.footer a:hover { text-decoration: underline; }
  .back-to-top { position: fixed; right: 20px; bottom: 20px; background-color: #d4d9e0ff; color: #fff; width: 40px; height: 40px; border-radius: 50%; text-align: center; line-height: 40px; font-size: 20px; display: none; z-index: 9999; }
  .back-to-top:hover { background-color: #0d5977ff; }
  @media (max-width: 768px) {
      .card-body { padding: 15px; }
      .header .logo img { max-width: 50px; max-height: 50px; }
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
                  <h5 class="card-title">Active Carts <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart-fill"></i>
                    </div>
                    

                     <?php

                      $param = 1;
                      $param2 = $cid;
                      $CartQuantity = $isPerformCustOBJ->getCartQuantity($param,$param2);
                      ?>
                    <div class="ps-3">
                     <h6><?= $Q = $CartQuantity ? $CartQuantity : 0  ?></h6>

                    </div>
                  </div>
              </div>

            </div>
          </div><!-- End Total Fans Card -->

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
                <h5 class="card-title">Total Real State Room <span>| This Year</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-house"></i>

                  </div>
                  <div class="ps-3">
                    <?php
                          $QtyAdmins = $CommonOBJ->getTotalProperty();
                    ?>
                    <h6><?= $Q = $QtyAdmins ? $QtyAdmins : 0  ?></h6>
                    <span class="text-muted small pt-2 ps-1">Total Real State Room</span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Admins Card -->

        </div>

        <!-- Active Carts -->
<div class="col-md-12">
  <div class="card shadow-sm border-0">

    <div class="card-body pb-0">
      
      <h5 class="card-title mb-3">
        <i class="bi bi-cart-check text-primary me-2"></i>
        Active Carts 
        <span class="text-muted" style="font-size: 13px;">| Today</span>
      </h5>

      <!-- Messages -->
      <p class="text-success text-center fw-bold mb-2" id="pError">
        <?= $isPerformCustOBJ->removeCart(); ?>
      </p>

      <p class="text-success text-center fw-bold mb-3" id="pError">
        <?= $isPerformCustOBJ->checkOut(); ?>
      </p>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="bg-primary text-white">
            <tr>
              <th>No</th>
              <th>Block</th>
              <th>Floor</th>
              <th>Size</th>
              <th>Room Size</th>
              <th>Owner</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody class="table-group-divider">
            <?php 
              $parameter = 1;
              $parameter2 = $cid;
              $dataCartList = $isPerformCustOBJ->getActiveCart($parameter,$parameter2);
              $rowCartList  = $isPerformCustOBJ->getActiveCart($parameter,$parameter2);

              $totalSum = 0;
              if ($rowCartList > 0) {
                foreach ($dataCartList as $value) { 
                  $totalSum += $value['sale_price']; 
            ?>

              <tr>
                <td>
                  <span class="badge bg-secondary"><?= $value['req_room_no']; ?></span>
                </td>

                <td>
                  <img src="../files/rooms/<?= $value['block_url']; ?>" 
                       class="rounded shadow-sm"
                       style="width: 80px; height: 80px; object-fit: cover;">
                </td>

                <td><span class="fw-semibold text-primary"><?= $value['req_block']; ?></span></td>
                <td><?= $value['req_floor']; ?></td>
                <td class="fw-bold"><?= $value['room_size']; ?></td>
                <td class="fw-bold"><?= $value['oname']; ?></td>

                <td>
                  <form action="" method="post" class="d-inline">
                    <input type="hidden" name="cartid" value="<?= $value['req_id']; ?>">
                    <input type="hidden" name="req_room_id" value="<?= $value['req_room_id']; ?>">
                    <input type="hidden" name="RollBackQty" value="1">

                    <button type="submit" name="removeCart" 
                            class="btn btn-danger btn-sm rounded-pill px-3">
                      <i class="bi bi-x-circle"></i> Remove
                    </button>
                  </form>
                </td>
              </tr>

            <?php } } ?>

            <!-- Total Row -->
            <tr class="bg-light fw-bold">
              <td colspan="7" class="text-end">
                Total: <span class="text-primary"><?= $totalSum; ?> ETB</span>
              </td>
            </tr>

            <!-- Checkout Button -->
            <tr>
              <td colspan="7" class="text-end">

              <?php if ($totalSum > 0 && $value['res_status'] == 0) { ?>
                
                <a href="#" class="btn btn-warning btn-sm rounded-pill px-4">
                  <i class="bi bi-clock-history"></i> Waiting Approval
                </a>

              <?php } elseif ($totalSum > 0 && $value['res_status'] == 1) { ?>

                <a href="payout.php?tPrice=<?= $totalSum; ?>&ocid=<?= $value['oid']; ?>&rid=<?= $value['req_id']; ?>"
                   class="btn btn-success btn-sm rounded-pill px-4">
                  <i class="bi bi-credit-card"></i> CheckOut
                </a>

              <?php } else { ?>

                <a href="#" class="btn btn-secondary btn-sm rounded-pill px-4">
                  No Checkout Available
                </a>

              <?php } ?>

              </td>
            </tr>

          </tbody>
        </table>
      </div>

    </div>

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

<div class="modal fade" id="trashModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title text-danger">Remove Item from Your Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          Are you sure you want to <b>remove</b> 
          <span id="trash-item-name"></span> from your cart?
        </div>

        <div class="modal-footer">
          <input type="hidden" name="generatedCode" id="trash-email">
          <input type="hidden" name="cartID" id="trash-cart-id"><!-- FIXED -->
          <input type="hidden" name="methodName" value="trashCarts">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="trashCarts" class="btn btn-danger">Remove</button>
        </div>
      </form>
    </div>
  </div>
</div>




<script>

  document.querySelectorAll('.btn-open-remove').forEach(button => {
    button.addEventListener('click', function () {

        const code   = this.getAttribute('data-email');
        const cartID = this.getAttribute('data-cart');
        const name   = this.getAttribute('data-name');

        document.getElementById("trash-email").value = code;
        document.getElementById("trash-cart-id").value = cartID;
        document.getElementById("trash-item-name").textContent = name;

        new bootstrap.Modal(document.getElementById('trashModal')).show();
    });
});

  // -------------------------
</script>
</body>

</html>