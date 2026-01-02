<?php 

  session_start();
  if (isset($_SESSION['sessionID'])) {
    // code...
  }else{
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
  }

  require __DIR__.'/performAdminAction.php';
  $isPerformAdminOBJ = new isPerformAdminAction();
  require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
  $CommonOBJ = new CommonFunction();

  $dataQ = $isPerformAdminOBJ->getSessionUser($_SESSION['sessionID']);
  $rowQ = $isPerformAdminOBJ->getSessionUser($_SESSION['sessionID']);
      foreach ($dataQ as $key => $value) {
        // code...
        $fullname = $value['fullname'];
        $role = $value['role'];
        $AccountState = $value['account_status'];
        $url = $value['profile_picture_url'];
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>eTrade <?=$role; ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../dashboard/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../dashboard/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../dashboard/vendors/css/vendor.bundle.addons.css">

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
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../dashboard/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="http://www.urbanui.com/" />
  
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <!-- Navbar -->

    <?php require __DIR__.'/header.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
       <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div> 
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <!-- nabbar -->

      <?php require 'navbar.php'; ?>


      <!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Change Password Here !
            </h3>
          </div>

          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">የይለፍ ቃልን እዚህ ቀይር!</h4>
      <p class="card-description">
        የአሁኑ የይለፍ ቃልዎን በመቀየር አዲስ የይለፍ ቃል ያስገቡ።
      </p>
      <p class="text-center text-success spanError"><?= $CommonOBJ->isChangePassword(); ?></p>

      <form class="forms-sample" id="userForm" action="" method="post">
        
        <div class="form-group">
          <label for="exampleInputEmail1">የኢሜይል አድራሻ</label>
          <input type="email" class="form-control" id="email" placeholder="የኢሜይል አድራሻ" name="email" value="<?=$_SESSION['sessionID']; ?>">
          <span class="text-danger" id="spanError-email"></span>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">የድሮ የይለፍ ቃል</label>
          <input type="password" class="form-control" id="oldpassword" placeholder="የድሮ የይለፍ ቃል" name="oldpassword">
          <span class="text-danger" id="spanError-oldpassword"></span>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">አዲስ የይለፍ ቃል</label>
          <input type="password" class="form-control" id="newpassword" placeholder="አዲስ የይለፍ ቃል" name="newpassword">
          <span class="text-danger" id="spanError-newpassword"></span>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">አዲሱን የይለፍ ቃል ይድገሙ እና ያረጋግጡ</label>
          <input type="password" class="form-control" id="confirmpassword" placeholder="የይለፍ ቃል አረጋጋጭ" name="conpassword">
          <span class="text-danger" id="spanError-confirmpassword"></span>
        </div>

        <button type="submit" class="btn btn-primary mr-2" name="ChangePasswordMethod">ቀይር</button>
        <button class="btn btn-light" type="reset">ሰርዝ</button>
      </form>
    </div>
  </div>
</div>

          </div>

    


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
             የቅጂ መብት © 2018. ሁሉም መብቶች የተጠበቁ ናቸው.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">የወላይታ ሶዶ ዩኒቨርሲቲ የኢንፎርሜሽን ቴክኖሎጂ ተማሪዎች<i class="far fa-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../dashboard/vendors/js/vendor.bundle.base.js"></script>
  <script src="../dashboard/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../dashboard/js/off-canvas.js"></script>
  <script src="../dashboard/js/hoverable-collapse.js"></script>
  <script src="../dashboard/js/misc.js"></script>
  <script src="../dashboard/js/settings.js"></script>
  <script src="../dashboard/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../dashboard/js/dashboard.js"></script>
  <script src="../dashboard/js/data-table.js"></script>
  <!-- End custom js for this page-->

  
    <script>
$(document).ready(function () {

    // Email regex function
    function isValidEmail(email) {
        const re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return re.test(String(email).toLowerCase());
    }


    // === PASSWORD VALIDATION FUNCTION ===
    function validateoldpassword() {
        let oldpassword = $("#oldpassword").val().trim();
        if (oldpassword === "") {
            $("#spanError-oldpassword").text("* oldpassword is required.");
            $("#oldpassword").css("border-color", "red");
            return false;
        } else if (oldpassword.length < 6) {
            $("#spanError-oldpassword").text("* oldpassword must be at least 6 characters.");
            $("#oldpassword").css("border-color", "red");
            return false;
        } else {
            $("#spanError-oldpassword").text("");
            $("#oldpassword").css("border-color", "green");
            return true;
        }
    }

       // === PASSWORD VALIDATION FUNCTION ===
    function validatenewpassword() {
        let newpassword = $("#newpassword").val().trim();
        if (newpassword === "") {
            $("#spanError-newpassword").text("* newpassword is required.");
            $("#newpassword").css("border-color", "red");
            return false;
        } else if (newpassword.length < 6) {
            $("#spanError-newpassword").text("* newpassword must be at least 6 characters.");
            $("#newpassword").css("border-color", "red");
            return false;
        } else {
            $("#spanError-newpassword").text("");
            $("#newpassword").css("border-color", "green");
            return true;
        }
    }

         // === PASSWORD VALIDATION FUNCTION ===
    function validatenewpassword() {
        let newpassword = $("#newpassword").val().trim();
        if (newpassword === "") {
            $("#spanError-newpassword").text("* newpassword is required.");
            $("#newpassword").css("border-color", "red");
            return false;
        } else if (newpassword.length < 6) {
            $("#spanError-newpassword").text("* newpassword must be at least 6 characters.");
            $("#newpassword").css("border-color", "red");
            return false;
        } else {
            $("#spanError-newpassword").text("");
            $("#newpassword").css("border-color", "green");
            return true;
        }
    }



         // === PASSWORD VALIDATION FUNCTION ===
    function validateconfirmpassword() {
        let confirmpassword = $("#confirmpassword").val().trim();
        let newpassword = $("#newpassword").val().trim();
        if (confirmpassword === "") {
            $("#spanError-confirmpassword").text("* confirmpassword is required.");
            $("#confirmpassword").css("border-color", "red");
            return false;
        } else if (confirmpassword.length < 6) {
            $("#spanError-confirmpassword").text("* confirmpassword must be at least 6 characters.");
            $("#confirmpassword").css("border-color", "red");
            return false;
        }else if (confirmpassword !== newpassword) {
            $('#spanError-repeatpassword').text('* Passwords do not match');
            $('#repeatpassword').css('border-color','red');
            return false;
        } else {
            $("#spanError-confirmpassword").text("");
            $("#confirmpassword").css("border-color", "green");
            return true;
        }
    }



    // Inline validation triggers
    $("#oldpassword").on("blur keyup", validateoldpassword);
    $("#newpassword").on("blur keyup", validatenewpassword);
    $("#confirmpassword").on("blur keyup", validateconfirmpassword);

    // Form submission validation
    $("#userForm").on("submit", function(event) {
        let isoldpasswordValid = validateoldpassword();
        let isnewpasswordValid = validatenewpassword();
        let isconfirmpasswordValid = validateconfirmpassword();

        if (!isoldpasswordValid || !isnewpasswordValid || !isconfirmpasswordValid) {
            event.preventDefault(); // Stop form submission if invalid
        }
    });

});
</script>
</body>


</html>
