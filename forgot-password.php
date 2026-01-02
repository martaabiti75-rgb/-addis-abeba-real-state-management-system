
<?php

  // require __DIR__.'../CommonFunction/CommenForEveryUserFunction.php';
  require __DIR__.'\Auth\auth.php';
  $CommonOBJ = new Auth();

  session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/aacitylogo.jpg" rel="icon">
  <link href="assets/img/aacitylogo.jpg" rel="apple-touch-icon">
  <title>Login</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #eef2f3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-card {
      background: #fff;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .login-card h2 {
      color: #003366;
      margin-bottom: 15px;
      font-weight: 600;
      text-align: center;
    }

    .login-card p {
      margin-bottom: 25px;
      color: #555;
      text-align: center;
    }

    .btn-primary {
      background: linear-gradient(to right,#003366,#005599);
      border: none;
    }

    .btn-primary:hover {
      opacity: 0.9;
    }

    .logo {
      width: 100px;
      display: block;
      margin: 0 auto 20px;
    }

    .error-msg {
      color: #ff4d4d;
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }

    .forgot-password {
      display: block;
      text-align: right;
      margin-top: -10px;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .forgot-password a {
      color: #003366;
      text-decoration: none;
      font-weight: 500;
    }

    .back-home {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .back-home a {
      color: #003366;
      text-decoration: none;
      font-weight: 500;
    }
  </style>
</head>
<body>


<?php if (isset($_GET['step1'])) { ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="login-card">

          <!-- Logo -->
          <img src="assets/img/aacitylogo.jpg" alt="Logo" class="logo">

          <h2>🔐 Forgot Password</h2>
          <!-- <p>Please login to continue</p> -->
          <p class="text-danger text-center"><?= $CommonOBJ->forgetPassword(); ?></p>
          <form id="loginForm" action="" method="POST" novalidate>
            <div class="mb-3">
              <input type="text" class="form-control" id="email" name="UserEmail" placeholder="Enter Email" required>
              <!-- <div class="error-msg" id="username-error">Email is required</div> -->
              <span class="text-danger" id="spanError-email"></span>
            </div>

         <!--    <div class="mb-3">
              <input type="password" class="form-control" id="password" name="UserPass" placeholder="Enter Password" required>
              <span class="text-danger" id="spanError-password"></span>
            </div>
 -->
            <!-- Forgot Password Link -->
            <div class="forgot-password">
              <a href="forgot-password.php?step1">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="SendEmail" name="SendEmail">Send Email</button>
          </form>

          <p class="text-center mt-3">
            Don't have an account? <a href="register.php?register" class="text-primary fw-semibold">Create one</a>
          </p>

          <!-- Back to Home Link -->
          <div class="back-home">
            <a href="index.php">&larr; Back to Home</a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php } ?>

  <?php if (isset($_GET['step2'])) { ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="login-card">

          <!-- Logo -->
          <img src="assets/img/aacitylogo.jpg" alt="Logo" class="logo">

          <h2>🔐 Enter OTP</h2>
          <!-- <p>Please login to continue</p> -->
          <p class="text-danger text-center"><?= $CommonOBJ->sendOTP(); ?></p>
          <form id="loginForm" action="" method="POST" novalidate>
            <div class="mb-3">
              <input type="number" id="otp" name="otp" class="form-control" placeholder="የአንድ ጊዜ የይለፍ ቃል ኮድ ያስገቡ*">
                <span id="spanError-otp" class="text-danger"></span>
            </div>

         <!--    <div class="mb-3">
              <input type="password" class="form-control" id="password" name="UserPass" placeholder="Enter Password" required>
              <span class="text-danger" id="spanError-password"></span>
            </div>
 -->
            <!-- Forgot Password Link -->
            <input type="hidden" name="UserEmail" class="form-control" id="email" value="<?=$_GET['email']; ?>">
            <div class="forgot-password">
              <a href="forgot-password.php?step1">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="SendOTP" name="sendOTP">Send OTP</button>
          </form>

          <p class="text-center mt-3">
            Don't have an account? <a href="register.php?register" class="text-primary fw-semibold">Create one</a>
          </p>

          <!-- Back to Home Link -->
          <div class="back-home">
            <a href="index.php">&larr; Back to Home</a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php } ?>

   <?php if (isset($_GET['step3'])) { ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="login-card">

          <!-- Logo -->
          <img src="assets/img/aacitylogo.jpg" alt="Logo" class="logo">

          <h2>🔐 Change Password</h2>
          <!-- <p>Please login to continue</p> -->
          <p class="text-danger text-center"><?= $CommonOBJ->isChangePassword(); ?></p>
          <form id="loginForm" action="" method="POST" novalidate>
            <div class="mb-3">
               <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="አዲስ የይለፍ ቃል ያስገቡ">
                        <span class="text-danger" id="spanError-newpassword"></span>
            </div>

            <div class="mb-3">
                <input type="password" name="conpassword" class="form-control" id="conpassword" placeholder="የማረጋገጫ ይለፍ ቃል ያስገቡ">
                      <span class="text-danger" id="spanError-conpassword"></span>
           </div>

         <!--    <div class="mb-3">
              <input type="password" class="form-control" id="password" name="UserPass" placeholder="Enter Password" required>
              <span class="text-danger" id="spanError-password"></span>
            </div>
 -->
            <!-- Forgot Password Link -->
            <input type="hidden" name="UserEmail" class="form-control" id="email" value="<?=$_GET['email']; ?>">
            <div class="forgot-password">
              <a href="forgot-password.php?step1">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="isChangePassword" name="isChangePassword">Made Change</button>
          </form>

          <p class="text-center mt-3">
            Don't have an account? <a href="register.php?register" class="text-primary fw-semibold">Create one</a>
          </p>

          <!-- Back to Home Link -->
          <div class="back-home">
            <a href="index.php">&larr; Back to Home</a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php } ?>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Inline validation -->

    <script src="ajax\jquery-2.2.4.min.js"></script>
  <script src="ajax\jquery.js"></script>
  <script src="ajax\jquery.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function () {

      // Email regex function
      function isValidEmail(email) {
          const re = /^[a-zA-Z0-9._]+@[a-zA-Z]+\.com$/;
          return re.test(String(email).toLowerCase());
      }

      // === INLINE VALIDATION ===
      $("#email").on("blur keyup", function () {
          let email = $(this).val().trim();
          if (email === "") {
              $("#spanError-email").html("* This field is required.");
              $("#email").css("border-color", "red");
          } else if (!isValidEmail(email)) {
              $("#spanError-email").html("* Please enter valid email.");
              $("#email").css("border-color", "red");
          } else {
              $("#spanError-email").html("");
              $("#email").css("border-color", "green");
          }
      });

      $("#password").on("blur keyup", function () {
          let password = $(this).val().trim();
          if (password === "") {
              $("#spanError-password").html("* This field is required.");
              $("#password").css("border-color", "red");
          } else if (password.length < 6) {
              $("#spanError-password").html("* Password must be at least 6 characters.");
              $("#password").css("border-color", "red");
          } else {
              $("#spanError-password").html("");
              $("#password").css("border-color", "green");
          }
      });

       $("#otp").on("blur keyup", function () {
          let otp = $(this).val().trim();
          if (otp === "") {
              $("#spanError-otp").html("* This field is required.");
              $("#otp").css("border-color", "red");
          } else {
              $("#spanError-otp").html("");
              $("#otp").css("border-color", "green");
          }
      });

             // === INLINE VALIDATION ===
      $("#newpassword").on("blur keyup", function () {
          let newpassword = $(this).val().trim();
          if (newpassword === "") {
              $("#spanError-newpassword").html("* This field is required.");
              $("#newpassword").css("border-color", "red");
          }else if (newpassword.length < 6) {
            $("#spanError-newpassword").text("* New password must be at least 6 characters.");
            $("#newpassword").css("border-color", "red");
          } else {
              $("#spanError-newpassword").html("");
              $("#newpassword").css("border-color", "green");
          }
      });

      // === INLINE VALIDATION ===
      $("#conpassword").on("blur keyup", function () {
          let conpassword = $(this).val().trim();
          if (conpassword === "") {
              $("#spanError-conpassword").html("* This field is required.");
              $("#conpassword").css("border-color", "red");
          }else if (conpassword.length < 6) {
            $("#spanError-conpassword").text("* New password must be at least 6 characters.");
            $("#conpassword").css("border-color", "red");
          } else {
              $("#spanError-conpassword").html("");
              $("#conpassword").css("border-color", "green");
          }
      });

$("#isChangePassword").on("click", function (event) {

    let valid = true;

    let newpassword = $("#newpassword").val().trim();
    let conpassword = $("#conpassword").val().trim();

    // Validate New Password
    if (newpassword === "") {
        $("#spanError-newpassword").text("* This field is required.");
        $("#newpassword").css("border-color", "red");
        valid = false;
    } else if (newpassword.length < 6) {
        $("#spanError-newpassword").text("* Password must be at least 6 characters.");
        $("#newpassword").css("border-color", "red");
        valid = false;
    } else {
        $("#spanError-newpassword").text("");
        $("#newpassword").css("border-color", "green");
    }

    // Validate Confirm Password
    if (conpassword === "") {
        $("#spanError-conpassword").text("* This field is required.");
        $("#conpassword").css("border-color", "red");
        valid = false;
    } else if (conpassword.length < 6) {
        $("#spanError-conpassword").text("* Password must be at least 6 characters.");
        $("#conpassword").css("border-color", "red");
        valid = false;
    } else if (conpassword !== newpassword) { // <-- Check if they match
        $("#spanError-conpassword").text("* Passwords do not match.");
        $("#conpassword").css("border-color", "red");
        valid = false;
    } else {
        $("#spanError-conpassword").text("");
        $("#conpassword").css("border-color", "green");
    }

    if (!valid) {
        event.preventDefault(); // prevent form submission
    }
});





        $("#SendOTP").on("click", function (event) {

          let otp = $("#otp").val().trim();
          // let password = $("#password").val().trim();
          let valid = true;
          if (otp === "") {
              $("#spanError-otp").html("* This field is required.");
              $("#otp").css("border-color", "red");
               valid = false;
          } else {
              $("#spanError-otp").html("");
              $("#otp").css("border-color", "green");
              valid = true;
          }

          if (!valid) {
              event.preventDefault();
          }


        });


      // === FINAL CHECK ON BUTTON CLICK ===
      $("#SendEmail").on("click", function (event) {
          let email = $("#email").val().trim();
          // let password = $("#password").val().trim();
          let valid = true;

          // Email final check
          if (email === "") {
              $("#spanError-email").html("* This field is required.");
              $("#email").css("border-color", "red");
              valid = false;
          } else if (!isValidEmail(email)) {
              $("#spanError-email").html("* Please enter valid email.");
              $("#email").css("border-color", "red");
              valid = false;
          }

          // Password final check
          // if (password === "") {
          //     $("#spanError-password").html("* This field is required.");
          //     $("#password").css("border-color", "red");
          //     valid = false;
          // } else if (password.length < 6) {
          //     $("#spanError-password").html("* Password must be at least 6 characters.");
          //     $("#password").css("border-color", "red");
          //     valid = false;
          // }

          // Stop submit if invalid
          if (!valid) {
              event.preventDefault();
          }
      });

  });
  </script>

</body>
</html>
