<?php
class AdminUser {
    protected $mysqli;
    protected static $DB_HOST = "127.0.0.1";
    protected static $DB_USERNAME = "wp_eatery";
    protected static $DB_PASSWORD = "password";
    protected static $DB_DATABASE = "wp_eatery";

    private $username;
    private $password;
    private $dbError;
    private $authenticated = false;
    private $date;
    private $id;

    function __construct() {
        $this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USERNAME, 
                self::$DB_PASSWORD, self::$DB_DATABASE);
        if($this->mysqli->errno){
            $this->dbError = true;
        }else{
            $this->dbError = false;
        }
    }

    public function adminAuthenticate($username, $password){
        $loginQuery = "SELECT * FROM adminusers WHERE Username = ? AND password = ?";
        $stmt = $this->mysqli->prepare($loginQuery);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $this->username = $username;
            $this->password = $password;
            $this->authenticated = true;
        }
        $stmt->free_result();
    }

    public function updateLoginDate($date) {
        $this->date=$date;
        $loginQuery = 'UPDATE adminusers SET Lastlogin = ? WHERE AdminID = 1';
        $stmt = $this->mysqli->prepare($loginQuery);
        $stmt->bind_param('s', $date);
        $stmt->execute();
    }

   public function adminID($id){
       $this->id=$id;
       $loginQuery = "SELECT * FROM adminusers WHERE Username = 'admin' AND AdminID = ?";
       $stmt = $this->mysqli->prepare($loginQuery);
       $stmt->bind_param('i', $id);
       $stmt->execute();
    }

    public function isAuthenticated(){
        return $this->authenticated;
    }
    public function hasDbError(){
        return $this->dbError;
    }
    public function getUsername(){
        return $this->username;
    }

    public function getDate(){
        return $this->date;
    }

    public function getAdminID(){
        return $this->id;
    }

}