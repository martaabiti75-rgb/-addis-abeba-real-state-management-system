
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
  <title>Lounge Service System - Wolaita Sodo University</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../assets/img/wsu.png" rel="icon">
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
        <span class="d-none d-lg-block">LLS - <i class="bi bi-cart-fill"></i></span>
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

          <li class="list-group-item d-flex justify-content-between align-items-center py-3">
            <span class="text-secondary">Price</span>
            <span class="fw-bold text-dark"><?= $_GET['tPrice']; ?> ETB</span>
            <input type="hidden" name="Fee" value="<?= $_GET['tPrice']; ?>">
            <input type="hidden" name="Quantity" value="<?= $_GET['tQty']; ?>">
          </li>
        </ul>

        <!-- Total Section -->
        <div class="border-top pt-3">
          <div class="d-flex justify-content-between align-items-center fw-bold h5">
            <span>Total</span>
            <span class="text-primary"><?= $_GET['tPrice']; ?> ETB</span>
          </div>
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
      &copy; Copyright <strong><span>WSU Lounge Service System</span></strong>.All right reserved.
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
 