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
 class isPerformOwnerAction extends Database{

        // getRooms
    public function SaledRoom($param){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`saled_room` WHERE `oid` = '$param' ");
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

      // getRooms
    public function isRequestedRoom($params){

        $sqlQuery = $this->conn->prepare("
            SELECT * FROM `real_state_db`.`customers_request` 
            WHERE `oid` = '$params' AND `req_status` = 1 ");
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

    // isUpdateRoom
    public function isUpdateRoom(){
        // code...
        try {
            
            if (isset($_POST['isUpdateRoom'])) {
                // code...
                $RoomNumber = $_POST['RoomNumber'];
                $roomSize = $_POST['roomSize'];
                $floornumber = $_POST['floornumber'];
                $blobknumber = $_POST['blobknumber'];
                $saleprice = $_POST['saleprice'];
                $realstateid = $_POST['realstateid'];

                $urlid = $_POST['urlid'];

                $sqlQuery = $this->conn->prepare("
                    SELECT * FROM `realstatesale`.`room` 
                    WHERE 
                        `RealStateId` = '$realstateid' AND
                        `BlockNo` = '$blobknumber' AND 
                        `RoomNumber` = '$RoomNumber' AND 
                        `FloorNumber` = '$floornumber' AND
                        `RoomID` != '$urlid' 
                ");

                $sqlQuery->execute();

                if ($rowQ = $sqlQuery->rowCount() > 0)  return "Error : Room recently registered.";

                $file = $_FILES['files'];
                    $filename = $file['name'];
                    $fileerror = $file['error'];
                    $filetmp = $file['tmp_name'];

                    $fileext = explode('.', $filename);

                    $filechecker = strtolower(end($fileext));
                    $filestoretype =  array('jpeg','jpg','png','gif','docx','ppt');

                    if (!empty($_FILES['file'])) {
                           // code...
                        if (!in_array($filechecker, $filestoretype)) {
                              // code...
                            return "Error : Wrong file extensions.";
                        }
                    }  

                    $destination = '../files/rooms/'.$filename;
                    if (move_uploaded_file($filetmp, $destination)) {
                        // code...
                        $sqlQuery = $this->conn->prepare("
                            UPDATE `room` 
                                SET 
                                    `RoomNumber`='$RoomNumber',
                                    `RoomSize`='$roomSize',
                                    `FloorNumber`='$floornumber',
                                    `BlockNo`='$blobknumber',
                                    `SalePrice`='$saleprice',
                                    `RealStateId`='$realstateid',
                                    `Block_Url`='$filename' 
                                WHERE 
                                    `RoomId` = '$urlid'
                        ");
                        $sqlQuery->execute();
                        return "<div class='alert alert-success text-center'>Success: Room update successfully.</div>";
                    }else{

                        return "Error : File Error to move Directory.";
                    }
            }
        } catch (Exception $e) {
            return "Error : while fetching rooms".$e->getMessage();
        }
    }

    // getRoomToEdit
    public function getRoomToEdit($params){
        // code...
        try {
            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`room` WHERE `RoomID` = '$params' ");
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

        } catch (Exception $e) {
            return "Error while fetching room".$e->getMessage();
        }
    }

    // getRooms
    public function getRooms($params){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`room` WHERE `Owner_email` = '$params' ");
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

    // RegisterRoom
    public function RegisterRoom(){
        // Check if form was submitted
        if (isset($_POST['RegisterRoom'])) {
            try {
                // Get form data
                $RoomNumber = isset($_POST['RoomNumber']) ? trim($_POST['RoomNumber']) : '';
                $roomSize = isset($_POST['roomSize']) ? trim($_POST['roomSize']) : '';
                $floornumber = isset($_POST['floornumber']) ? trim($_POST['floornumber']) : '';
                $blobknumber = isset($_POST['blobknumber']) ? trim($_POST['blobknumber']) : '';
                $saleprice = isset($_POST['saleprice']) ? trim($_POST['saleprice']) : '';
                $realstateid = isset($_POST['realstateid']) ? trim($_POST['realstateid']) : '';

                // Validate required fields
                if (empty($RoomNumber) || empty($roomSize) || empty($floornumber) || 
                    empty($blobknumber) || empty($saleprice) || $realstateid == 'Choose' || empty($realstateid)) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Please fill all required fields correctly.</div>";
                }

                // Validate numeric fields
                if (!is_numeric($saleprice)) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Sale price must be a valid number.</div>";
                }

                $RoomId = date('mdYhs');
                $RoomId = "R".$RoomId;

                // Check if room already exists
                $sqlQuery = $this->conn->prepare("
                    SELECT * FROM `real_state_db`.`room` 
                    WHERE 
                        `RealStateId` = ? AND 
                        `BlockNo` = ? AND 
                        `RoomNumber` = ? AND 
                        `FloorNumber` = ? 
                ");
                $sqlQuery->execute([$realstateid, $blobknumber, $RoomNumber, $floornumber]);

                if ($sqlQuery->rowCount() > 0) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Room already exists with these details.</div>";
                }

                // Handle file upload
                if (!isset($_FILES['files']) || $_FILES['files']['error'] !== UPLOAD_ERR_OK) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Please select a valid image file to upload.</div>";
                }

                $file = $_FILES['files'];
                $filename = $file['name'];
                $filetmp = $file['tmp_name'];

                if (empty($filename)) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Please select an image file.</div>";
                }

                $fileext = explode('.', $filename);
                $filechecker = strtolower(end($fileext));
                $filestoretype = array('jpeg','jpg','png','gif');

                if (!in_array($filechecker, $filestoretype)) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Please upload only image files (JPG, PNG, GIF).</div>";
                }

                // Get owner information
                $OnwerEmail = $_SESSION['sessionID'];
                $dataQ = self::getSessionUser($OnwerEmail);
                if (empty($dataQ)) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Owner session not found. Please login again.</div>";
                }

                $Ownername = '';
                foreach ($dataQ as $key => $value) {
                    $Ownername = $value['fullname'];
                }

                $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`real_estate_owners` WHERE `email` = ?");
                $sqlQuery->execute([$OnwerEmail]);
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                
                if (empty($resultQ)) {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Owner registration not found. Please complete owner registration first.</div>";
                }

                $OwnerId = '';
                $phone_number = '';
                foreach ($resultQ as $key => $value) {
                    $OwnerId = $value['owner_uniq_id'];
                    $phone_number = $value['phone_number'];
                }

                // Create directory if it doesn't exist
                $uploadDir = '../files/rooms/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate unique filename to avoid conflicts
                $uniqueFilename = time() . '_' . $filename;
                $destination = $uploadDir . $uniqueFilename;

                // Insert room data
                $sqlQuery = $this->conn->prepare("
                    INSERT INTO `room`(`RoomID`, `RUniqId`, `RoomNumber`, `RoomSize`, `FloorNumber`, `BlockNo`, `Availability`, `SalePrice`, `RealStateId`, `OwnerId`, `OwnerName`, `Owner_email`, `Address`, `ContactCenter`, `Block_Url`) 
                    VALUES (NULL, ?, ?, ?, ?, ?, 0, ?, ?, ?, ?, ?, '', '', ?)
                ");

                $result = $sqlQuery->execute([
                    $RoomId, $RoomNumber, $roomSize, $floornumber, $blobknumber, 
                    $saleprice, $realstateid, $OwnerId, $Ownername, $OnwerEmail, $uniqueFilename
                ]);

                if ($result && move_uploaded_file($filetmp, $destination)) {
                    return "<div class='alert alert-success text-center'><strong>Successfully Registered!</strong><br>Room has been registered successfully with ID: $RoomId</div>";
                } else {
                    return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>Failed to register room. Please try again.</div>";
                }

            } catch (Exception $e) {
                return "<div class='alert alert-danger text-center'><strong>Incorrect Information!</strong><br>System error: " . $e->getMessage() . "</div>";
            }
        }
        
        // Return empty string if form not submitted
        return "";
    }

    // isUpdateRealstate this function iused for update realstates information
    public function isUpdateRealstate(){
        // code...
        if (isset($_POST['UpdateRealstate'])) {
            // code...
            $propertyType = $_POST['propertyType'];
            $Address = $_POST['Address'];
            $propertySize = $_POST['propertySize'];
            $block = $_POST['block'];
            $managerEmail = $_POST['managerEmail'];

            $urlid = $_POST['urlid'];

            $dataQ = self::getSessionUser($managerEmail);

            foreach ($dataQ as $key => $value) {
                // code...
                $mgName = $value['fullname'];
                $mgPhone = $value['phone_number'];
            }

            // return $mgName;

            // Update sql here start
            $sqlQuery = $this->conn->prepare("
                UPDATE `realestateregistration` 
                    SET
                        `ManagerName`= ?,
                        `ManagerEmail`= ?,
                        `ManagerPhone`= ?,
                        `PropertyType`= ?,
                        `PropertyAddress`= ?,
                        `PropertySize`= ?,
                        `Blocks`= ?
                     WHERE `PropertyID` = ?
            ");

            $sqlQuery->execute([
                $mgName,
                $managerEmail,
                $mgPhone,
                $propertyType,
                $Address,
                $propertySize,
                $block,
                $urlid
            ]);

            return "<div class='alert alert-success text-center'>Success: Real Estate updated successfully.</div>";

        }
    }


    // getPropertyToEdit
    public function getPropertyToEdit($params){
        // code...
        try {
            
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM `real_state_db`.`realestateregistration` 
                WHERE `PropertyID` = ?
            ");

            $sqlQuery->execute([$params]);
            $rowQ = $sqlQuery->rowCount();
            if ($rowQ > 0) {
                // code...
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQ as $key => $value) {
                    // code...
                    $dataQ[] = $value;
                }

                return $dataQ;
            }

            return $rowQ;

        } catch (Exception $e) {
            return "Error while fetching property from DB".$e->getMessage();
        }
    }

    public function getMyProperty($params){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`realestateregistration` WHERE `OwnerEmail` = '$params' ");
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

    // RegisterProperty
    public function RegisterProperty(){
        // code...
        if (isset($_POST['RegisterProperty'])) {
            // code...

            $propertyType = $_POST['propertyType'];
            $Address = $_POST['Address'];
            $propertySize = $_POST['propertySize'];
            $block = $_POST['block'];
            $managerEmail = $_POST['managerEmail'];

            $OnwerEmail = $_SESSION['sessionID'];
            $realstateId = date('mdYhs');
            $realstateId = "RSID".$realstateId;

            $dataQ = self::getSessionUser($OnwerEmail);
            foreach ($dataQ as $key => $value) {
                // code...
                $oid_for_mg = $value['oid_for_mg'];
                $owner_name = $value['fullname'];
            }

            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`real_estate_owners` WHERE `email` = '$OnwerEmail' ");
            $sqlQuery->execute();
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQ as $key => $value) {
                // code...
                $owner_phone = $value['phone_number'];
            }

            $dataQ = self::getSessionUser($managerEmail);
            foreach ($dataQ as $key => $value) {
                // code...
                $mgName = $value['fullname'];
                $mgPhone = $value['phone_number'];
            }

            
            $sqlQuery = $this->conn->prepare("
                INSERT INTO `realestateregistration`(`PropertyID`, `OwnerName`, `OwnerContact`, `OwnerEmail`, `OwnerID`, `ManagerName`, `ManagerEmail`, `ManagerPhone`, `PropertyType`, `PropertyAddress`, `PropertySize`, `Blocks`, `RealStateId`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $sqlQuery->execute([
                NULL,
                $owner_name,
                $owner_phone,
                $OnwerEmail,
                $oid_for_mg,
                $mgName,
                $managerEmail,
                $mgPhone,
                $propertyType,
                $Address,
                $propertySize,
                $block,
                $realstateId
            ]);

            return "<div class='alert alert-success text-center'>Success: Real Estate successfully registred.</div>";

        }
    }

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

             $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `phone_number` = '$PhoneNumber' AND `account_id` NOT LIKE  '$urlid'");
            $sqlQuery->execute();
            if ($rowQ = $sqlQuery->rowCount() > 1) {
                // code...
                return "Error : Email or phone is already registred try again.";
            }else{
   
            $sqlQuery = $this->conn->prepare("UPDATE `real_state_db`.`user_account` SET  `role` = '$Role', `password` = '$passwordHashed', `passwordhash` = '$password' WHERE `account_id` = '$urlid' ");
            return $sqlQuery->execute() ? 'Success : User updated successfully.' : 'Error : SQL Error Check The maria db.';    

            }
        }
    }

    // isRegisterUser
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
            $owner_email = $_SESSION['sessionID'];
            $passwordHash = sha1($password);
            $status = 0;
            $oneTimePassAuth = mt_rand(100000,999999);
            $created = date('Y-m-d');

            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`real_estate_owners` WHERE `email` = '$owner_email' ");
            $sqlQuery->execute();
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQ as $key => $value) {
                // code...
                $ownerId = $value['owner_uniq_id'];
            }

            // return $ownerId;
            $rowQ = $sqlQuery->rowCount();
            if($rowQ == 0) return "Error : You can not register manager please register us owner first.";
            

            if (empty($ownerId)) return "Error : You can not register manager please register us owner first.";
            
            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE `email` = '$email' ");
            $sqlQuery->execute();
            $rowQ = $sqlQuery->rowCount();
            if($rowQ > 0) return "Error : Email is already register try again.";


            $this->conn->beginTransaction();

            $sqlQuery = $this->conn->prepare("INSERT INTO `real_state_db`.`user_account`(`account_id`, `email`, `password`, `passwordhash`, `otp`, `role`, `created_at`, `updated_at`, `account_status`, `last_login_time`, `last_login_date`,`oid_for_mg`,`ow_email_mg`) 
                VALUES (NULL, '$email', '$passwordHash', '$password',
                        '$oneTimePassAuth', '$role', '$created', '',1,'','','$ownerId','$owner_email')");

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


    // getOWInfobyId


    public function getManager($params){
        // code...
        try {
            
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM real_state_db.user_account a INNER JOIN user_details u ON a.account_id = u.account_id
                WHERE ow_email_mg = ? 
            ");
            $sqlQuery->execute([$params]);
            $rowQ = $sqlQuery->rowCount();
            if ($rowQ > 0) {
                // code...
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQ as $key => $value) {
                    // code...
                    $dataQ[] = $value;
                }

                return $dataQ;
            }

            return $rowQ;

        } catch (Exception $e) {
            error_log("Error fetching user detail: " . $e->getMessage());
            return $rowQ = 0;
        }
    }

    // Get all managers
    public function getAllManagers(){
        try {
            $sqlQuery = $this->conn->prepare("
                SELECT a.email, u.fullname, u.phone 
                FROM real_state_db.user_account a 
                INNER JOIN user_details u ON a.account_id = u.account_id
                WHERE a.role = 'Manager' AND a.account_status = 1
                ORDER BY u.fullname ASC
            ");
            $sqlQuery->execute();
            $rowQ = $sqlQuery->rowCount();
            if ($rowQ > 0) {
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                $dataQ = [];
                foreach ($resultQ as $key => $value) {
                    $dataQ[] = $value;
                }
                return $dataQ;
            }
            return [];
        } catch (Exception $e) {
            error_log("Error fetching managers: " . $e->getMessage());
            return [];
        }
    }

    // getOWInfobyId


    public function getOWInfobyId($params){
        // code...
        try {
            
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM real_state_db.real_estate_owners 
                WHERE owner_id = ? 

            ");
            $sqlQuery->execute([$params]);
            $rowQ = $sqlQuery->rowCount();
            if ($rowQ > 0) {
                // code...
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQ as $key => $value) {
                    // code...
                    $dataQ[] = $value;
                }

                return $dataQ;
            }

            return $rowQ;

        } catch (Exception $e) {
            error_log("Error fetching user detail: " . $e->getMessage());
            return $rowQ = 0;
        }
    }

    // checkBoolforComplateOWRegister
    public function checkBoolforComplateOWRegister($params){
        // code...
        try {
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM real_state_db.real_estate_owners
                WHERE email = ?
            ");

            $sqlQuery->execute([$params]);
            $rowQ = $sqlQuery->rowCount();

            return $rowQ;
        } catch (Exception $e) {
            error_log("Error fetching user detail: " . $e->getMessage());
            return $rowQ = 0;
        }
    }

       // fetchUserList
    public function getMyOwInfor($params) {
        try {
            // Prepare query with placeholder to avoid SQL injection
            $sqlQuery = $this->conn->prepare("
               SELECT * FROM real_state_db.real_estate_owners 
               WHERE email = ?
            ");
            $sqlQuery->execute([$params]);

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