
<?php 

 // Authentication Class
  
require __DIR__.'/../Configuration/Dbconfig.php';
// use mailer class..
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Include all php class file

include 'MailerSrc/PHPMailer/src/Exception.php';
include 'MailerSrc/PHPMailer/src/SMTP.php';
include 'MailerSrc/PHPMailer/src/PHPMailer.php';
include 'MailerSrc/PHPMailer/constant.php'; 


error_reporting(0 );

 /**
  * Auth
  */
 class Auth extends Database{

    public function getProperties(){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`room` WHERE `Availability` = 0");
        $sqlQuery->execute();

        if ($rowQ = $sqlQuery->rowCount() > 0) {
         // code...
         $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
         foreach ($resultQ as $key => $value) {
           // code...
           $dataQ[] = $value;
         }

         return $dataQ;
       }

       return $rowQ = $sqlQuery->rowCount();
    }

    // isChangePassword
  public function isChangePassword(){
    // code... 
    if (isset($_POST['isChangePassword'])) {
      // code...
       
        $cpassword = $_POST['conpassword'];
        $hashCpassword = sha1($_POST['conpassword']);
        $email = $_POST['UserEmail'];
        $npassword = $_POST['newpassword'];
        $hashNpassword = sha1($_POST['newpassword']);
        if ($cpassword != $npassword) {
          // code...
          // return "Error : New and Confirm password does not matched.";
          return "<div class='alert alert-danger text-center'>Error: New and Confirm password does not matched.</div>";
        }else{
          $sqlQuery = $this->conn->prepare("UPDATE `real_state_db`.`user_account` SET `password` = '$hashCpassword', `passwordhash` = '$cpassword' WHERE `email` = '$email'");
          // return $sqlQuery->execute() ;
             $sqlQuery->execute();
           // ? 'Success : Password changed successfully..' : 'Error : Check the maria DB.';
          return "<div class='alert alert-success text-center'>Success: Password changed successfully.</div>";
        }


    }
  }

    // sendOTP
  public function sendOTP(){
    // code...
    if (isset($_POST['sendOTP'])) {
      // code...
      $otp = $_POST['otp'];
      $email = $_POST['UserEmail'];

      $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `email` = '$email' ");
      $sqlQuery->execute();
      $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resultQ as $key => $value) {
        // code...
        $otpDb = $value['otp'];
      }
      // return $otpDb;
      if ($otp == $otpDb) {
        // code...
        return "<script>window.location='forgot-password.php?step3&url&email=".$email."';</script>";
      }else{
        return "Error : Invalid OTP Verfication Number.";
      }

    }
  }


     // forgetPassword
    public function forgetPassword(){
        // code...
        if (isset($_POST['SendEmail'])) {
            // code...
           
            $email = $_POST['UserEmail'];
            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `email` = '$email' ");
            $sqlQuery->execute();
            $rowQ = $sqlQuery->rowCount();
            if($rowQ == 0) return "Error : Email not found.";
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

            try {
              
              $this->conn->beginTransaction();
              $randOtp = rand(100000,999999);
              $sqlQuery = $this->conn->prepare("
                UPDATE `real_state_db`.`user_account` 
                  SET `otp` = '$randOtp' 
                  WHERE `email` = '$email'
              ");
              $sqlQuery->execute();

              $mail = new PHPMailer(true);
                // Server Setting..
              $mail->SMTPDebug = 0;
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->Username = EMAIL;
              $mail->Password = PASSWORD;
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;

              $mail->setFrom(EMAIL, ' Adis Abeba Real Estate Management System');
              $mail->addAddress($email,'Unknown');
              $mail->isHTML(true);
              $mail->Subject = "Hi '$email' This is your password verification code.";

              $mail->Body = '<div class="row">
                  <div class="col-xl-4 col-md-6 col-sm-12">
                      <div class="card">
                          <div class="card-content">
                              <div class="card-body">
                                  <h4 class="card-title"> Adis Abeba Real Estate Management System</h4>
                                 


                                  <p class="card-text">
                                      Dear Customer the requested otp is<b> '.$randOtp.'</b> Password reset has been requested again..
                                  </p>

                                   <p class="card-text">
                                        Yours,<br>
                                        Tegenu G/mikael - System Administrator/Software Developer
                                  </p>
                              </div>
                              
                          </div>
                         
                      </div>
                      </div>
                      </div>
              ';

              $mail->AltBody = 'This is your otp number';
                  $mail->SMTPOptions = array(
                  'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                  )
              );

            if ($mail->send()) {
                // code...
                $this->conn->commit();
                return "<script>window.location='forgot-password.php?step2&url&email=".$email."';</script>";
              }else{
                return "Error : Mailer Class Error try again.";
            }

            } catch (PDOException $e) {
              if ($this->conn->inTransaction()) $this->conn->rollBack(); return "Error : Query rollBack...!";
            }
        }
    }

    // isRegister
    public function isRegister(){
        // code...
        if (isset($_POST['Register'])) {
            // code...
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];

            $passwordHash = sha1($password);
            $status = 0;
            $oneTimePassAuth = mt_rand(100000,999999);
            $created = date('Y-m-d');

            $sqlQuery = $this->conn->prepare("
                SELECT `email` 
                FROM `real_state_db`.`user_account` 
                WHERE `email` = :email
            ");
            $sqlQuery->execute([
                ':email' => $email
            ]);

            $row = $sqlQuery->fetch(PDO::FETCH_ASSOC);

            if($row > 0) return "Error: Email is already registered, try again.";

            // else return "Success";

            try {
                
                $this->conn->beginTransaction();
                $ownerid = date('mdYhs');
                $ownerid = "C".$ownerid;
                $role = "Customer";
                $date_added = date('M-d-Y');
                $otp = mt_rand(10000,99999);
                $status = 1;

                $sqlQuery = $this->conn->prepare("
                    INSERT INTO `user_account`(`account_id`, `email`, `password`, `passwordhash`, `otp`, `role`, `account_status`, `cid`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $sqlQuery->execute([
                    NULL,
                    $email,
                    $passwordHash,
                    $password,
                    $otp,
                    $role,
                    $status,
                    $ownerid
                ]);

                $lastId = $this->conn->lastInsertId(); 

                $sqlQuery = $this->conn->prepare("
                    INSERT INTO `user_details`(`user_detail_id`, `account_id`, `fullname`, `phone_number`)
                     VALUES (?, ?, ?, ?)
                ");

                $sqlQuery->execute([
                    NULL,
                    $lastId,
                    $fullname,
                    $phone
                ]);

                $this->conn->commit();

                return "<div class='alert alert-success text-center'>Success: Customer register successfully.</div>";
            } catch (PDOException $e) {
                $this->conn->inTransaction(); $this->conn->rollBack(); return "Error : Account not created.";
            }
        }
    }


        // Login or Logger Class
    public function Login(){
        // code...

        if (isset($_POST['LoginBtn'])) {
            // code...

            $UserEmail = $_POST['UserEmail'];
            $UserPass = sha1($_POST['UserPass']); // shal1 function for encryption leencryption
            // return $UserEmail;

            // return "Error code";
            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `email` = '$UserEmail' AND `password` = '$UserPass' ");
            $sqlQuery->execute();

            if ($rowQ = $sqlQuery->rowCount() > 0) {
                // code...
                $lastlogindate = date('M d Y');
                $lastlogintime = date('D, h:i: sa');
                $concat_date = $lastlogindate." ".$lastlogintime;
                $sqlQueryUpdateLoginTime = $this->conn->prepare("UPDATE `real_state_db`.`user_account` SET `last_login_date`= '$concat_date',`last_login_time` = '$lastlogintime' WHERE  `email`='$UserEmail' ");
                $sqlQueryUpdateLoginTime->execute();

                $result = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $key => $value) {
                  // code...
                
                $accounttype = $value['role'];
                // return $accounttype;

                if (empty($accounttype)) return "Error : User has not a role to Login Previlage !";

                $status = $value['account_status'];
                $level = $value['account_level'];
                
                $logintime = $value['last_login_time'];

                        if ($accounttype == 'System administrator') {
                            // code...
                            if ($status == 1) {
                                // code...
                                $_SESSION['sessionID'] = $value['email'];
                                $_SESSION['roleID'] = $accounttype;
                                echo "<script>window.location='Syadmin/dashboard';</script>";
                            }else{
                                return "<div class='alert alert-danger text-center'>Error: Your Account Locked contact System Administrator.</div>";
                                // return "Error : Your Account Locked contact System Administrator.";
                            }
                         }elseif ($accounttype == 'Owner') {
                            // code...
                            if ($status == 1) {
                                // code...
                                $_SESSION['sessionID'] = $value['email'];
                                $_SESSION['roleID'] = $accounttype;
                                echo "<script>window.location='Owner/dashboard';</script>";
                            }else{
                                return "<div class='alert alert-danger text-center'>Error: Your Account Locked contact System Administrator.</div>";
                            }
                         }elseif ($accounttype == 'Manager') {
                            // code...
                            if ($status == 1) {
                                // code...
                                $_SESSION['sessionID'] = $value['email'];
                                $_SESSION['roleID'] = $accounttype;
                                echo "<script>window.location='Manager/dashboard';</script>";
                            }else{
                                return "<div class='alert alert-danger text-center'>Error: Your Account Locked contact System Administrator.</div>";
                            }
                         } elseif ($accounttype == 'Customer') {
                        // code...
                        if ($status == 1) {
                          // code...
                          $_SESSION['sessionID'] = $value['email'];
                              $_SESSION['roleID'] = $accounttype;
                              echo "<script>window.location='Customer/dashboard';</script>";
                        }else{
                          return "<div class='alert alert-danger text-center'>Error: Your Account Locked contact System Administrator.</div>";
                        }
                        } elseif ($accounttype == 'Record Officer') {
                                    // code...
                            if ($status == 1) {
                                        // code...
                                $_SESSION['sessionID'] = $value['email'];
                                $_SESSION['roleID'] = $accounttype;
                                echo "<script>window.location='RecordOfficer/dashboard';</script>";
                            }else{
                                return "Error : Your Account Locked contact System Administrator.";
                                }
                        }else{
                        // return "Error : Email or password is incorrect.";
                            return "<div class='alert alert-danger text-center'>Error: Email or password is incorrect.</div>";
                    }

                    }
                }else{
                       return "<div class='alert alert-danger text-center'>Error: Email or password is incorrect.</div>";
                    }
            }
        }
 }