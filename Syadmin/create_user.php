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

  <!-- Organization Favicons -->
  <link href="../assets/img/aacitylogo.jpg" rel="icon">
  <link href="../dashboard/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

  <!-- Main CSS -->
  <link href="../dashboard/assets/css/style.css" rel="stylesheet">

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

  <!-- Header -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center">
        <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80px; max-width: 60px;">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle" href="#"><i class="bi bi-search"></i></a>
        </li>
        <?php include __DIR__.'/profileModal.php'; ?>
      </ul>
    </nav>
  </header>

  <!-- Sidebar -->
  <?php require __DIR__.'/Component/Asidebar.php'; ?>

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
      <div class="row justify-content-center">

        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center pt-2">
          <div class="card w-100">
            <div class="card-body">

              <div class="pt-4 pb-2 text-center">
                <h5 class="card-title pb-0 fs-4">New User Form</h5>
              </div>

              <form class="row g-0 needs-validations" novalidate method="post" action="" id="forms">
                <?php if (isset($_GET['error'])) { ?>
                  <p class="text-center text-danger small fw-bold"><?= $_GET['error']; ?></p>
                <?php } ?>
                <p class="text-center text-success spanError errorALL"><?= $isPerformAdminOBJ->isRegisterUser(); ?></p>

                <div class="col-md-12 mb-2">
                  <label class="col-form-label-sm">Fullname *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" name="fullname" class="form-control" id="name" required>
                  </div>
                  <span class="text-danger spanError spanError-name"></span>
                </div>

                <div class="col-md-12 mb-2">
                  <label class="col-form-label-sm">Email *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" name="email" class="form-control" id="email-id" required>
                    <input type="hidden" name="regiterBy" value="<?=$fullname; ?>">
                  </div>
                  <span class="text-danger spanError spanError-1"></span>
                </div>

                <div class="col-md-12 mb-2">
                  <label class="col-form-label-sm">Mobile Number *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" name="phone" class="form-control" id="phone">
                  </div>
                  <span class="text-danger spanError spanError-phone"></span>
                </div>

                <div class="col-md-12 mb-2">
                  <label class="col-form-label-sm">Role *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <select id="accountype" name="role" class="form-select">
                      <option value="Choose">Choose...</option>
                      <option>System administrator</option>
                      <option>Owner</option>
                    </select>
                  </div>
                  <span class="text-danger spanError spanError-accountype"></span>
                </div>

                <div class="col-md-12 mb-3">
                  <label class="col-form-label-sm">Password *</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text show"><span class="bi bi-eye-slash innershow" id="togglePassword"></span></span>
                    <input type="password" name="password" class="form-control pass-key" id="password">
                  </div>
                  <span class="text-danger spanError spanError-2"></span>
                </div>

                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit" name="isRegisterUser" id="AddBtn">Submit</button>
                </div>
              </form>

            </div>
          </div>
        </div>

      </div>
    </section>
  </main>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Adis Abeba Real Estate Management System</span></strong>. All rights reserved.
    </div>
    <div class="credits">
      Powered By <a href="https://t.me/zolaoff/">IT Students</a>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS -->
  <script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dashboard/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../dashboard/assets/vendor/quill/quill.min.js"></script>

  <!-- jQuery -->
  <script src="../dashboard/assets/ajax/jquery.min.js"></script>

  <!-- Main JS -->
  <script>
    $(document).ready(function() {
        $(".innershow").on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass("bi-eye bi-eye-slash");
            var pass_field  = $(".pass-key"); 
            pass_field.attr("type", pass_field.attr("type") === "password" ? "text" : "password");
        });

        function isValidEmail(email) {
          const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|gov|edu)$/i;
          return re.test(String(email).toLowerCase());
        }

        const regexName = /^[a-zA-Z\s]+$/;

        $("#name").on('blur keyup', function() {
            var name = $(this).val().trim();
            if (name === '') {
                $(this).css("border-color","red");
                $(".spanError-name").html("* This field is required.");
            } else if (!regexName.test(name)) {
                $(this).css("border-color","red");
                $(".spanError-name").html("* Please enter a valid name.");
            } else {
                $(this).css("border-color","green");
                $(".spanError-name").html('');
            }
        });

        $("#phone").on('blur keyup', function() {
            var phone = $(this).val().trim();
            if (phone === '') {
                $(this).css("border-color","red");
                $(".spanError-phone").html("* This field is required.");
            } else if(phone.charAt(0) != '0' || phone.charAt(1) != '9'){
                $(this).css("border-color","red");
                $(".spanError-phone").html("* Phone Number must start with 09.");
            } else {
                $(this).css("border-color","green");
                $(".spanError-phone").html('');
            }
        });

        $("#accountype").on('blur keyup change', function() {
            var accountype = $(this).val();
            if (accountype === 'Choose') {
                $(this).css("border-color","red");
                $(".spanError-accountype").html("* This field is required.");
            } else {
                $(this).css("border-color","green");
                $(".spanError-accountype").html('');
            }
        });

        $("#email-id").on('blur keyup', function() {
            var email = $(this).val().trim();
            if (email === '') {
                $(this).css("border-color","red");
                $(".spanError-1").html("* This field is required.");
            } else if(!isValidEmail(email)){
                $(this).css("border-color","red");
                $(".spanError-1").html("* Please enter valid email.");
            } else {
                $(this).css("border-color","green");
                $(".spanError-1").html('');
            }
        });

        $("#password").on('blur keyup', function() {
            var password = $(this).val();
            if (password === '') {
                $(this).css("border-color","red");
                $(".spanError-2").html("* This field is required.");
            } else if (password.length < 6) {
                $(this).css("border-color","red");
                $(".spanError-2").html("* Password must be at least 6 characters.");
            } else {
                $(this).css("border-color","green");
                $(".spanError-2").html('');
            }
        });

        $("#AddBtn").on('click', function(event) {
            $("#name, #phone, #email-id, #password").trigger('blur');
            $("#accountype").trigger('change');
            if ($(".spanError-name").html() || $(".spanError-phone").html() || 
                $(".spanError-1").html() || $(".spanError-2").html() || 
                $(".spanError-accountype").html()) {
                event.preventDefault();
            }
        });
    });
  </script>

</body>
</html>
