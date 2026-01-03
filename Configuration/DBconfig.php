 <?php 





require __DIR__.'/ini.php';
// require __DIR__.'/ini2.php';
require __DIR__.'/DBbank.php';

class Database extends BankDatabase {

    private $serverHost = SERVERHOST;
    private $serverUname = SERVERUNAME;
    private $serverPassword = SERVERPASSWORD;
    private $serverDB = SERVERDB;

    public $conn;

    public function __construct(){
        // ✅ Call the parent constructor to initialize $this->connBank
        parent::__construct();

        try {
            $this->conn = new PDO(
                "mysql:host=$this->serverHost;dbname=$this->serverDB",
                $this->serverUname,
                $this->serverPassword
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Error: Connection not established. " . $e->getMessage();
        }
    }

}


?>

