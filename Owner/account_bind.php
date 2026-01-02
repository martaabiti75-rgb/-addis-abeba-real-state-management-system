
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
        $phone = $value['phone_number'];
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
  <!-- Custom CSS -->
  <style>
    body { font-family: 'Open Sans', sans-serif; background-color: #a0b4c1ff; color: #343a40; }
    .header { background-color: #004aad; color: #cad6e6ff; }
    .header .logo img { border-radius: 50%; }
    #sidebar { background-color: #c5dcebff; }
    #sidebar .nav-link { color: #49a6edff; }
    #sidebar .nav-link.active { background-color: #004aad; font-weight: bold; }
    .card { border-radius: 12px; box-shadow: 0 5px 20px rgba(6, 6, 6, 0.1); border: none; }
    .card-body h5.card-title { font-weight: 600; color: #004aad; }
    input.form-control, select.form-select { border-radius: 6px; border: 1px solid #407cb8ff; padding: 8px 12px; transition: 0.3s; }
    input.form-control:focus, select.form-select:focus { border-color: #004aad; box-shadow: 0 0 5px rgba(0,74,173,0.3); outline: none; }
    .input-group-text { background-color: #4298edff; border-radius: 6px 0 0 6px; border: 1px solid #ced4da; color: #495057; }
    button.btn-primary { background-color: #004aad; border-color: #004aad; border-radius: 8px; font-weight: 600; transition: 0.3s; }
    button.btn-primary:hover { background-color: #00338a; border-color: #00338a; }
    span.spanError { font-size: 13px; margin-top: 3px; display: block; }
    .show { cursor: pointer; background-color: #395e84ff; border-left: 1px solid #3a6fa4ff; border-radius: 0 6px 6px 0; padding: 8px 12px; }
    .bi-eye, .bi-eye-slash { font-size: 18px; color: #9dc2e6ff; }
    .breadcrumb { background: none; padding: 0; margin-bottom: 10px; }
    .breadcrumb-item a { color: #004aad; }
    .breadcrumb-item.active { color: #2c84dcff; }
    footer.footer { background-color: #1c7ea8ff; padding: 20px 0; text-align: center; border-top: 1px solid #dee2e6; font-size: 14px; color: #6c757d; }
    footer.footer a { color: #004aad; text-decoration: none; }
    footer.footer a:hover { text-decoration: underline; }
    .back-to-top { position: fixed; right: 20px; bottom: 20px; background-color: #004aad; color: #fff; width: 40px; height: 40px; border-radius: 50%; text-align: center; line-height: 40px; font-size: 20px; display: none; z-index: 9999; }
    .back-to-top:hover { background-color: #00338a; }
    @media (max-width: 768px) {
        .card-body { padding: 15px; }
        .header .logo img { max-width: 50px; max-height: 50px; }
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

        <!-- <div class="col-md-3"></div> -->
        <div class="col-md-5"></div>
<div class="col-lg-6 d-flex flex-column align-items-center justify-content-center pt-4">
  <div class="card shadow-sm border-0 rounded-3 w-100" style="max-width: 480px;">
    <div class="card-body p-4">

      <!-- Title -->
      <h5 class="card-title text-center pb-3 fw-bold fs-4">Bind Account</h5>

      <!-- Info Marquee -->
      <div class="mb-3">
        <marquee behavior="scroll" direction="left" scrollamount="5" style="color:#555; font-size:14px; font-weight:500;">
          ⚠️ This account binding section is for <strong>testing purposes only</strong>. Use any sample or demo account number to simulate linking an account — no real financial data is stored.
        </marquee>
      </div>

      <!-- Error / Success Messages -->
      <p class="text-center text-success spanError errorALL mb-3"><?= $CommonOBJ->isBindAccount(); ?></p>

      <!-- Form -->
      <form class="needs-validation" novalidate method="post" action="" id="forms">

        <!-- Email -->
        <input type="hidden" name="email" class="form-control" id="email" value="<?= $_SESSION['sessionID']; ?>" readonly>
        <input type="hidden" name="fullname" value="<?= $fullname; ?>">
        <input type="hidden" name="phone" value="<?= $phone; ?>">

        <div class="mb-3">
          <label class="form-label fw-semibold">Select Bank *</label>

          <div class="d-flex flex-wrap gap-3">
            <!-- Bank Logos -->
            <div class="bank-option" data-bank="CBE">
              <img src="../files/bnlogos/cbe1.jfif" alt="CBE" style="height:50px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;">CBE</p>
            </div>

            <div class="bank-option" data-bank="Awash">
              <img src="../files/bnlogos/awash.jfif" alt="Awash" style="height:50px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;">Awash</p>
            </div>

            <div class="bank-option" data-bank="Dashen">
              <img src="../files/bnlogos/dashen.png" alt="Dashen" style="height:50px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;">Dashen</p>
            </div>

            <div class="bank-option" data-bank="Abyssinia">
              <img src="../files/bnlogos/absy.png" alt=" Abyssinia" style="height:50px; width: 60px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;"> Abyssinia</p>
            </div>

            <div class="bank-option" data-bank="Mpessa">
              <img src="../files/bnlogos/mpessa.png" alt=" Mpessa" style="height:50px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;"> Mpessa</p>
            </div>

             <div class="bank-option" data-bank="Wegagen">
              <img src="../files/bnlogos/Wegagen.png" alt=" Wegagen" style="height:50px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;"> Wegagegn</p>
            </div>

             <div class="bank-option" data-bank="NIB">
              <img src="../files/bnlogos/NIB.JPG" alt=" NIB" style="height:50px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;"> NIB</p>
            </div>

              <div class="bank-option" data-bank="COOP">
              <img src="../files/bnlogos/COOP.png" alt=" COOP" style="height:50px; width: 60px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;"> COOP</p>
            </div>


            <div class="bank-option" data-bank="TellBirr">
              <img src="../files/bnlogos/telebirr.png" alt="TellBirr" style="height:50px; width: 60px; cursor:pointer;">
              <p class="text-center mt-1" style="font-size:12px;">TelBirr</p>
            </div>
            
            <!-- Add more banks similarly -->
          </div>

          <!-- Hidden input to store selected bank -->
          <input type="hidden" name="bankName" id="bankName">

          <span class="text-danger" id="spanError-bank" style="font-size:13px;"></span>
        </div>

        <script>
          const bankOptions = document.querySelectorAll('.bank-option');
          const bankInput = document.getElementById('bankName');

          bankOptions.forEach(option => {
              option.addEventListener('click', function() {
                  // Remove selected highlight from all
                  bankOptions.forEach(o => o.querySelector('img').style.border = 'none');

                  // Highlight selected bank
                  this.querySelector('img').style.border = '2px solid #0d6efd';
                  this.querySelector('img').style.borderRadius = '5px';

                  // Set hidden input value
                  bankInput.value = this.getAttribute('data-bank');
              });
          });
        </script>

        <!-- CBE Account Number -->
        <div class="mb-3">
          <label for="cbe" class="form-label fw-semibold">Account Number *</label>
          <input 
            type="number" 
            id="cbe" 
            class="form-control form-control-sm" 
            name="accountNumber"
            placeholder="Enter account number" 
            style="padding: 6px 12px; font-size: 14px; height: 42px;"
            required
          >
          <span id="spanError-cbe" class="text-danger" style="font-size:13px;"></span>
          <span id="spanError-cbecounter" class="text-success" style="font-size:13px;"></span>
        </div>

        <!-- Submit Button -->
        <div class="d-grid mt-3">
          <button class="btn btn-primary btn-md shadow-sm" type="submit" name="isBindAccount" id="isBindAccount">
            <i class="bi bi-link-45deg me-2"></i> Bind Account
          </button>
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
        <script>
$(document).ready(function () {
    
    // === PASSWORD VALIDATION FUNCTION ===
    function validatecbe() {
        let cbe = $("#cbe").val().trim();
        if (cbe === "") {
            $("#spanError-cbe").text("* Acount Number is required.");
            $("#cbe").css("border-color", "red");
            return false;
        } else {
            $("#spanError-cbe").text("");
            $("#cbe").css("border-color", "green");
            return true;
        }
    }

    // Inline validation triggers
    $("#cbe").on("blur keyup", validatecbe);

    // Form submission validation
    $("#forms").on("submit", function(event) {
        let iscbeValid = validatecbe();

        if (!iscbeValid) {
            event.preventDefault(); // Stop form submission if invalid
        }
    });

});
</script>
  <script>
  const cbeInput = document.getElementById('cbe');
  const spanError = document.getElementById('spanError-cbecounter');

  cbeInput.addEventListener('input', function() {
    const count = this.value.length;
    
    // Display the count
    spanError.textContent = `Digits entered: ${count}`;

    // Optional: Validation for required length (e.g., 13 digits)
    if (count > 0 && count < 13) {
      spanError.style.color = 'red';
    } else if (count > 0) {
      spanError.textContent = "✅ Valid CBE account number";
      spanError.style.color = 'green';
    } else if (count > 13) {
      spanError.textContent = "⚠️ Too many digits (must be 13)";
      spanError.style.color = 'orange';
    } else {
      spanError.textContent = "";
    }
  });
</script>

<script>
  const bankSelect = document.getElementById('bankSelect');
  const bankLogoPreview = document.getElementById('bankLogoPreview').querySelector('img');

  bankSelect.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const logoSrc = selectedOption.getAttribute('data-logo');

      if(logoSrc) {
          bankLogoPreview.src = logoSrc;
          bankLogoPreview.style.display = 'inline-block';
      } else {
          bankLogoPreview.style.display = 'none';
      }
  });
</script>
</body>

</html>