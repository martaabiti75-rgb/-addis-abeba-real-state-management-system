
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
      }


 // $congratsModalBool = $CommonOBJ->congratsModalBool($_SESSION['sessionID']);

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
  * Folder Super/Admin
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard" class="logo d-flex align-items-center">
        <img src="../assets/img/aacitylogo.jpg" alt="" style="max-height: 80PX; max-width: 60px;">
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
        <!-- <div class="col-md-4"></div> -->
        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center pt-2">
          <div class="card ">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <a href="#" class="newlogo d-flex align-items-center w-auto">
                 
                  <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                </a>
                    <h5 class="card-title text-center pb-0 fs-4">Room (Site Registration)</h5>
                    
                  </div>
                  <!--class: needs-validation attribute:novalidate -->
                  <form class="row g-0" method="post" action="" enctype="multipart/form-data">
                    
                    
                    <p class="text-center spanError errorALL">
                      <?php 
                        // Debug: Show if form was submitted
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                          echo "<small style='color: blue;'>Form submitted via POST</small><br>";
                          if (isset($_POST['RegisterRoom'])) {
                            echo "<small style='color: green;'>RegisterRoom button detected</small><br>";
                          }
                        }
                        echo $isPerformOwnerOBJ->RegisterRoom(); 
                      ?>
                    </p>
                     
                     <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Room Number *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="RoomNumber" class="form-control" id="RoomNumber" placeholder="Enter Room number">
                      </div>
                      <span class="text-danger spanError spanError-RoomNumber"></span>
                    </div>

                     <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Room Size *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="roomSize" class="form-control" id="roomSize" placeholder="Enter Room Size">
                      </div>
                      <span class="text-danger spanError spanError-roomSize"></span>
                    </div>

                    <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Floor N  *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="floornumber" class="form-control" id="floornumber" placeholder="Enter Floor number">
                      </div>
                      <span class="text-danger spanError spanError-floornumber"></span>
                    </div>

                     <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Blook N *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="blobknumber" class="form-control" id="blobknumber" placeholder="Enter Floor number">
                      </div>
                      <span class="text-danger spanError spanError-blobknumber"></span>
                    </div>

                    <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Sale Price *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="saleprice" class="form-control" id="saleprice" placeholder="Enter Floor number">
                      </div>
                      <span class="text-danger spanError spanError-saleprice"></span>
                    </div>

                     <div class="col-md-12">
                      <label for="yourUsername" class="col-form-label-sm">Real State *</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <select id="realstateid" name="realstateid" class="form-select">
                          <option value="Choose">Choose...</option>

                          <?php 
                            $dataUserList = $isPerformOwnerOBJ->getMyProperty($_SESSION['sessionID']);
                            $rowUserList = $isPerformOwnerOBJ->getMyProperty($_SESSION['sessionID']);
                            if ($rowUserList > 0) {
                              foreach ($dataUserList as $key => $value) {
                          ?>
                          <option value="<?=$value['RealStateId']; ?>"><?=$value['RealStateId']; ?> / <?=$value['PropertyAddress']; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <span class="text-danger spanError spanError-realstateid"></span>
                    </div>

                    <div class="col-md-12 ">
                       <label for="yourUsername" class="col-form-label-sm">File *</label>
                      <input type="file" class="form-control" id="files" value="" name="files">
                      <span class="text-danger spanError spanError-files"></span>
                    </div>

                    <div class="col-12 mt-5">
                      <input type="submit" name="RegisterRoom" value="Register Room" class="btn btn-primary w-100" />
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
  <!-- Template Main JS File -->
  <script src="../dashboard/assets/js/main.js"></script>
  <script src="../dashboard/assets\ajax\jquery-2.2.4.min.js"></script>
  <script src="../dashboard/assets\ajax\jquery.js"></script>
  <script src="../dashboard/assets\ajax\jquery.min.js"></script>

 <script type="text/javascript">
// Remove all JavaScript that might interfere with form submission
// Let the form submit naturally without any JavaScript intervention
</script>


</body>

</html>
 