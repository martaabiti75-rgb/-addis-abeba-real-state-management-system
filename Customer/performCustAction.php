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
 class isPerformCustAction extends Database{

    // Start 

     public function myTransactions($params){
        // code...
        try {
            
            // Prepare query with placeholder to avoid SQL injection
            $sqlQuery = $this->conn->prepare("
                SELECT * 
                FROM real_state_db.transactions 
                 WHERE 
                    `email` = ?
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

 public function getCarts($param){

    $sqlQuery = $this->conn->prepare("SELECT * FROM `customers_request` WHERE `cid` = '$param' AND `req_status` = 2");
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

   // getRooms
  public function isRequestedRoom($params){

        $sqlQuery = $this->conn->prepare("
            SELECT * FROM `real_state_db`.`customers_request` 
            WHERE `cid` = '$params' AND `req_status` = 1 ");
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


      // Get saled property
public function getPurchasedProperty($params){

    $sqlQuery = $this->conn->prepare("SELECT * FROM `saled_room` WHERE `cid` = '$params'");
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


      // getRooms
    public function getRooms(){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`room` ");
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

      public function addToCart(){

    if (isset($_POST['addToCart'])) {
      // code...

       $cid = $_POST['cid'];
       $userid = $_POST['userid']; // User Id Session Value
       $rid = $_POST['rid']; // Real state Id
       $roomid = $_POST['roomid'];  // Room id
       $price = $_POST['price']; // Property price
       $fullname = $_POST['fullname']; // customer name
       $oid = $_POST['oid']; // Owner Id
       $oname = $_POST['oname'];  // Owner Name

       $cartAdded = date("M-d-Y"); // Request Date

       // return $rid;

       $sqlQuery = $this->conn->prepare("SELECT * FROM `customers_request` WHERE `cid` = '$cid' AND `req_room_id` = '$roomid'  AND `req_status` = 1 ");
       $sqlQuery->execute();
       $rowQ = $sqlQuery->rowCount();
       if ($rowQ > 0) {
         // code...
          return "Error : Property recently requested.";
       }else{

          // Get Room Detailes 
          $sqlQuery = $this->conn->prepare("SELECT * FROM `room` WHERE `RUniqId` = '$roomid'");
          $sqlQuery->execute();
          $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
          foreach ($resultQ as $key => $value) {
            // code...
            $BlockNo = $value['BlockNo'];
            $FloorNumber = $value['FloorNumber'];
            $RoomNumber = $value['RoomNumber'];
            $RoomSize = $value['RoomSize'];
            $Block_Url = $value['Block_Url'];
            // $ContactCenter = $value['ContactCenter'];
          }

          // return $RoomSize;

          $sqlQuery = $this->conn->prepare("INSERT INTO `customers_request`(`req_id`, `req_room_id`, `req_room_no`, `req_floor`, `req_block`, `room_size`, `Block_Url`, `sale_price`, `rid`, `oid`, `oname`, `cid`, `req_fullname`, `req_email`, `req_phone`, `req_date`, `req_status`, `res_status`, `order_code`) 

            VALUES (NULL,'$roomid','$RoomNumber','$FloorNumber',
                  '$BlockNo','$RoomSize','$Block_Url','$price','$rid',
                  '$oid','$oname','$cid','$fullname','$userid','','$cartAdded',1,0,'')");

            $sqlQuery->execute(); // ? 'Success : Property requested successfully.' : 'Error : SQL Error Check The maria DB.';
            return "<div class='alert alert-success text-center'>Success: Property requested successfully..</div>";
          // return "Success : Property requested successfully.";
       }

    }
  }

     // Get Acitive property
  public function getActiveCart($param,$param2){
    $sqlQuery = $this->conn->prepare("SELECT * FROM `customers_request` WHERE `req_status` = '$param' AND `cid` = '$param2' ORDER BY `req_id` DESC");
    $sqlQuery->execute();
    $rowCartList = $sqlQuery->rowCount();
    if ($rowCartList > 0) {
        // code...
        $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultQ as $key => $value) {
            // code...
            $dataCartList[] = $value;
        }

        return $dataCartList;
        return $rowCartList;
    }
  }

    public function checkOut()
    {
        // code...
    }

    public function removeCart(){
    if (isset($_POST['removeCart'])) {
        // code...
        $cartid = $_POST['cartid'];
        
          // Repalce Producty quantity
          $sqlQuery = $this->conn->prepare("DELETE FROM `customers_request` WHERE `req_id` = '$cartid'");
          return $sqlQuery->execute() ? 'Success : Cart removed successfully.' : 'Error : SQL Error Check The maria DB.';

        }
    }

    public function getCartQuantity($param,$param2){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `customers_request` WHERE `req_status` = '$param' AND `cid` = '$param2'");
        $sqlQuery->execute();
        $CartQuantity = $sqlQuery->rowCount();

        return $CartQuantity;
    }
    // End

    // getActiveOrders
    public function getCheckedOrders($params, $params2){
        // code...
        try {
            
            // Prepare query with placeholder to avoid SQL injection
            $sqlQuery = $this->conn->prepare("
                SELECT * 
                FROM lounchssdb.order_tables 
                WHERE `seller_status` = ? and `deliver_status` = ?  AND `order_cid` = ?
            ");
            $sqlQuery->execute([$params, $params, $params2]);
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

            // Return empty array if no users found
            return $resultQ ?: [];

        } catch (PDOException $e) {
            // Log error and return empty array
            error_log("Error fetching transaction list: " . $e->getMessage());
            return [];
        }
    }

    // isRemoveCarts

    public function isRemoveCarts(){
        // code...
        try {
            if (isset($_POST['trashCarts'])) {
                // code...
                $generatedCode = $_POST['generatedCode'];
                $cartID = $_POST['cartID'];
                $email = $_SESSION['sessionID'];

                $sqlQuery = $this->conn->prepare("
                    DELETE FROM `lounchssdb`.`cart_items`
                    WHERE 
                        `cart_id` = ? AND 
                        `item_codes` = ?
                ");

                $sqlQuery->execute([
                    $cartID,
                    $generatedCode
                ]);

                return "Success : Cart removed successfully."; 
            }
        } catch (PDOException $e) {
            return "Error :". $e->getMessage();
        }
    }


  // getCartById 
  public function getCartById($params){
      // code...
      try {
          $sqlQuery = $this->conn->prepare("
            SELECT * FROM `lounchssdb`.`cart_items` 
            WHERE `cart_id` = ?
        ");
        $sqlQuery->execute([$params]);
        $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
        return $resultQ ?: [];
      } catch (PDOException $e) {
           return "Error : ". $e->getMessage();
      }
  }

    // editCarts
    public function editCarts(){
        // code...
        try {
            if (isset($_POST['editCarts'])) {
                // code...
                $email = $_POST['email'];
                $itemname= $_POST['itemname'];
                $itemcode= $_POST['itemcode'];
                $urlid= $_POST['urlid'];
                $Quantity= $_POST['Quantity'];

                $this->conn->beginTransaction();
                // Check if the product amount is exist with respect to customers order quantity...
                $sqlQuery = $this->conn->prepare("
                    SELECT * FROM `lounchssdb`.`food_menu`
                    WHERE 
                        `generated_code` = ? 
                "); 
                $sqlQuery->execute([$itemcode]);
                $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultQ as $key => $value) {
                    // code...
                    $singlePrice = $value['price'];
                    $food_name = $value['food_name'];
                    $category = $value['category'];
                }

                $cartSum = $Quantity * $singlePrice;

                // return $cartSum;

                // Update Query for this items

                $sqlQuery = $this->conn->prepare("

                    UPDATE `lounchssdb`.`cart_items`
                        SET
                            `quantity` = ?,
                            `unit_price` = ?,
                            `total_price` = ?
                        WHERE
                            `cart_id` = ? AND 
                            `email` = ?
                ");

                $sqlQuery->execute([
                    $Quantity,
                    $singlePrice,
                    $cartSum,
                    $urlid,
                    $email
                ]);

                $this->conn->commit();
                return 'Success : Cart Quantity updated successfully.';
            }
        } catch (PDOException $e) {
            // Check if a transaction is still active before attempting to roll back
            if ($this->conn->inTransaction()) { 
                $this->conn->rollBack(); 
            }
                // Return the actual error message
                return "Error : " . $e->getMessage();
        }
    }

    // fetchItems
    public function fetchItems($params){

        try {
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM `lounchssdb`.`food_menu` 
                WHERE `generated_code` = ?

            ");
            $sqlQuery->execute([$params]);
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            return $resultQ ?: [];
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
        
      }

    // getActiveCartList
    public function getActiveCartList($params, $params2){
        // code...
        try {
            
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM `lounchssdb`.`cart_items`
                WHERE `status` = ? AND `email` = ? ORDER BY `cart_id`  DESC
            ");
            $sqlQuery->execute([$params, $params2]);
            $resultQ = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);

            // Return empty array if no users found
            return $resultQ ?: [];
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
    }

    // getActiveCarts
    public function getActiveCarts($params,$params2){

        try {
            $sqlQuery = $this->conn->prepare("
                SELECT * FROM `lounchssdb`.`cart_items` 
                WHERE `status` = ? AND `email` = ?
                ");
            $sqlQuery->execute([$params, $params2]);
        $CartQuantity = $sqlQuery->rowCount();
        return $CartQuantity;
        } catch (PDOException $e) {
            return "Error : " . $e->getMessage();
        }
        
    }




   // isUpdateSchoolInfo
   public function isUpdateSchoolInfo(){
      // code...
      if (isset($_POST['custInfo'])) {
         // code...
         $studentid = $_POST['studentid'];
         $fullname = $_POST['fullname'];
         $phone = $_POST['phone'];
         $yearlabel = $_POST['yearlabel'];
         $dormname = $_POST['dormname'];
         $Block = $_POST['Block'];
         $Floor = $_POST['Floor'];
         $Room = $_POST['Room'];
         $department = $_POST['department'];
         $file = $_FILES['files'];

         $filename = $file['name'];
         $fileerror = $file['error'];
         $filetmp = $file['tmp_name'];

         $fileext = explode('.', $filename);

         $filechecker = strtolower(end($fileext));
         $filestoretype =  array('jpeg','jpg','png','gif');

         if (!empty($_FILES['file'])) {
               // code...
            if (!in_array($filechecker, $filestoretype)) {
               // code...
               return "Error : Wrong file extensions.";
            }
         }  

         $destination = '../files/avatar/'.$filename;

         move_uploaded_file($filetmp, $destination);
         $date = date('Y-m-d');

         $sqlQuery = $this->conn->prepare("

            SELECT * FROM `lounchssdb`.`customers`
            WHERE `email` = ? 
         ");
         $sqlQuery->execute([$_SESSION['sessionID']]);
         $rowQ = $sqlQuery->rowCount();
         $email = $_SESSION['sessionID'];
         if ($rowQ > 0) {
            // Update Query
            $sqlQuery = $this->conn->prepare("
                UPDATE `lounchssdb`.`customers` 
                SET 
                    `student_id` = ?,
                    `full_name` = ?,
                    `department` = ?,
                    `year_level` = ?,
                    `dorm_name` = ?,
                    `dorm_block` = ?,
                    `dorm_floor` = ?,
                    `dorm_room` = ?,
                    `phone_number` = ?,
                    `profile_image` = ?
                WHERE 
                    `email` = ?
            ");


            $sqlQuery->execute([
                $studentid,
                $fullname,
                $department,
                $yearlabel,
                $dormname,
                $Block,
                $Floor,
                $Room,
                $phone,
                $filename,
                $email
            ]);


            return 'Success : Profile updated successfully.';
         }else{
            //  Insert Query
            $sqlQuery = $this->conn->prepare("
               INSERT INTO `customers`(`customer_id`, `student_id`, `full_name`, `department`, `year_level`, `dorm_name`, `dorm_block`, `dorm_floor`, `dorm_room`, `phone_number`, `email`, `profile_image`) 
               VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $sqlQuery->execute([
                $studentid,
                $fullname,
                $department,
                $yearlabel,
                $dormname,
                $Block,
                $Floor,
                $Room,
                $phone,
                $email,
                $filename
            ]);

            return 'Success : Profile added successfully.';
         }

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