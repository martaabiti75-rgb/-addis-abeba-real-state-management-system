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
      <!-- <div class="theme-setting-wrapper">
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
      </div> -->
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
              <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
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
              የተጠቃሚ ቅጽ ያክሉ!
            </h3>
          </div>

          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add User Form !</h4>
                  <p class="card-description">
                    የተጠቃሚ ቅጽ ያክሉ!
                  </p>
                  <p class="text-center text-success spanError"><?= $isPerformAdminOBJ->isRegisterUser(); ?></p>
                  <form class="forms-sample" id="userForm" action="" method="post">
                    <div class="form-group">
                      <label for="exampleInputUsername1">ሙሉ ስም</label>
                      <input type="text" class="form-control" id="fullname" placeholder="fullname" name="fullname">
                      <span class="text-danger" id="spanError-fullname"></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">የኢሜል አድራሻ</label>
                      <input type="email" class="form-control" id="email" placeholder="email" name="email">
                      <span class="text-danger" id="spanError-email"></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">ስልክ ቁጥር</label>
                      <input type="number" class="form-control" id="phone" placeholder="phone" name="phone" pattern="[0-9]">
                      <span class="text-danger" id="spanError-phone"></span>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">ሚና/Role</label>
                      <select class="form-control" name="role" id="role" placeholder="role">
                        <option>Choose</option>
                        <option>System administrator</option>
                        <option>Revenue Officer</option>
                        <option>System Encode</option>
                        <option>Record Officer</option>
                        <option>Trader</option>
                      </select>
                      <span class="text-danger" id="spanError-role"></span>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">የይለፍ ቃል</label>
                      <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                      <span class="text-danger" id="spanError-password"></span>
                    </div>
                    
                   
                    <button type="submit" class="btn btn-primary mr-2" name="RegisterUserForm">አስገባ</button>
                    <button class="btn btn-light">Cancel</button>
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
    // const regexname = /[a-zA-Z]$/;
    // const regexname = /[0-9]$/;
    

    // const regexname = /^[a-zA-Z ]+$/;


    const regexfullname = /^[a-zA-Z ]{2,50}$/;

    // === PASSWORD VALIDATION FUNCTION ===
    function validatePassword() {
        let password = $("#password").val().trim();
        if (password === "") {
            $("#spanError-password").text("* Password is required.");
            $("#password").css("border-color", "red");
            return false;
        } else if (password.length < 6) {
            $("#spanError-password").text("* Password must be at least 6 characters.");
            $("#password").css("border-color", "red");
            return false;
        } else {
            $("#spanError-password").text("");
            $("#password").css("border-color", "green");
            return true;
        }
    }

    function validatePhone() {
        // body...
        let phone = $("#phone").val();

        let regexname = /^[0-9]{10}$/;
      if (phone === '') {
        $("#phone").css("border-color","red");
        $("#spanError-phone").html("*  This field is required.");
        return false;
      }else if(!regexname.test(phone)){
        $("#phone").css("border-color","red");
        $("#spanError-phone").html("*  Phone Number must be character.");
        return false;
      }else if(phone.charAt(0) != 0){
        $("#phone").css("border-color","red");
        $("#spanError-phone").html("* phoneone Number start with 0. ");
        return false;
      }else if(phone.charAt(1) != 9 && phone.charAt(1) != 7){
        $("#phone").css("border-color","red");
        $("#spanError-phone").html("* Tel Number start with 09 / 07. ");
        return false;
      }else if(phone.length != 10){
        $("#phone").css("border-color","red");
        $("#spanError-phone").html("* Phone number must be 10 Digit. ");
        return false;
      }else{
        $("#spanError-phone").html('');
        $("#phone").css("border-color","green");
        return true;
      }
    }

    // === ROLE VALIDATION FUNCTION ===
    function validateRole() {
        let role = $("#role").val();
        if (role === "Choose") {
            $("#spanError-role").text("* Please select a role.");
            $("#role").css("border-color", "red");
            return false;
        } else {
            $("#spanError-role").text("");
            $("#role").css("border-color", "green");
            return true;
        }

    }


    function validateFullname() {
        // body...
        let fullname = $("#fullname").val();
          if (fullname === '') {
            $("#spanError-fullname").html(' * This field is required.');
            $("#fullname").css("border-color","red");
            return false;
          }else if(!regexname.test(fullname)){
            $("#spanError-fullname").html(' * Fullname must be character.');
            $("#fullname").css("border-color","red");
            return false;
          }else{
            $("#spanError-fullname").html('');
            $("#fullname").css("border-color","green");
            return true;
          }
    }

        // === ROLE VALIDATION FUNCTION ===
    function validateEmail() {
        let email = $("#email").val();
        if (email === "") {
            $("#spanError-email").html("* This field is required.");
            $("#email").css("border-color", "red");
            return false;
        } else if (!isValidEmail(email)) {
            $("#spanError-email").html("* Please enter valid email.");
            $("#email").css("border-color", "red");
            return false;
        } else {
            $("#spanError-email").html("");
            $("#email").css("border-color", "green");
            return true;
        }
    }

    // Inline validation triggers
    $("#password").on("blur keyup", validatePassword);
    $("#role").on("change", validateRole);
    $("#email").on("blur keyup", validateEmail);
    $("#fullname").on("blur keyup", validateFullname);
    $("#phone").on("blur keyup", validatePhone);

    // Form submission validation
    $("#userForm").on("submit", function(event) {
        let isPasswordValid = validatePassword();
        let isRoleValid = validateRole();
        let isEmailValid = validateEmail();
        let isFullnameValid = validateFullname();
        let isPhoneValid = validatePhone();

        if (!isPasswordValid || !isRoleValid || !isEmailValid || !isFullnameValid || !isPhoneValid) {
            event.preventDefault(); // Stop form submission if invalid
        }
    });

});
</script>
</body>


</html>
