<?php 


 // use mailer class..
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Include all php class file

include '../MailerSrc/PHPMailer/src/Exception.php';
include '../MailerSrc/PHPMailer/src/SMTP.php';
include '../MailerSrc/PHPMailer/src/PHPMailer.php';
include '../MailerSrc/PHPMailer/constant.php';


 // Include Required file 
 require __DIR__.'/../Configuration/Dbconfig.php';

 /**
  * Syadmin Perform Action
  */
 class isPerformAdminAction extends Database{
     // Get user details

    public function getUserByParam($param){

        $sqlQuery = $this->conn->prepare("SELECT * FROM real_state_db.user_account a INNER JOIN user_details u ON a.account_id = u.account_id WHERE `email` = '$param'");
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


      // Update user by url id
    public function UpdateUserMethod(){
        // code...
        if (isset($_POST['UpdateUserMethod'])) {
            // code...

            $Email = $_POST['Email'];
            $PhoneNumber = $_POST['PhoneNumber'];
            $Role = $_POST['Role'];

            $urlid = $_POST['urlid'];
            // return $urlid;

            $password = $_POST['Password'];
            $passwordHashed = sha1($_POST['Password']);

             $sqlQuery = $this->conn->prepare("
                SELECT ua.* FROM `real_state_db`.`user_account` ua 
                LEFT JOIN `real_state_db`.`user_details` ud ON ua.account_id = ud.account_id 
                WHERE ud.phone_number = '$PhoneNumber' AND ua.account_id != '$urlid'
             ");
            $sqlQuery->execute();
            if ($rowQ = $sqlQuery->rowCount() > 0) {
                // code...
                return "Error : Phone number is already registered, try again.";
            }else{
   
            $sqlQuery = $this->conn->prepare("UPDATE `real_state_db`.`user_account` SET  `role` = '$Role', `password` = '$passwordHashed', `passwordhash` = '$password' WHERE `account_id` = '$urlid' ");
            return $sqlQuery->execute() ? 'Success : User updated successfully.' : 'Error : SQL Error Check The maria db.';    

            }
        }
    }

    public function isRegisterUser(){
        // code...
        if (isset($_POST['isRegisterUser'])) {
            // code...
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $regiterBy = $_POST['regiterBy'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $password = $_POST['password'];

            $passwordHash = sha1($password);
            $status = 0;
            $oneTimePassAuth = mt_rand(100000,999999);
            $created = date('Y-m-d');

            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `email` = '$email' ");
            $sqlQuery->execute();
            $rowQ = $sqlQuery->rowCount();
            if($rowQ > 0) return "Error : Email is already register try again.";

            // $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `phone_number` = '$phone' ");
            // $sqlQuery->execute();
            // $rowQ = $sqlQuery->rowCount();
            // if($rowQ > 0) return "Error : Phone  is already register try again.";

            $this->conn->beginTransaction();

            $sqlQuery = $this->conn->prepare("INSERT INTO `real_state_db`.`user_account`(`account_id`, `email`, `password`, `passwordhash`, `otp`, `role`, `created_at`, `updated_at`, `account_status`, `last_login_time`, `last_login_date`) 
                VALUES (NULL, '$email', '$passwordHash', '$password',
                        '$oneTimePassAuth', '$role', '$created', '',0,'','')");

            if ($sqlQuery->execute()) {
                // code...
                try {
                    
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

                    $mail->setFrom(EMAIL, 'Adis Abeba City Real Estate Shop System');
                    $mail->addAddress($email,'Unknown');
                    $mail->isHTML(true);
                    $mail->Subject = "Hi '$fullname' Your Account Created Successfully";

                    $mail->Body = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                          <meta charset="UTF-8">
                          <title>Account Created</title>
                          <style>
                            body {
                              font-family: Arial, sans-serif;
                              background-color: #f4f7fa;
                              margin: 0;
                              padding: 0;
                            }
                            .email-container {
                              max-width: 600px;
                              margin: 30px auto;
                              background: #ffffff;
                              border-radius: 10px;
                              box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                              overflow: hidden;
                            }
                            .email-header {
                              background-color: #007bff;
                              color: #ffffff;
                              text-align: center;
                              padding: 20px;
                            }
                            .email-header h2 {
                              margin: 0;
                              font-size: 22px;
                            }
                            .email-body {
                              padding: 30px;
                              color: #333;
                            }
                            .email-body h3 {
                              color: #007bff;
                            }
                            .email-body p {
                              line-height: 1.6;
                              font-size: 15px;
                            }
                            .verify-btn {
                              display: inline-block;
                              background-color: #007bff;
                              color: white;
                              padding: 12px 25px;
                              text-decoration: none;
                              border-radius: 6px;
                              margin-top: 15px;
                              font-weight: bold;
                            }
                            .verify-btn:hover {
                              background-color: #0056b3;
                            }
                            .email-footer {
                              background-color: #f0f0f0;
                              text-align: center;
                              padding: 15px;
                              font-size: 13px;
                              color: #555;
                            }
                          </style>
                        </head>
                        <body>
                          <div class="email-container">
                            <div class="email-header">
                              <h2>Adis Abeba City Real Estate Shop System</h2>
                              <p>Adis Abeba City Real Estate Shop System</p>
                            </div>
                            <div class="email-body">
                              <h3>Welcome, ' . $fullname . '!</h3>
                              <p>Your account has been successfully created on the Adis Abeba City Real Estate Shop System.</p>
                              <p>Please click the button below to verify your email address and activate your account:</p>
                              
                              <p>Thank you,<br><strong>Adis Abeba City Real Estate Shop System System Administrator Zelalem Abreham</strong></p>
                            </div>
                            <div class="email-footer">
                              <p>© 2025 Adis Abeba City Real Estate Shop System | All Rights Reserved</p>
                            </div>
                          </div>
                        </body>
                        </html>
                        ';
                    $mail->AltBody = 'Account has been created successfully.';
                    $mail->SMTPOptions = array(
                          'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                if ($mail->send()) {
                    // code...
                    $lastId = $this->conn->lastInsertId(); 
                    $sqlQuery = $this->conn->prepare("INSERT INTO `real_state_db`.`user_details`(`user_detail_id`, `account_id`, `fullname`, `age`, `gender`, `date_of_birth`, `nationality`, `profile_picture_url`, `city`, `address`, `state`, `bio`) 
                        VALUES (NULL,'$lastId','$fullname','','',
                            '','ETH','','','','','')");
                    $this->conn->commit();
                    return $sqlQuery->execute() ? 'Success : Account created successfully.!"' : 'Error : Check the maria DB.';
                }else{
                    return "Error : Mailer Class Error try again.";
                }


                } catch (PDOException $e) {
                    if ($this->conn->inTransaction()) $this->conn->rollBack(); return "Error : Query rollBack...!";
                }
            }else{

                $this->conn->inTransaction(); $this->conn->rollBack(); return "Error : Account not created.";
            }
        }
    }


        // getUserById
  public function getLogAttempts(){
    // code...
    $sqlQuery = $this->conn->prepare("SELECT * FROM real_state_db.tbl_user_attempts ORDER BY id ASC ");
    $sqlQuery->execute();

     if ($rowQ = $sqlQuery->rowCount() > 0) {
      // code...
      $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQ as $key => $value) {
               // code...
               $getUserById[] = $value;
            }

            return $getUserById;
      }

      return $rowQ = $sqlQuery->rowCount();

  }

    // User status lock and unlock method....
    public function AccountState(){

    // Account Lock 
      if (isset($_POST['SusspendUser'])) {
         // code...
         $email = $_POST['email'];
         $status = 0;
         $sqlQuery = $this->conn->prepare(" 
            UPDATE 
                    `real_state_db`.`user_account` 
                SET 
                    `account_status` = ? 
                WHERE 
                    `email` = ? ");

         return $sqlQuery->execute([$status, $email]) ? 'Success : User Account Locked.' : 'Error : User Account Doesnot Locked.';
      }

      // Account UnLock 
      if (isset($_POST['UnSusspendUser'])) {
         // code...
         $email = $_POST['email'];
         $status = 1;
         $sqlQuery = $this->conn->prepare(" 
            UPDATE 
                    `real_state_db`.`user_account` 
                SET 
                    `account_status` = ? 
                WHERE 
                    `email` = ? ");

         return $sqlQuery->execute([$status, $email]) ? 'Success : User Account Active.' : 'Error : User Account Deactive or Locked.';
      }
    }

    // fetchUserList
    public function fetchUserList() {
        try {
            // Prepare query with placeholder to avoid SQL injection
            $sqlQuery = $this->conn->prepare("SELECT * FROM real_state_db.user_account a INNER JOIN user_details u ON a.account_id = u.account_id");
            $sqlQuery->execute();

            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

            // Return empty array if no users found
            return $resultQ ?: [];

        } catch (PDOException $e) {
            // Log error and return empty array
            error_log("Error fetching user list: " . $e->getMessage());
            return [];
        }
    }


    /**
     * Get user details using session variable (email)
     *
     * @param string $email
     * @return array|null Returns user details array if found, null if not
     */
   

    // Get user with session variable.. Weym Active Users

    public function getSessionUser(string $param){
        // code...
        // $param = function defination given for this method
        $sqlQuery = $this->conn->prepare("SELECT * FROM real_state_db.user_account a INNER JOIN user_details u ON a.account_id = u.account_id WHERE `email` = '$param'");
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

 }