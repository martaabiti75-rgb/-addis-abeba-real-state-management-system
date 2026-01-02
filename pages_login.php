<?php
session_start();
require __DIR__ . '/Auth/auth.php';

$CommonOBJ = new Auth();

$popupMessage = '';
$popupType = '';

if (isset($_POST['LoginBtn'])) {

    $username = trim($_POST['UserEmail'] ?? '');
    $password = trim($_POST['UserPass'] ?? '');

    if ($username === '' || $password === '') {
        $popupType = 'warning';
        $popupMessage = 'Username and Password are required.';
    } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $popupType = 'error';
        $popupMessage = 'Username must be a valid email address.';
    } elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W_]/', $password)
    ) {
        $popupType = 'error';
        $popupMessage = 'Password does not meet security requirements.';
    } else {
        $result = $CommonOBJ->Login();

        if ($result === true || $result === 'success') {
            $popupType = 'success';
            $popupMessage = 'Login successful! Redirecting...';
            header("refresh:2;url=dashboard.php");
        } else {
            $popupType = 'error';
            $popupMessage = $result ?: 'Invalid username or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="assets/img/aacitylogo.jpg" rel="icon">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ===== BODY ===== */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #6b4f3c; /* brown background */
    color: #fff;
    transition: all 0.3s ease;
}

/* ===== DARK MODE ===== */
body.dark-mode {
    background: #121212;
    color: #e0e0e0;
}
body.dark-mode .login-card {
    background: #1e1e1e;
    color: #e0e0e0;
    border-color: #333;
}
body.dark-mode .form-control {
    background: #2a2a2a;
    color: #e0e0e0;
    border-color: #555;
}
body.dark-mode .form-control::placeholder { color: #aaa; }
body.dark-mode .btn-primary { background: #333; }
body.dark-mode .btn-primary:hover { background: #555; }
body.dark-mode a { color: #0f0; }

/* ===== DARK MODE BUTTON ===== */
#darkModeToggle {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    border: none;
    padding: 10px 15px;
    border-radius: 50%;
    background: #4b3621;
    color: #fff;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s ease;
}
#darkModeToggle:hover { background: #3e2c18; }

/* ===== LOGIN CARD ===== */
.login-card {
    width: 100%;
    max-width: 400px;
    padding: 40px 30px;
    border-radius: 15px;
    background: #fff; /* white card */
    color: #4b3621; /* brown text */
    border: 1px solid #3e2c18;
    box-shadow: 0 0 20px rgba(0,255,0,0.2), 0 0 15px rgba(255,0,0,0.2);
    position: relative;
    overflow: hidden;
    animation: fadeInCard 0.8s ease-in-out;
}
@keyframes fadeInCard { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }

.login-card h3 {
    text-align: center;
    font-weight: 700;
    margin-bottom: 25px;
    color: inherit;
}

/* ===== INPUTS ===== */
.form-control {
    border-radius: 10px;
    padding: 12px 15px;
    border: 1px solid #3e2c18;
    background: #f5f5f5;
    color: #4b3621;
    font-size: 14px;
    transition: all 0.3s ease;
}
.form-control::placeholder { color: #7a5c3a; }
.form-control:focus { outline:none; border-color:#0f0; box-shadow:0 0 8px rgba(0,255,0,0.5); background:#fff; }

/* ===== BUTTON ===== */
.btn-primary {
    width: 100%;
    padding: 12px;
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    border: none;
    border-radius: 10px;
    background: #4b3621;
    box-shadow: 0 5px 20px rgba(0,255,0,0.4);
    transition: all 0.3s ease;
    cursor: pointer;
}
.btn-primary:hover {
    background: #3e2c18;
    box-shadow: 0 0 15px rgba(0,255,0,0.6), 0 0 10px rgba(255,0,0,0.5);
    transform: translateY(-2px);
}

/* ===== LINKS ===== */
a { text-decoration:none; color:#4b3621; transition:0.3s; }
a:hover { color:#0f0; text-decoration:underline; }

/* ===== FORGET PASSWORD BUTTON ===== */
.btn-outline-secondary {
    border-color: #4b3621;
    color: #4b3621;
    background: transparent;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-outline-secondary:hover {
    background: #4b3621;
    color: #fff;
    border-color: #4b3621;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 54, 33, 0.3);
}
body.dark-mode .btn-outline-secondary {
    border-color: #0f0;
    color: #0f0;
}
body.dark-mode .btn-outline-secondary:hover {
    background: #0f0;
    color: #121212;
    border-color: #0f0;
}

/* ===== PASSWORD ICON ===== */
.input-group-text { background: #4b3621; color:#fff; border-radius:0 10px 10px 0; cursor:pointer; }
.input-group-text:hover { background:#3e2c18; }

/* ===== PASSWORD RULES ===== */
.password-rules { display:none; font-size:13px; color:#f00; margin-top:6px; }

/* ===== VALIDATION ===== */
.is-invalid { border-color:#f00 !important; box-shadow:0 0 8px rgba(255,0,0,0.6) !important; }
.is-valid { border-color:#0f0 !important; box-shadow:0 0 8px rgba(0,255,0,0.6) !important; }

/* ===== RESPONSIVE ===== */
@media (max-width:576px){ .login-card{ padding:30px 20px; } }
</style>
</head>

<body>
<!-- Dark Mode Button -->
<button id="darkModeToggle">🌙</button>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-4">

<div class="login-card">

<h3>Login</h3>

<form id="loginForm" method="POST" novalidate>
<div class="mb-3">
<input type="email" class="form-control" id="username"
       name="UserEmail" placeholder="Email">
</div>

<div class="mb-3 input-group">
<input type="password" class="form-control pass-key" id="password"
       name="UserPass" placeholder="Password">
<span class="input-group-text show"><i class="bi bi-eye-slash innershow"></i></span>
</div>

<div class="password-rules" id="passwordRules">
<strong>Password must include:</strong><br>
• Uppercase letter<br>
• Lowercase letter<br>
• Number<br>
• Special character<br>
• Minimum 8 characters
</div>

<button type="submit" class="btn btn-primary mt-3" name="LoginBtn">Login</button>

<div class="text-center mt-3">
<a href="forgot-password.php?step1" class="btn btn-outline-secondary btn-sm me-2">
<i class="bi bi-key"></i> Forgot Password?
</a>
</div>

<div class="text-center mt-2">
<a href="register.php">Create Account</a> |
<a href="index.php">Back to Home</a>
</div>
</form>

</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="ajax/jquery.min.js"></script>

<script>
$(document).ready(function () {

    // ===== DARK MODE TOGGLE =====
    const darkBtn = document.getElementById("darkModeToggle");
    darkBtn.addEventListener("click", ()=>{
        document.body.classList.toggle("dark-mode");
        darkBtn.textContent = document.body.classList.contains("dark-mode") ? "☀️" : "🌙";
    });

    // Password strength check
    function isStrongPassword(password){
        return password.length>=8 && /[A-Z]/.test(password) && /[a-z]/.test(password) &&
               /[0-9]/.test(password) && /[\W_]/.test(password);
    }

    $("#password").on("input blur", function(){
        let pass = $(this).val();
        if(pass && !isStrongPassword(pass)){
            $("#passwordRules").slideDown();
            $(this).addClass("is-invalid").removeClass("is-valid");
        } else if(pass){
            $("#passwordRules").slideUp();
            $(this).addClass("is-valid").removeClass("is-invalid");
        } else{
            $("#passwordRules").slideUp();
            $(this).removeClass("is-invalid is-valid");
        }
    });

    // Toggle password visibility
    $(".innershow").on("click", function(){
        let passInput = $(".pass-key");
        $(this).toggleClass("bi-eye bi-eye-slash");
        passInput.attr("type", passInput.attr("type")==="password" ? "text" : "password");
    });

    // Form submission validation
    $("#loginForm").on("submit", function(e){
        let email = $("#username").val().trim();
        let password = $("#password").val().trim();

        if(email==='' || password===''){
            e.preventDefault();
            Swal.fire({icon:'warning',title:'Missing Fields',text:'Username and password are required.'});
            return;
        }

        if(!isStrongPassword(password)){
            e.preventDefault();
            $("#passwordRules").slideDown();
            Swal.fire({icon:'error',title:'Weak Password',text:'Password does not meet security requirements.'});
        }
    });
});
</script>

<?php if($popupMessage): ?>
<script>
Swal.fire({
    icon: '<?= $popupType ?>',
    title: '<?= strtoupper($popupType) ?>',
    text: '<?= htmlspecialchars($popupMessage) ?>',
    <?= $popupType==='success' ? 'timer:2000,showConfirmButton:false' : '' ?>
});
</script>
<?php endif; ?>

</body>
</html>
