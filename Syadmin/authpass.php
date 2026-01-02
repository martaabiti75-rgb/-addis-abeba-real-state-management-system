<?php 

session_start();
if (!isset($_SESSION['sessionID'])) {
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
    exit;
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Change Password</title>

<link href="../assets/img/aacitylogo.jpg" rel="icon">

<link href="../dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../dashboard/assets/css/style.css" rel="stylesheet">

<style>
.password-rules{
    font-size:13px;
    line-height:1.5;
}
.spanError{font-size:13px;}
.show{cursor:pointer;}
</style>
</head>

<body>

<?php require __DIR__.'/Component/Asidebar.php'; ?>
<?php require __DIR__.'/Component/Logoutmodal.php'; ?>

<main id="main" class="main">

<div class="pagetitle">
<h1>Change Password</h1>
</div>

<section class="section">
<div class="row justify-content-center">
<div class="col-lg-6">

<div class="card">
<div class="card-body">

<h5 class="card-title text-center">Change Password</h5>

<p class="text-center text-success"><?= $CommonOBJ->changePassword(); ?></p>

<form method="post" id="forms" novalidate>

<!-- EMAIL -->
<div class="mb-3">
<label>Email *</label>
<input type="text" class="form-control" id="email" name="email" value="<?= $_SESSION['sessionID']; ?>">
<span class="text-danger spanError spanError-email"></span>
</div>

<!-- OLD PASSWORD -->
<div class="mb-3">
<label>Old Password *</label>
<div class="input-group">
<span class="input-group-text show"><i class="bi bi-eye-slash innershow"></i></span>
<input type="password" class="form-control pass-key" id="oldpassword" name="oldPassword">
</div>
<span class="text-danger spanError spanError-oldpass"></span>
</div>

<!-- NEW PASSWORD -->
<div class="mb-3">
<label>New Password *</label>
<div class="input-group">
<span class="input-group-text show"><i class="bi bi-eye-slash innershow"></i></span>
<input type="password" class="form-control pass-key" id="newpassword" name="newPassword">
</div>
<span class="text-danger spanError spanError-newpass"></span>

<!-- HIDDEN RULES -->
<div id="passwordRules" class="password-rules text-danger mt-1" style="display:none;">
<strong>Password must include:</strong><br>
• Uppercase letter<br>
• Lowercase letter<br>
• Number<br>
• Special character<br>
• Minimum 8 characters
</div>
</div>

<!-- CONFIRM PASSWORD -->
<div class="mb-3">
<label>Confirm Password *</label>
<div class="input-group">
<span class="input-group-text show"><i class="bi bi-eye-slash innershow"></i></span>
<input type="password" class="form-control pass-key" id="conpassword" name="conPassword">
</div>
<span class="text-danger spanError spanError-conpass"></span>
</div>

<button type="submit" class="btn btn-primary w-100" id="AddBtn" name="changePasswordBtn">
Submit
</button>

</form>

</div>
</div>

</div>
</div>
</section>

</main>

<script src="../dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/assets/ajax/jquery.min.js"></script>

<script>
$(document).ready(function(){

function strongPasswordValidator(val){
    if(val.length < 8) return false;
    if(!/[A-Z]/.test(val)) return false;
    if(!/[a-z]/.test(val)) return false;
    if(!/[0-9]/.test(val)) return false;
    if(!/[\W_]/.test(val)) return false;
    return true;
}

// NEW PASSWORD VALIDATION
$("#newpassword").on("keyup blur", function(){
    let val = $(this).val().trim();
    if(!strongPasswordValidator(val)){
        $(this).css("border-color","red");
        $(".spanError-newpass").text("* Password is not strong");
        $("#passwordRules").slideDown();
    }else{
        $(this).css("border-color","green");
        $(".spanError-newpass").text("");
        $("#passwordRules").slideUp();
    }
});

// SUBMIT VALIDATION
$("#AddBtn").on("click", function(e){

    let newPass = $("#newpassword").val().trim();
    let conPass = $("#conpassword").val().trim();

    if(!strongPasswordValidator(newPass)){
        e.preventDefault();
        $("#passwordRules").slideDown();
        return;
    }

    if(newPass !== conPass){
        e.preventDefault();
        $(".spanError-conpass").text("* Passwords do not match");
        $("#conpassword").css("border-color","red");
        return;
    }
});

// SHOW / HIDE PASSWORD
$(".innershow").on("click", function(){
    let input = $(this).closest(".input-group").find("input");
    input.attr("type", input.attr("type")==="password" ? "text" : "password");
    $(this).toggleClass("bi-eye bi-eye-slash");
});

});
</script>

</body>
</html>
