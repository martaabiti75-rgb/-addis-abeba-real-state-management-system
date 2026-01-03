<?php 



 /**
  * File name Database Config file..
  * Developer : Zelalem Abreham
  * Mobile : 0920498295
  * Country : Ethiopia
  * Date July 10
  */

  // require __DIR__.'/ini.php';
  require __DIR__.'/ini2.php';

 /**
  * Code pattern OOP - Object Oriented Pattern / style
  * Class Name Database Class
  * Class Type Not extende other classes
  * Object Type : Both 
  */
 class BankDatabase{

 	// Declare Varibales to hold memory
 	private $serverHostBank = SERVERHOSTBANK;
 	private $serverUnameBank = SERVERUNAMEBANK;
 	private $serverPasswordBank = SERVERPASSWORDBANK;
 	private $serverDBBank = SERVERDBBANK;

 	public $connBank;
 	
 	public function __construct()
 	{
        
 		// code...
 		try {

 		    $this->connBank = new PDO("mysql:host=$this->serverHostBank;dbname=$this->serverDBBank",$this->serverUnameBank,$this->serverPasswordBank);
 		    $this->connBank->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 		    if ($this->connBank) {
 		    	// echo "connBankection Established";
 		    }else{
 		    	echo "Connection Not Established";
 		    }
 			
 		} catch (PDOException $e) {
 			echo "Error :" ."Connection not established.". $e->getMessage();
 		}
 	}
 }

 // Object Creation

 $object = new BankDatabase;
 // $object->BankDb();
?>