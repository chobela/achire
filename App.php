<?php


class App{
      public $dbHost     = "localhost";
    public $dbPassword = "3#Uo^UGt";
    public $dbUsername = "u839333499_achireuser";
    public $dbName = "u839333499_achiredb";
  
    public function __construct(){
        if(!isset($this->db)){
           
    $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }


        function login($username,$password) {

        $sql = "SELECT COUNT(*) AS user FROM users WHERE username = '$username' and password = '$password'";

        $result = $this->db->query($sql);

        $row = $result -> fetch_assoc();
   
        return $row['user'];
       
   }

       function sendaction($icon, $id, $action) {

  
    
    $sql = "INSERT INTO tracker (iconid, uid, action, datetime) VALUES ($icon, $id, '$action', NOW())";
   

       
       $this->db->query($sql);
      
   }  

        function getUser($username,$password) {

        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

        $result = $this->db->query($sql);

        $row = $result -> fetch_assoc();

        
        return $row;
       
   }  


    function getDebtorName($id) {

        $sql = "SELECT name FROM debtors WHERE id = '$id'";

        $result = $this->db->query($sql);

        $row = $result -> fetch_assoc();
        
        return $row['name'];
       
   } 

     function paymentType($type) {

        $sql = "SELECT type FROM paytypes WHERE id = '$type'";

        $result = $this->db->query($sql);

        $row = $result -> fetch_assoc();
        
        return $row['type'];
       
   } 

      function debtorComment($did) {

        $sql = "SELECT comment FROM comments WHERE did = '$did' ORDER BY id DESC LIMIT 1";

        $result = $this->db->query($sql);

        $row = $result -> fetch_assoc();

        if(!isset($row['comment']) || trim($row['comment']) === ''){

            return 'No Comment';

        } else {

            return $row['comment'];

        }
        
   } 



       function getCollections($start, $end) {

        $sql = "SELECT * FROM payments WHERE date >= '$start' AND date <= '$end'";

        $res = $this->db->query($sql);

        return $res;
        
   } 


}

?>