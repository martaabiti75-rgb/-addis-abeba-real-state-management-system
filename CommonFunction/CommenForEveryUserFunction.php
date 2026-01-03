<?php 


/**
 * 
 */
class CommonFunction extends Database{

 public function myTransactions($params){
        // code...
        try {
            
            // Prepare query with placeholder to avoid SQL injection
            $sqlQuery = $this->conn->prepare("
                SELECT * 
                FROM real_state_db.transactions 
                 WHERE 
                    `payment_toemail` = ?
            ");
            $sqlQuery->execute([$params]);
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

            // Return empty array if no users found
            return $resultQ ?: [];

        } catch (PDOException $e) {
            // Log error and return empty array
            error_log("Error fetching transaction list: " . $e->getMessage());
            return [];
        }
    }


      // Get saled property
  public function getPurchasedProperty($params){

    $sqlQuery = $this->conn->prepare("SELECT * FROM `saled_room` WHERE `oid` = '$params'");
    $sqlQuery->execute();

    $rowQ = $sqlQuery->rowCount();
    if ($rowQ > 0) {
        // code...
        $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultQ as $key => $value) {
            // code...
            $dataQ[] = $value;
        }

        return $dataQ;
        return $rowQ;
    }
  }

    // getOwnerDetail
    public function getOwnerDetail($params){
        // code...
        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_estate_owners` WHERE `owner_uniq_id` = ?");
        $sqlQuery->execute([$params]);

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

    // proceedCheckOut

    public function proceedCheckOut(){
        // code...
        try {
            
            if (isset($_POST['proceedCheckOut'])) {
                // code...

                // $price = $_POST['totalPrice'];
                $fullname = $_POST['payerName'];
                $email = $_POST['payerEmail'];
                $cid = $_POST['cid']; // CID
                $price = $_POST['totalPrice'];

                $TTnumber = mt_rand(10000000000,99999999999);
                $referanceNo = "FT".$TTnumber;
                $orderdate = date("M-d-Y");

                $ocid = $_POST['ocid'];
                $reqid = $_POST['reqid'];

                $orderCode = mt_rand(1000000,9999999);
                $walletSelect = $_POST['walletSelect'];
                $walletAccount = $_POST['acnumber'];

                $reqid = $_POST['reqid'];

                // return $walletSelect;
                // 1. Check account number wallet name and email
                $sqlQuery = $this->connBank->prepare("
                    SELECT * FROM `real_state_bank_db`.`bank_db_table`
                        WHERE 
                            `email` = ? AND 
                            `bank_name` = ? AND
                            `account_number` = ?
                ");

                $sqlQuery->execute([
                    $email, $walletSelect, $walletAccount
                ]);

                $rowQ = $sqlQuery->rowCount();

                if (!$rowQ > 0)  return "<div class='alert alert-danger text-center'>Error: The specified account number could not be found.</div>";

                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultQ as $key => $value) {
                    // code...
                    $userBalance = $value['balance'];
                }

                $walletSelectOwner = $_POST['walletSelectOwner'];
                $ownerEmail = $_POST['ownerEmail'];

                // 2. Check account number wallet name and email for owner
                $sqlQuery = $this->connBank->prepare("
                    SELECT * FROM `real_state_bank_db`.`bank_db_table`
                        WHERE 
                            `email` = ? AND 
                            `bank_name` = ? 
                ");

                $sqlQuery->execute([
                    $ownerEmail, $walletSelectOwner
                ]);

                $rowQ = $sqlQuery->rowCount();

                if (!$rowQ > 0)  return "<div class='alert alert-danger text-center'>Error: The specified account number could not be found.</div>";

                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultQ as $key => $value) {
                    // code...
                    $ownerBalance = $value['balance'];
                    $ownerWalletAccount = $value['account_number'];
                }

                // return $ownerWalletAccount;

                $UserRollBackBalance = $userBalance - $price;
                $OwnerRollBackPrice = $ownerBalance + $price;

                if ($userBalance < $price) return "<div class='alert alert-danger text-center'>Error: There is not enough amount to pay.</div>";
                // else return "Pay";

                $sqlQuery = $this->conn->prepare("SELECT * FROM `customers_request` WHERE `req_id` = '$reqid' ");
                $sqlQuery->execute();
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQ as $key => $value) {
                    // code...
                    $req_room_id = $value['req_room_id'];
                    $req_room_no = $value['req_room_no'];
                    $req_floor = $value['req_floor'];
                    $req_block = $value['req_block'];
                    $room_size = $value['room_size'];
                    $Block_Url = $value['block_url'];
                    $sale_price = $value['sale_price'];
                    $rid = $value['rid'];
                    $oid = $value['oid'];
                    $oname = $value['oname'];

                }

                $sqlQuery = $this->conn->prepare("SELECT * FROM `saled_room` WHERE `res_room_id` = '$req_room_id' ");
                $sqlQuery->execute();
                $rowQ = $sqlQuery->rowCount();
                if ($rowQ > 0) return "Error : Property recently salled.";
                
                $sqlQuery = $this->conn->prepare("INSERT INTO `saled_room`(`res_id`, `res_room_id`, `res_room_no`, `res_floor`, `res_block`, `room_size`, `sale_price`, `rid`, `oid`, `oname`, `url_image`, `cid`, `res_fullname`, `res_email`, `res_phone`, `res_date`, `saled_status`, `reserved_status2`) 

                VALUES (NULL,'$req_room_id','$req_room_no','$req_floor',
                            '$req_block','$room_size','$sale_price','$rid','$oid',
                            '$oname','$Block_Url','$cid','$fullname','$email','$phone','$orderdate',1,'')");

                if ($sqlQuery->execute()) {
                    // code...
                     $sqlQuery = $this->conn->prepare("UPDATE `customers_request` SET `req_status` = 2 WHERE `req_id` = '$reqid'");
                     if ($sqlQuery->execute()) {
                         // code...
                        // 4. Update bank query
                        // 4.1 User side
                        $sqlQuery = $this->connBank->prepare("
                            UPDATE `real_state_bank_db`.`bank_db_table`
                                SET
                                    `balance` = ?
                                WHERE
                                    `email` = ? AND
                                    `account_number` = ? AND
                                    `bank_name` = ?

                        ");

                        $sqlQuery->execute([
                            $UserRollBackBalance,
                            $email,
                            $walletAccount,
                            $walletSelect
                        ]);

                        // 4.2 Owner side

                        // 4.1 Lounch side
                        $sqlQuery = $this->connBank->prepare("
                            UPDATE `real_state_bank_db`.`bank_db_table`
                                SET
                                    `balance` = ?
                                WHERE
                                    `account_number` = ?

                        "); 

                        $sqlQuery->execute([
                            $OwnerRollBackPrice,
                            $ownerWalletAccount
                        ]);

                        $sqlQuery = $this->conn->prepare("
                                INSERT INTO `transactions`(`transaction_id`, `amount`, `transaction_date`, `transaction_type`, `description`, `name`, `email`, `payemntto`, `payment_method`, `currency`, `status`, `reference_number`, `order_code`,`payment_toemail`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ");
                            $sqlQuery->execute([
                                NULL, 
                                $price,
                                $orderdate,
                                'Credit',
                                'Payment For Property',
                                $fullname,
                                $email,
                                $oname,
                                'From Vertual API Transfer',
                                'ETB',
                                'Success',
                                $referanceNo,
                                $orderCode,
                                $ownerEmail
                            ]);

                            $sqlQuery = $this->conn->prepare("UPDATE `room` SET `Availability` = 2 WHERE `RUniqId` = '$req_room_id' ");
                            $sqlQuery->execute();
                            return "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    showPaymentSuccessModal();
                                });
                                
                                function showPaymentSuccessModal() {
                                    // Create modal HTML
                                    const modalHTML = `
                                        <div class='modal fade' id='paymentSuccessModal' tabindex='-1' aria-labelledby='paymentSuccessModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                    <div class='modal-header bg-success text-white'>
                                                        <h5 class='modal-title' id='paymentSuccessModalLabel'>
                                                            <i class='bi bi-check-circle-fill me-2'></i>Payment Successful
                                                        </h5>
                                                        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body text-center'>
                                                        <div class='mb-3'>
                                                            <i class='bi bi-check-circle-fill text-success' style='font-size: 4rem;'></i>
                                                        </div>
                                                        <h4 class='text-success mb-3'>Payment Successfully Completed!</h4>
                                                        <p class='mb-0'>Your payment has been processed successfully. Thank you for your transaction.</p>
                                                    </div>
                                                    <div class='modal-footer justify-content-center'>
                                                        <button type='button' class='btn btn-success' data-bs-dismiss='modal'>
                                                            <i class='bi bi-check me-2'></i>OK
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    
                                    // Add modal to page
                                    document.body.insertAdjacentHTML('beforeend', modalHTML);
                                    
                                    // Show modal
                                    const modal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'));
                                    modal.show();
                                    
                                    // Remove modal from DOM when hidden
                                    document.getElementById('paymentSuccessModal').addEventListener('hidden.bs.modal', function() {
                                        this.remove();
                                    });
                                }
                            </script>";

                     }
                }


                // Get OWNER ACCOUNT 
                // else  return "<div class='alert alert-success text-center'>Success: The specified account number could be found.</div>";


            }
        } catch (PDOException $e) {
            $this->connBank->inTransaction(); $this->connBank->rollBack();
            // return "Error : Query rollBack.";
            return "<div class='alert alert-danger text-center'>Error: Query rollBack.</div>";
        }
    }

    public function getTotalProperty(){

         $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`room`");
         $sqlQuery->execute();
         $PropertyQty = $sqlQuery->rowCount();
         return $PropertyQty;
    }

    

    public function getProperties(){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `room` WHERE `Availability` = 0");
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

     // get Bind Account
    public function getBindAccount($params) {
    try {
        // Prepare the query safely
        $sqlQuery = $this->conn->prepare("
            SELECT * 
            FROM `real_state_bank_db`.`bank_db_table` 
                WHERE `email` = :email
            ");

            // Bind parameter safely
            $sqlQuery->bindValue(':email', $params, PDO::PARAM_STR);
            $sqlQuery->execute();

            // Check if rows exist
            if ($sqlQuery->rowCount() > 0) {
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
                return $resultQ; // return array of rows
            }

            // No rows found
            return [];

        } catch (PDOException $e) {
            // Log error and return empty array
            error_log("Error fetching bind account: " . $e->getMessage());
            return [];
        }
    }


    // isBindAccount
    public function isBindAccount(){
        // code...
        if (isset($_POST['isBindAccount'])) {
            // code...
            $email = $_POST['email'];
            $accountNumber = $_POST['accountNumber'];
            $phone = $_POST['phone'];
            $fullname = $_POST['fullname'];
            $bankName = $_POST['bankName'];

            try {
                
                $this->conn->beginTransaction();
                $sqlQuery = $this->connBank->prepare("
                    SELECT * 
                    FROM `real_state_bank_db`.`bank_db_table`
                    WHERE `account_number` = :accountNumber
                      AND `bank_name` = :bankName
                ");

                $sqlQuery->bindParam(':accountNumber', $accountNumber, PDO::PARAM_STR);
                $sqlQuery->bindParam(':bankName', $bankName, PDO::PARAM_STR);
                $sqlQuery->execute();
                $rowQ = $sqlQuery->rowCount();
                if($rowQ > 0) return "<div class='alert alert-danger text-center'>Error: This bank account is already binded with this bank.</div>";

                $sqlQuery = $this->connBank->prepare("INSERT INTO `real_state_bank_db`.`bank_db_table`(`bid`, `fullname`, `phone`, `email`, `bank_name`, `account_type`, `currency`, `account_number`, `balance`) 
                    VALUES (NULL,'$fullname','$phone','$email','$bankName','Saving','ETB','$accountNumber',2500000)");
                $this->conn->commit();
                $sqlQuery->execute();
                return "<div class='alert alert-success text-center'>Success: Account binded successfully.</div>";
                 // ? 'Success : Account binded successfully.!"' : 'Error : Check the maria DB.';

            } catch (PDOException $e) {
                $this->conn->inTransaction(); $this->conn->rollBack(); return "Error : Account not created.";
            }
        }
    }

    // isUpdateOWInfo
    public function isUpdateOWInfo(){
        // code...
        if (isset($_POST['isUpdateOWInfo'])) {
            // code...
            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $Address = trim($_POST['Address'] ?? '');
            $Address2 = trim($_POST['Address2'] ?? '');
            $City = trim($_POST['City'] ?? '');
            $Region = trim($_POST['Region'] ?? '');
            $Gender = trim($_POST['Gender'] ?? '');
            $fcn_full = trim($_POST['fcn_full'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $urlid = trim($_POST['urlid'] ?? '');

            $checkQuery = $this->conn->prepare("
                    SELECT * FROM real_estate_owners 
                    WHERE (email = ? OR fiyda = ?) 
                      AND owner_id != ?
            ");

            $checkQuery->execute([$email, $fcn_full, $urlid]);

            if ($checkQuery->rowCount() > 0) {
                return "<div class='alert alert-danger text-center'>Error: You are already registered or your request is under consideration.</div>";
            }else{

                $sqlQuery = $this->conn->prepare("
                    UPDATE `real_estate_owners` 
                        SET 
                            `phone_number`= ?,
                            `fiyda`= ?,
                            `address_line1`= ?,
                            `address_line2`= ?,
                            `city`= ?,
                            `state`= ?,
                            `gender`= ?
                        WHERE `owner_id` = ?
                ");

                $sqlQuery->execute([
                    $phone,
                    $fcn_full,
                    $Address,
                    $Address2,
                    $City,
                    $Region,
                    $urlid,
                    $Gender
                ]);

                return "<div class='alert alert-success text-center'>Success: Owner info updated successfully.</div>";
            }
        }
    }

      // registerUsow
    public function isRequestForOwner(){
        // code...
        
        if (isset($_POST['isRequestForOwner'])) {
            // code...
            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $Address = trim($_POST['Address'] ?? '');
            $Address2 = trim($_POST['Address2'] ?? '');
            $City = trim($_POST['City'] ?? '');
            $Region = trim($_POST['Region'] ?? '');
            $Gender = trim($_POST['Gender'] ?? '');
            $fcn_full = trim($_POST['fcn_full'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            // return $fullname;
            // Generate owner ID
            $ownerid = "RS" . date('mdYHis');

            // Check if user already exists
            $checkQuery = $this->conn->prepare("SELECT * FROM real_estate_owners WHERE email = ? || fiyda = ?");
            $checkQuery->execute([$email, $fcn_full]);
            if ($checkQuery->rowCount() > 0) {
                return "<div class='alert alert-danger text-center'>Error: You are already registered or your request is under consideration.</div>";
            }else{
                

                 // Insert into database
                $insertQuery = $this->conn->prepare("
                    INSERT INTO real_estate_owners 
                    (owner_id, owner_uniq_id, fullname, email, address_line1, address_line2, city, state, country, gender, fiyda, phone_number) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)
                ");
                
                $success = $insertQuery->execute([
                    NULL,
                    $ownerid,
                    $fullname,
                    $email,
                    $Address,
                    $Address2,
                    $City,
                    $Region,
                    'Ethiopia',
                    $Gender,
                    $fcn_full,
                    $phone
                ]);

                return "<div class='alert alert-success text-center'>Success: You are successfully registered us owner.</div>";
            }
        }
    }

      // fetchUserList
    public function fetchPlayers() {
        try {
            // Prepare query with placeholder to avoid SQL injection
            $sqlQuery = $this->conn->prepare("SELECT * FROM real_state_db.playerregistration ");
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

   public function confirmStatus(string $params){
      // code...
      if (isset($_POST['confirmCongrats'])) {
         // code...
         $sqlQuery = $this->conn->prepare("
            UPDATE 
               `real_state_db`.`user_account` 
            SET `congrats_status` = 1
            WHERE `email` = ?
         ");
         $sqlQuery->execute([$params]);
      }
   }

   // getState
   public function congratsModalBool($params){
        // code...
         $sqlQuery = $this->conn->prepare("
                SELECT * FROM `real_state_db`.`user_account` 
                WHERE `email` = '$params'  
        ");
         $sqlQuery->execute();
         $resultQ = $sqlQuery->fetchAll();
         foreach ($resultQ as $key => $value) {
             // code...
             $congratsModalBool = $value['congrats_status'];
         }
         return $congratsModalBool;
         
    }

	// change password
    public function changePassword(){
    // code...
    if (isset($_POST['changePasswordBtn'])) {
         // code...
         $email = $_POST['email'];
         $oldPassword = $_POST['oldPassword'];
         $newPassword = $_POST['newPassword'];
         $conPassword = $_POST['conPassword'];

         // check if new and confirm password match..
         if ($newPassword != $conPassword) {
            // code...
            return "Error : New and Confirm password not matched.";
         }else{
            // return "Success : OK";
            // check if old password is correct

            $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`user_account` WHERE  `email` LIKE '$email'");
            $sqlQuery->execute();
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQ as $key => $value) {
               // code...
               $dbPassword = $value['passwordhash'];
            }

            if ($dbPassword != $oldPassword) {
               // code...
               return "Error : OLD password is not correct. Try again.";
            }else{

               // HASH password with encryption algorithm
               $hashPassword = sha1($newPassword);
               $sqlQuery = $this->conn->prepare("UPDATE `real_state_db`.`user_account` SET `password` = '$hashPassword', `passwordhash` = '$conPassword' WHERE `email` = '$email'");
               if ($sqlQuery->execute()) {
                  // code...
                  return "Success : Password changed successfully.";
               }else{
                  return "Error : Something want wrong, Please Try Again.";
               }
            }
         }
         
      }
  }


	// UpdateSetting
    public function UpdateSetting(){
        if (isset($_POST['UpdateSetting'])) {
            // code...

            $Address = $_POST['Address'];
            $City = $_POST['City'];
            $Region = $_POST['Region'];
            $Gender = $_POST['Gender'];
            $Bio = $_POST['Bio'];


            $urlid = $_POST['urlid'];

            $sqlQuery = $this->conn->prepare("UPDATE `real_state_db`.`user_details` 
                SET `address`='$Address',`city`='$City',`state`='$Region',`gender`='$Gender',`bio`='$Bio' WHERE `account_id` = '$urlid'");
            if ($sqlQuery->execute()) {
                // code...
                return "Succcess : Profile setting Update successfully.";
            }else{
                return "Error : SQL QUERY Error Check The maria db.";
            }
        }
    }

	// Total admins
	public function getTotalAdmins() {
	    try {
	        $sqlQuery = $this->conn->prepare("SELECT COUNT(*) AS total FROM `real_state_db`.`user_account` WHERE `role` = :role");
	        $sqlQuery->execute(['role' => 'System administrator']);
	        $result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
	        return $result ? (int)$result['total'] : 0;
	    } catch (PDOException $e) {
	        // Log error or handle gracefully
	        error_log("Error fetching admin quantity: " . $e->getMessage());
	        return 0;
	    }
	}


    // Total fans
	public function getCustomerQty() {
	    try {
            $params = 'Customer';
	        $sqlQuery = $this->conn->prepare("
                SELECT COUNT(*) AS total FROM `real_state_db`.`user_account`
                WHERE `role` = ?
            ");
	        $sqlQuery->execute([$params]);
	        $result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
	        return $result ? (int)$result['total'] : 0;
	    } catch (PDOException $e) {
	        // Log error or handle gracefully
	        error_log("Error fetching fan quantity: " . $e->getMessage());
	        return 0;
	    }
	}


	// Total fans
	public function getTotalManager() {
	    try {

            $params = 'Manager';
	        $sqlQuery = $this->conn->prepare("
                SELECT COUNT(*) AS total 
                FROM `real_state_db`.`user_account`
                WHERE `role` = ?
            ");
	        $sqlQuery->execute([$params]);
	        $result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
	        return $result ? (int)$result['total'] : 0;
	    } catch (PDOException $e) {
	        // Log error or handle gracefully
	        error_log("Error fetching fan quantity: " . $e->getMessage());
	        return 0;
	    }
	}

}