<?php
require __DIR__ . '\Auth\auth.php';
session_start();

// Initialize variables to prevent "undefined variable" warnings
$successMsg = "";
$errorMsg = "";

$CommonOBJ = new Auth();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Register'])) {

    function clean($data) {
        return htmlspecialchars(trim($data));
    }

    $fullname = clean($_POST['fullname']);
    $email = clean($_POST['email']);
    $phone = clean($_POST['phone']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    if (!preg_match("/^[a-zA-Z ]{3,}$/", $fullname)) {
        $errorMsg = "Invalid full name (minimum 3 letters)";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Invalid email address";
    } elseif (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errorMsg = "Phone number must be 10–15 digits";
    } elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W_]/', $password)
    ) {
        $errorMsg = "Password must have min 8 chars, uppercase, lowercase, number & symbol";
    } elseif ($password !== $confirmPassword) {
        $errorMsg = "Passwords do not match";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $successMsg = $CommonOBJ->isRegister($fullname, $email, $phone, $hashedPassword);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ===== BODY ===== */
body {
    background-color: #4b3621; /* brown background */
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    transition: all 0.4s ease;
}

/* ===== DARK MODE ===== */
body.dark-mode {
    background-color: #121212 !important;
    color: #e0e0e0 !important;
}

body.dark-mode .register-card {
    background: #1e1e1e;
    color: #e0e0e0;
    border-color: #333;
}

body.dark-mode .form-control {
    background: #2a2a2a;
    color: #e0e0e0;
    border-color: #555;
}

body.dark-mode .form-control::placeholder {
    color: #aaa;
}

body.dark-mode .btn-primary {
    background: #333;
}

body.dark-mode .btn-primary:hover {
    background: #555;
}

body.dark-mode a {
    color: #0f0;
}

/* ===== REGISTER CARD ===== */
.register-card {
    background: #fff;
    color: #4b3621;
    padding: 40px 35px;
    border-radius: 16px;
    border: 1px solid #3e2c18;
    box-shadow: 0 10px 30px rgba(75,54,33,0.4), 0 10px 20px rgba(0,255,0,0.2);
    width: 100%;
    max-width: 450px;
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

.register-card h2 {
    font-weight: 700;
    text-align: center;
    color: inherit;
    margin-bottom: 25px;
}

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

.form-control:focus {
    outline: none;
    border-color: #0f0;
    box-shadow: 0 0 10px rgba(0,255,0,0.5);
}

.input-group-text {
    background: #4b3621;
    color: #fff;
    border-radius: 0 10px 10px 0;
    cursor: pointer;
}
.input-group-text:hover { background: #3e2c18; }

.btn-primary {
    background: #4b3621;
    color: #fff;
    font-weight: 600;
    border-radius: 10px;
    padding: 12px;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background: #3e2c18;
    box-shadow: 0 0 15px rgba(0,255,0,0.5), 0 0 10px rgba(255,0,0,0.4);
    transform: translateY(-2px);
}

.btn-outline-success, .btn-outline-secondary {
    border-radius: 10px;
    padding: 10px;
    font-weight: 500;
}

.error-msg { color: #f00; font-size: 13px; margin-top: 4px; display: none; }
.alert { border-radius: 10px; font-size: 14px; }

a { text-decoration: none; color: #4b3621; font-weight: 500; }
a:hover { color: #0f0; text-decoration: underline; }

.is-invalid { border-color: #f00 !important; box-shadow: 0 0 8px rgba(255,0,0,0.6) !important; }
.is-valid { border-color: #0f0 !important; box-shadow: 0 0 8px rgba(0,255,0,0.6) !important; }

@media (max-width: 576px) { .register-card { padding: 25px; } }

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

</style>
</head>

<body>
<!-- Dark Mode Button -->
<button id="darkModeToggle">🌙</button>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="register-card">
        <h2>Customer Registration</h2>

        <?php if($errorMsg): ?>
          <div class="alert alert-danger text-center"><?= $errorMsg ?></div>
        <?php endif; ?>
        <?php if($successMsg): ?>
          <div class="alert alert-success text-center"><?= $successMsg ?></div>
        <?php endif; ?>

        <form id="registerForm" method="POST" novalidate>
          <div class="mb-3">
            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name">
            <span class="error-msg" id="fullname-error">Only letters, min 3 characters</span>
          </div>

          <div class="mb-3">
            <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
            <span class="error-msg" id="email-error">Enter a valid email</span>
          </div>

          <div class="mb-3">
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number">
            <span class="error-msg" id="phone-error">10–15 digits only</span>
          </div>

          <div class="mb-3 input-group">
            <input type="password" id="password" name="password" class="form-control pass-key" placeholder="Password">
            <span class="input-group-text toggle-password"><i class="bi bi-eye-slash"></i></span>
            <span class="error-msg" id="password-error">Min 8 chars, uppercase, lowercase, number & symbol</span>
          </div>

          <div class="mb-3 input-group">
            <input type="password" id="confirm-password" name="confirmpassword" class="form-control pass-key" placeholder="Confirm Password">
            <span class="input-group-text toggle-password"><i class="bi bi-eye-slash"></i></span>
            <span class="error-msg" id="confirm-error">Passwords must match</span>
          </div>

          <button type="submit" name="Register" class="btn btn-primary w-100 mb-3">Register</button>

          <div class="d-flex justify-content-between">
            <a href="pages_login.php" class="btn btn-outline-success w-50 me-2">Login</a>
            <a href="index.php" class="btn btn-outline-secondary w-50">← Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// ===== DARK MODE TOGGLE =====
const darkBtn = document.getElementById("darkModeToggle");
darkBtn.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
    darkBtn.textContent = document.body.classList.contains("dark-mode") ? "☀️" : "🌙";
});

// ===== FORM VALIDATION & PASSWORD TOGGLE =====
const form = document.getElementById("registerForm");
const rules = {
  fullname: /^[A-Za-z ]{3,}$/,
  email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
  phone: /^[0-9]{10,15}$/,
  password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/
};

function validate(id, regex, errorId) {
  const input = document.getElementById(id);
  const error = document.getElementById(errorId);
  if (!regex.test(input.value.trim())) {
    error.style.display = "block";
    input.classList.add("is-invalid");
    input.classList.remove("is-valid");
    return false;
  } else {
    error.style.display = "none";
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
    return true;
  }
}

['fullname','email','phone','password','confirm-password'].forEach(id=>{
  document.getElementById(id).addEventListener('input', ()=>{
    if(id==='confirm-password'){
      const pass = document.getElementById('password').value;
      const confirm = document.getElementById('confirm-password').value;
      const confirmError = document.getElementById('confirm-error');
      if(pass !== confirm){
        confirmError.style.display='block';
        document.getElementById('confirm-password').classList.add('is-invalid');
      } else {
        confirmError.style.display='none';
        document.getElementById('confirm-password').classList.add('is-valid');
        document.getElementById('confirm-password').classList.remove('is-invalid');
      }
    } else if(id==='email'){
      validate('email', rules.email, 'email-error');
    } else {
      validate(id, rules[id], id+'-error');
    }
  });
});

form.addEventListener("submit", e => {
  let valid = true;
  valid &= validate("fullname", rules.fullname, "fullname-error");
  valid &= validate("email", rules.email, "email-error");
  valid &= validate("phone", rules.phone, "phone-error");
  valid &= validate("password", rules.password, "password-error");

  const pass = document.getElementById("password").value;
  const confirm = document.getElementById("confirm-password").value;
  if(pass !== confirm){
    document.getElementById("confirm-error").style.display='block';
    document.getElementById("confirm-password").classList.add("is-invalid");
    valid = false;
  }
  if(!valid) e.preventDefault();
});

// Toggle password visibility
document.querySelectorAll('.toggle-password').forEach(icon => {
  icon.addEventListener('click', function() {
    const input = this.previousElementSibling;
    const eyeIcon = this.querySelector('i');
    if(input.type==="password"){ input.type="text"; eyeIcon.classList.replace('bi-eye-slash','bi-eye'); }
    else { input.type="password"; eyeIcon.classList.replace('bi-eye','bi-eye-slash'); }
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
