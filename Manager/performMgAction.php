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
 class isPerformMgAction extends Database{

      public function PropertyRequestApproval(){

     if (isset($_POST['PropertyRequestAppBtn'])) {
       // code...

        $HiddenRowValue = $_POST['HiddenRowValue'];
        $ApproveStateValue = $_POST['ApproveStateValue'];


        switch ($ApproveStateValue) {
          case 0:
            // code...
          $approvalState = 0;
          $sqlQuery = $this->conn->prepare("UPDATE `customers_request` SET `res_status` = '$approvalState' WHERE `req_id` = '$HiddenRowValue'");
          return $sqlQuery->execute() ? 'Success : Request pending successfully.' : 'Error : SQL Error Check the maria DB.';
            break;

          case 1:
            // code...
          $approvalState = 1;
          $sqlQuery = $this->conn->prepare("UPDATE `customers_request` SET `res_status` = '$approvalState' WHERE `req_id` = '$HiddenRowValue'");
          return $sqlQuery->execute() ? 'Success : Request approved successfully.' : 'Error : SQL Error Check the maria DB.';
            break;


          case 2:
            // code...
          $approvalState = 2;
          $sqlQuery = $this->conn->prepare("UPDATE `customers_request` SET `res_status` = '$approvalState' WHERE `req_id` = '$HiddenRowValue'");
          return $sqlQuery->execute() ? 'Success : Request rejected successfully.' : 'Error : SQL Error Check the maria DB.';
            break;
          
          default:
            // code...
            return "Error : Read time error";
            break;
        }
     }
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

   public function getMyProperty($params){

        $sqlQuery = $this->conn->prepare("SELECT * FROM `real_state_db`.`realestateregistration` WHERE `OwnerEmail` = '$params'  ");
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