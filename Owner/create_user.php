<?php 
session_start();
if (!isset($_SESSION['sessionID'])) {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
}

require __DIR__.'/performOwnerAction.php';
$isPerformOwnerOBJ = new isPerformOwnerAction();
require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
$CommonOBJ = new CommonFunction();

$dataQ = $isPerformOwnerOBJ->getSessionUser($_SESSION['sessionID']);
foreach ($dataQ as $key => $value) {
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adis Abeba Real Estate Management System</title>

<link href="../assets/img/aacitylogo.jpg" rel="icon">
<link href="../dashboard/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

<link href="../dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/simple-datatables/style.css" rel="stylesheet">

<link href="../dashboard/assets/css/style.css" rel="stylesheet">
<link href="../dashboard/assets/css/logo.css" rel="stylesheet">

<style>
/* Advanced Custom CSS */
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

/* Form Select */
.form-select {
  border-radius: 15px;
  border: 2px solid #e2e8f0;
  padding: 15px 20px;
  font-size: 16px;
  font-weight: 500;
  transition: all 0.3s ease;
  background: rgba(248, 250, 252, 0.8);
  backdrop-filter: blur(5px);
}

.form-select:focus {
  border-color: #10b981;
  box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15);
  outline: none;
  background: rgba(255, 255, 255, 0.9);
  transform: translateY(-2px);
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

.input-group .form-select {
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
.form-control[style*="border-color: red"], .form-select[style*="border-color: red"] {
  border-color: #ef4444 !important;
  box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.15) !important;
  animation: shake 0.5s ease-in-out;
}

.form-control[style*="border-color: green"], .form-select[style*="border-color: green"] {
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

/* Password Rules */
#passwordRules {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  border: 2px solid #f59e0b;
  border-radius: 12px;
  padding: 15px;
  margin-top: 10px;
  font-size: 0.875rem;
  color: #92400e;
  box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
}

#passwordRules strong {
  color: #78350f;
  font-weight: 700;
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
  
  .form-control, .form-select {
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

/* Real-time validation indicators */
.validation-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 18px;
  transition: all 0.3s ease;
}

.validation-success {
  color: #10b981;
}

.validation-error {
  color: #ef4444;
}
</style>
</head>

<body>

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
  <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center pt-2">
    <div class="card">
      <div class="card-body">
        <div class="pt-4 pb-2 text-center">
          <h5 class="card-title pb-0 fs-4">New User Form</h5>
        </div>
        <form class="row g-0 needs-validation" novalidate method="post" action="" id="forms">
          <?php if (isset($_GET['error'])) { ?>
          <p class="text-center text-danger small fw-bold"><?= $_GET['error']; ?></p>
          <?php } ?>
          <p class="text-center text-success spanError errorALL"><?= $isPerformOwnerOBJ->isRegisterUser(); ?></p>

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
                <option>Manager</option>
              </select>
            </div>
            <span class="text-danger spanError spanError-accountype"></span>
          </div>

          <div class="col-md-12 mb-3">
            <label class="col-form-label-sm">Password *</label>
            <div class="input-group has-validation">
              <span class="input-group-text show"><span class="bi bi-eye-slash innershow"></span></span>
              <input type="password" name="password" class="form-control pass-key" id="password">
            </div>
            <span class="text-danger spanError spanError-2"></span>
            <div id="passwordRules">
              <strong>Password must include:</strong><br>
              • Uppercase letter<br>
              • Lowercase letter<br>
              • Number<br>
              • Special character<br>
              • Minimum 8 characters
            </div>
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

<script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/assets/ajax/jquery.min.js"></script>

<script>
$(document).ready(function() {

    // Toggle password visibility
    $(".innershow").on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass("bi-eye bi-eye-slash");
        var pass_field  = $(".pass-key"); 
        pass_field.attr("type", pass_field.attr("type") === "password" ? "text" : "password");
    });

    const regexName = /^[a-zA-Z\s]+$/;
    function isValidEmail(email) {
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|gov|edu)$/i;
        return re.test(String(email).toLowerCase());
    }
    function isStrongPassword(password) {
        return (
            password.length >= 8 &&
            /[A-Z]/.test(password) &&
            /[a-z]/.test(password) &&
            /[0-9]/.test(password) &&
            /[\W_]/.test(password)
        );
    }

    $("#name").on('blur keyup', function() {
        const val = $(this).val().trim();
        if(val===''){ $(this).css("border-color","red"); $(".spanError-name").html("* Required"); }
        else if(!regexName.test(val)){ $(this).css("border-color","red"); $(".spanError-name").html("* Invalid name"); }
        else{ $(this).css("border-color","green"); $(".spanError-name").html(''); }
    });

    $("#phone").on('blur keyup', function() {
        const val = $(this).val().trim();
        if(val===''){ $(this).css("border-color","red"); $(".spanError-phone").html("* Required"); }
        else if(val.charAt(0)!='0'||val.charAt(1)!='9'){ $(this).css("border-color","red"); $(".spanError-phone").html("* Must start with 09"); }
        else{ $(this).css("border-color","green"); $(".spanError-phone").html(''); }
    });

    $("#accountype").on('blur keyup change', function() {
        const val = $(this).val();
        if(val==="Choose"){ $(this).css("border-color","red"); $(".spanError-accountype").html("* Required"); }
        else{ $(this).css("border-color","green"); $(".spanError-accountype").html(''); }
    });

    $("#email-id").on('blur keyup', function() {
        const val = $(this).val().trim();
        if(val===''){ $(this).css("border-color","red"); $(".spanError-1").html("* Required"); }
        else if(!isValidEmail(val)){ $(this).css("border-color","red"); $(".spanError-1").html("* Invalid email"); }
        else{ $(this).css("border-color","green"); $(".spanError-1").html(''); }
    });

    $("#password").on('blur keyup', function() {
        const val = $(this).val().trim();
        if(val===''){ $(this).css("border-color","red"); $(".spanError-2").html("* Required"); $("#passwordRules").slideUp(); }
        else if(!isStrongPassword(val)){ $(this).css("border-color","red"); $(".spanError-2").html("* Weak password"); $("#passwordRules").slideDown(); }
        else{ $(this).css("border-color","green"); $(".spanError-2").html(''); $("#passwordRules").slideUp(); }
    });

    $("#AddBtn").on('click', function(e) {
        $("#name, #phone, #email-id, #password").trigger('blur');
        $("#accountype").trigger('change');

        const password = $("#password").val().trim();
        if(!isStrongPassword(password)){ $("#passwordRules").slideDown(); e.preventDefault(); return; }

        if($(".spanError-name").html() || $(".spanError-phone").html() ||
           $(".spanError-1").html() || $(".spanError-2").html() ||
           $(".spanError-accountype").html()){ e.preventDefault(); }
    });

});
</script>

</body>
</html>
