 <?php 

session_start();
if (isset($_SESSION['sessionID'])) {
  // code...
}else{
  echo "<script>window.location='../pages-login.php?error=Session timeout try again.';</script>";
}

require __DIR__.'/AdminClass.php';
 $AdminOBJ = new AdminClass();

 $dataQ = $AdminOBJ->getSessionUser($_SESSION['sessionID']);
 $rowQ = $AdminOBJ->getSessionUser($_SESSION['sessionID']);
    foreach ($dataQ as $key => $value) {
      $fullname = $value['fullname'];
      $role = $value['role'];
      $lastlogintime = $value['lastlogintime'];
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Honda - Cinema</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!--Organization Favicons -->
   <link href="../assets/img/Honda.Jpg" rel="icon">
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

  <!-- =======================================================
  * Folder Super/Admin
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- <img src="../assets/img/Cc.jpg" alt=""> -->
        <span class="d-none d-lg-block">Honda</span>
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

        <div class="col-md-2"></div>
        <!-- <div class="col-md-4"></div> -->
        <div class="col-lg-7 col-md-6 d-flex flex-column align-items-center justify-content-center pt-2">
          <div class="card ">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <a href="#" class="newlogo d-flex align-items-center w-auto">
                  <img src="ERP/assets/img/RodasNew.png" alt="" style="width: 100px;" class="">
                  <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                </a>
                    <h5 class="card-title text-center pb-0 fs-4">New User Form</h5>
                    
                  </div>
                  <!--class: needs-validation attribute:novalidate -->
                  <form class="row g-3 needs-validations" novalidate method="post" action="" id="forms">
                    <?php
                if (isset($_GET['error'])) { ?>
                     <p class="text-center text-danger small fw-bold" id="displayblock"><?= $_GET['error'];  ?></p>
                    <?php } ?>
                    
                    <p class="text-center text-success spanError errorALL"><?= $AdminOBJ->RegisterUserMethod(); ?></p>
                     
                     <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Fullname *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="Fullname" class="form-control" id="name" required>
                      </div>
                      <span class="text-danger spanError spanError-name"></span>
                    </div>
                    <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Email *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="Email" class="form-control" id="email-id" required>
                        <input type="hidden" name="regiterBy" value="<?=$fullname; ?>" class="form-control">
                      </div>
                      <span class="text-danger spanError spanError-1"></span>
                    </div>

                    <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Mobile Number *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="PhoneNumber" class="form-control" id="phone">
                      </div>
                      <span class="text-danger spanError spanError-phone"></span>
                    </div>

                    <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Role *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <select id="accountype" name="Role" class="form-select">
                          <option value="Choose">Choose...</option>
                          <option>Administrator</option>
                          <option>Manager</option>
                         <!--  <option>Office Head</option>
                          <option>Office Staff</option> -->
                         
                        </select>
                      </div>
                      <span class="text-danger spanError spanError-accountype"></span>
                    </div>

                    
                <div class="col-md-12">
                    <label for="yourPassword" class="col-form-label-sm">Password *</label>
                  <div class="input-group has-validation">
                      <span class="input-group-text show"><span class="bi bi-eye-slash innershow" id="togglePassword"></span></span>
                      <input type="password" name="Password" class="form-control pass-key" id="password">
                  </div>
                    <span class="text-danger spanError spanError-2"></span>
                </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="AddUserBtn" id="AddBtn">Submit</button>
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
      &copy; Copyright <strong><span>Honda Cinema</span></strong>.All right reserved.
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


     $(".innershow").on('click',function(e) {
          
           e.preventDefault();
          $(this).toggleClass("bi-eye bi-eye-slash");
          var pass_field  = $(".pass-key"); 
          if (pass_field.attr("type") === "password") {
             pass_field.attr("type","text");
          }else{
            pass_field.attr("type","password")
          }
          
       });
    
      $("#AddBtn").on('click',function(event) {
        // body...
          // event.preventDefault();
          var name = $("#name").val();
          var phone = $("#phone").val();
          var email = $("#email-id").val();
          var password = $("#password").val(); 
          var accountype = $("#accountype").val(); 
          function isValidEmail(email){
            const re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return re.test(String(email).toLowerCase());
          }  
          const regexname = /[a-zA-Z]$/;


          if (name === '') {
            event.preventDefault();
            $("#name").css("border-color","red");
            $(".spanError-name").html("* This field is required.");
          }
          // else if(!regexname.test(name)) {
          //   event.preventDefault();
          //   $("#name").css("border-color","red");
          //   $(".spanError-name").html("* እባክዎ ትክክለኛ ስም ያስገቡ!");
          // }
          else{
            $(".spanError-name").html('');
            $("#name").css("border-color","green");
          }

          if (phone === '') {
            event.preventDefault();
            $("#phone").css("border-color","red");
            $(".spanError-phone").html("* This field is required.");
          }else if(phone.charAt(0) != 0){
            event.preventDefault();
            $("#phone").css("border-color","red");
            $(".spanError-phone").html("* Phone Number start with 0. ");
          }else if(phone.charAt(1) != 9){
            event.preventDefault();
            $("#phone").css("border-color","red");
            $(".spanError-phone").html("* Phone Number start with 09. ");
          }else{
            $(".spanError-phone").html('');
            $("#phone").css("border-color","green");
          }

          if (accountype === 'Choose') {
            event.preventDefault();
            $("#accountype").css("border-color","red");
            $(".spanError-accountype").html("* This field is required.");
          }else{
            $(".spanError-accountype").html('');
            $("#accountype").css("border-color","green");
          }
       

          if (email === '') {
            event.preventDefault();
            $("#email-id").css("border-color","red");
            $(".spanError-1").html("* This field is required.");
          }else if(!isValidEmail(email)){
            event.preventDefault();
            $("#email-id").css("border-color","red");
            $(".spanError-1").html("* Please enter valid email.");
          }else{
            $(".spanError-1").html('');
            $("#email-id").css("border-color","green");
          }      

          if (password === '') {
            event.preventDefault();
            $(".spanError-2").html(' * This field is required.');
            $("#password").css("border-color","red");
          }else{
            $(".spanError-2").html('');
            $("#password").css("border-color","green");
          }
          // $("#formLogin").submit();
          // if (email != '' && password != '') {
          //   $("#forms").submit();
          // }
          
      });
  </script>

</body>

</html>
 