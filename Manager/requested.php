
<?php 

  session_start();
  if (isset($_SESSION['sessionID'])) {
    // code...
  }else{
    echo "<script>window.location='../pages_login.php?login&error=Session Timeout try again.';</script>";
  }

  require __DIR__.'/performMgAction.php';
  $isPerformMgOBJ = new isPerformMgAction();
  require __DIR__.'/../CommonFunction/CommenForEveryUserFunction.php';
  $CommonOBJ = new CommonFunction();

  $dataQ = $isPerformMgOBJ->getSessionUser($_SESSION['sessionID']);
  $rowQ = $isPerformMgOBJ->getSessionUser($_SESSION['sessionID']);
      foreach ($dataQ as $key => $value) {
        // code...
        $fullname = $value['fullname'];
        $role = $value['role'];
        $AccountState = $value['account_status'];
        $url = $value['profile_picture_url'];
        $lastlogintime = $value['last_login_time'];
        $IdRefferancedToOwner = $value['oid_for_mg'];
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

        <!-- <div class="col-md-1"></div> -->
        <div class="col-lg-12 col-md-8 d-flex flex-column align-items-center justify-content-center pt-2">
          <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Requested Lists <span>| Today</span></h5>
                 <p class="text-success text-center mb-3" style="font-size: 14px; font-weight: bold;"><?=$isPerformMgOBJ->PropertyRequestApproval();  ?></p>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th class="cell">#</th>
                        <th class="cell">Req Name</th>
                        <th class="cell">Req Phone</th>
                        <th class="cell">RN</th>
                        <th class="cell">FL</th>
                        <th class="cell">BL</th>
                        <th class="cell">Price</th>
                        <th class="cell">Approval</th>
                        <th class="cell">File</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                        $params = $IdRefferancedToOwner;
                        $dataQOW = $isPerformMgOBJ->isRequestedRoom($params);
                        $rowQoW = $isPerformMgOBJ->isRequestedRoom($params);
                        if ($rowQoW > 0) {
                          // code...
                          $x = 0;
                          foreach ($dataQOW as $key => $values) {
                            // code...
                            $x++; ?>
                      <tr>
                        <td><?=$x; ?></td>
                        <td class="cell">Room <?=$values['req_fullname']; ?></td>
                        <td class="cell">Room <?=$values['req_phone']; ?></td>
                        <td class="cell">Room <?=$values['req_room_no']; ?></td>
                        <td class="cell">Floor <?=$values['req_floor']; ?></td>
                        <td class="cell">Block <span><?=$values['req_block']; ?></span></td>
                        <td class="cell"><span><?=$values['sale_price']; ?></span></td>
                        <?php if ($values['res_status'] == 1) { ?>
                          <!-- <td class="cell"><span class="badge bg-success">Active</span></td> -->
                          <td>
                              <button type="button" class="btn btn-primary approve" data-bs-toggle="modal" data-bs-target="#modalTop1" style="border-radius:3px; height:25px; font-size:10px; color: #ffffff;" id="<?=$values['req_id']; ?>">
                                 Approved
                                        </button>    
                          </td>
                        <?php }else if($values['res_status'] == 2){ ?> 
                          <td>
                             <button type="button" class="btn btn-danger approve" data-bs-toggle="modal" data-bs-target="#modalTop1" style="border-radius:3px; height:25px; font-size:10px; color: #ffffff;" id="<?=$values['req_id']; ?>">
                                 Rejected
                            </button>  
                          </td>
                        <?php }else{ ?>
                            <td>
                                <button type="button"
                                  class="btn btn-secondary approve"
                                  data-bs-toggle="modal"
                                  data-bs-target="#activateModal"
                                  id="<?=$values['req_id']; ?>"
                                  style="border-radius:3px; height:25px; font-size:10px; color: #ffffff;">
                                  Not Approved
                              </button>

                            </td>
                      <?php   } ?>

                      <td>
                        <img src="../files/rooms/<?=$values['block_url']; ?>" class="card-img" width="80" height="120" style="max-width: 100px;">
                      </td>
            
                      </tr>

                       <?php } } ?>
                      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
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
  <!-- Activate/Deactivate Modal -->
<!-- DEACTIVATE MODAL -->





<div class="modal fade" id="activateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title fw-bold">Approve request</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
             <form action="" method="post">
            <div class="modal-body">

               
                  <input type="hidden" id="orderid" name="HiddenRowValue">

                <label class="form-label">Status</label>
                <select class="form-select" id="orders" name="ApproveStateValue">
                    <option value="">Choose</option>
                    <option value="0">Pending</option>
                    <option value="1">Approve</option>
                    <option value="2">Reject</option>
                </select>

                <span class="text-danger spanError-ordererror"></span>
               

            </div>

           <div class="modal-footer">
              <button type="submit" name="PropertyRequestAppBtn" class="btn btn-primary stateOrder">
                  Save
              </button>
          </div>


             </form>

        </div>
    </div>
</div>






<script>
// OPEN MODAL
document.querySelectorAll('.approve').forEach(button => {
    button.addEventListener('click', function () {

        const reqId = this.getAttribute('id');

        // Assign the hidden input value inside the modal
        document.getElementById("orderid").value = reqId;

        // Ensure modal opens properly
        const modal = new bootstrap.Modal(document.getElementById('activateModal'));
        modal.show();
    });
});

// SAVE BUTTON CLICK
// document.querySelector(".stateOrder").addEventListener("click", function () {

//     let status = document.getElementById("orders").value;
//     let reqId  = document.getElementById("orderid").value;
//     let errorSpan = document.querySelector(".spanError-ordererror");

//     // Validation
//     if (status === "") {
//         errorSpan.textContent = "Please choose a valid option";
//         return;
//     } else {
//         errorSpan.textContent = "";
//     }

//     // AJAX REQUEST
//     $.ajax({
//         url: 'approve_rooms.php',
//         type: 'POST',
//         data: {
//             room_status: status,
//             req_id: reqId
//         },
//         success: function (response) {
//             const modal = bootstrap.Modal.getInstance(document.getElementById("activateModal"));
//             modal.hide();
//             location.reload();
//         }
//     });

// });



// -------------------------
// Open ACTIVATE Modal
// -------------------------
document.querySelectorAll('.btn-open-activate').forEach(button => {
    button.addEventListener('click', function () {

        // Get data from button
        const email = this.getAttribute('data-email');
        const fullname = this.getAttribute('data-fullname');

        // Insert into modal
        document.getElementById("activate-email").value = email;
        document.getElementById("activate-fullname").textContent = fullname;

        // Show modal
        const activateModal = new bootstrap.Modal(document.getElementById('activateModal'));
        activateModal.show();
    });
});
</script>



</body>

</html>