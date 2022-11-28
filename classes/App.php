<?php

 class App{


  public function __construct(){
   
           session_start();

    }


 function clientpay($phone, $amount) {

        $data_array =  array("phone" => $phone, "amount"=>$amount);

        $data = json_encode($data_array);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_URL, 'http://193.46.198.61:9000/clientpay');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
   }    

   function addPayment($amount, $debtorid, $pid, $kam){


    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    mysqli_query($db,"INSERT INTO payments (debtor_id, amount, status, type, date, nextdate, kam, trans_id, transtype) VALUES ('$debtorid', '$amount', '0', '1', NOW(), NOW(), '$kam', '$pid', '2')");


    mysqli_query($db,"UPDATE debtors SET collected = (collected + '$amount') WHERE id = '$debtorid'");
}

function getappname() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT appname FROM config";
 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['appname'];
     }
   }	

   function getappcolor() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT appcolor FROM config";
 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['appcolor'];
     }
   }	

    function getself() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT index_php_self FROM config";
 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['index_php_self'];
     }
   }	
   
function saveCall($did, $kam, $callstatus, $numbercalled, $timestamp) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    $uname = $_SESSION ['firstname'];
    
    $sql = "INSERT INTO calls (kam, debtorid, callstatus, numbercalled, datetime, calldate) VALUES ('$kam', '$did', '$callstatus', '$numbercalled', '$timestamp', NOW())";
       
    mysqli_query($db,$sql);
      
   }  

     function getlogofile() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT logo FROM config";
 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['logo'];
     }
   }	

    function getemailclients() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM emails";
 	         $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	


    function countevents() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        $uid = $_SESSION ['id'];
        
         $sql = "SELECT * FROM events WHERE date(start_date) = CURDATE() AND kam_id = '$uid'";
             $result = mysqli_query($db,$sql);
            
        return mysqli_num_rows($result);
        
   }

       function getevents() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        $uid = $_SESSION ['id'];
        
         $sql = "SELECT title FROM events WHERE date(start_date) = CURDATE() AND kam_id = '$uid'";
         $result = mysqli_query($db,$sql);
            
        return $result;
        
   }

       function countptps() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
           
        $uname = $_SESSION ['firstname'];
        
        $sql = "SELECT ptp.*, debtors.name FROM ptp JOIN debtors ON ptp.debtorid = debtors.id WHERE ptp.kam = '$uname' AND ptp.status = '4'";
        $result = mysqli_query($db,$sql);
            
        return mysqli_num_rows($result);
        
   }

        function countbrokenptps() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
           
        $uname = $_SESSION ['firstname'];
        
        $sql = "SELECT ptp.*, debtors.name FROM ptp JOIN debtors ON ptp.debtorid = debtors.id WHERE ptp.kam = '$uname' AND ptp.status = '1'";
        $result = mysqli_query($db,$sql);
            
        return mysqli_num_rows($result);
        
   }

        function getbrokenptps() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
        $uname = $_SESSION ['firstname'];
        
        $sql = "SELECT ptp.*, debtors.name FROM ptp JOIN debtors ON ptp.debtorid = debtors.id WHERE ptp.kam = '$uname' AND ptp.status = '1'";

        $result = mysqli_query($db,$sql);
            
        return $result;
        
   }

        function getptps() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
        $uname = $_SESSION ['firstname'];
        
        $sql = "SELECT ptp.*, debtors.name FROM ptp JOIN debtors ON ptp.debtorid = debtors.id WHERE ptp.kam = '$uname' AND ptp.status = '4' AND date = CURDATE()";

        $result = mysqli_query($db,$sql);
            
        return $result;
        
   }

    function getdisputes($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM debtors WHERE status = 5 AND client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

 function getlegal($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM debtors WHERE status = 7 AND client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

function getsettled($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM debtors WHERE status = 16 AND client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

   function getactive($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM debtors WHERE status = 1 AND client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

   function getskiptrace($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM debtors WHERE status = 13 AND client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

   function getoutsourced($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT SUM(owing) AS owing FROM debtors WHERE client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
              	 while ($row = mysqli_fetch_array($result)) {

                 return  'K '. number_format ($row ['owing'], 2);
     }
   }	

   function getcollected($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT SUM(collected) AS collected FROM debtors WHERE client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
              	 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['collected'],2);
     }
   }	

     function getoutstanding($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT SUM(owing) AS owing, SUM(collected) AS collected FROM debtors WHERE client = $id";
 	     
 	     $result = mysqli_query($db,$sql);
 			
              	 while ($row = mysqli_fetch_array($result)) {

              	 	$outstanding = $row ['owing'] - $row ['collected']; 

                 return  'K ' . number_format($outstanding,2);
     }
   }	

function clientname($id) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT clientname FROM clients WHERE id = '$id'";
 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['clientname'];
     }
   }	

  function getusers() {

     $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT users.id AS uid, firstname, lastname, usergroups.role, email, username, password, userstatuses.status, active FROM users LEFT JOIN usergroups ON users.groupe = usergroups.id LEFT JOIN userstatuses ON users.active = userstatuses.id";
        $result = mysqli_query($db,$sql);
         return $result;
    
   }


  function getusersById() {

     $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT id, firstname, lastname FROM users WHERE (users.groupe = '1' OR users.groupe = '2' OR users.groupe = '3' OR users.groupe = '4' OR users.groupe = '5') AND active = '1'";
        $result = mysqli_query($db,$sql);
         return $result;
    
   }


   function getbookvalue() {

		 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT SUM(owing) AS owing FROM debtors";
 	     
 	     $result = mysqli_query($db,$sql);
 			
              	 while ($row = mysqli_fetch_array($result)) {

                 return  'K '. number_format ($row ['owing'], 2);
     }
   }	

      function getbookvalue_cam($id) {

         $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(owing) AS owing FROM debtors WHERE kam = '$id'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return  'K '. number_format ($row ['owing'], 2);
     }
   }    


function getbookcollected() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT SUM(amount) AS collected FROM payments WHERE status = '1'";
 	     
 	     $result = mysqli_query($db,$sql);
 			
              	 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['collected'],2);
     }
   }	

function getbookcollected_cam($firstname) {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(amount) AS collected FROM payments WHERE kam = '$firstname' AND status = '1'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['collected'],2);
     }
   }    


   function getTotalWriteOffs() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(write_off) AS write_off FROM debtors";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['write_off'],2);
     }
   }  

      function getTotalWriteOffs_cam($id) {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(write_off) AS write_off FROM debtors WHERE kam = '$id'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['write_off'],2);
     }
   }    

    function getTotalDispute() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(disputed) AS disputed FROM debtors";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['disputed'],2);
     }
   }  

       function getTotalUncontactable() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(owing) - (SUM(collected) - SUM(write_off) - SUM(disputed) - SUM(handed_back)) AS uncontactable FROM debtors WHERE status = '17'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['uncontactable'],2);
     }
   }  

       function getTotalLegal() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(owing) - (SUM(collected) - SUM(write_off) - SUM(disputed) - SUM(handed_back)) AS legal FROM debtors WHERE status = '7'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['legal'],2);
     }
   }  

       function getTotalDispute_cam($id) {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(disputed) AS disputed FROM debtors WHERE kam = '$id'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['disputed'],2);
     }
   }  

       function getTotalHandBack() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(handed_back) AS handed_back FROM debtors";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['handed_back'],2);
     }
   }  

          function getTotalHandBack_cam($id) {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(handed_back) AS handed_back FROM debtors WHERE kam = '$id'";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['handed_back'],2);
     }
   }  

          function getTotalptp() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(amount) AS ptp FROM ptp WHERE status IN ('1','4','5')";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['ptp'],2);
     }
   }  

          function getTotalptp_cam($firstname) {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(amount) AS ptp FROM ptp WHERE kam = '$firstname' AND status IN ('1','4','5')";
         
         $result = mysqli_query($db,$sql);
            
                 while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['ptp'],2);
     }
   }  


    function getbookdebtors() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM debtors";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

       function getbookdebtors_cam($id) {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT * FROM debtors WHERE kam = '$id'";
         
         $result = mysqli_query($db,$sql);
            
                return mysqli_num_rows($result);
   }    

    function getbookclients() {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM clients";
 	     
 	     $result = mysqli_query($db,$sql);
 			
                return mysqli_num_rows($result);
   }	

    function singleuser($uid) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT users.id AS uid, firstname, lastname, usergroups.id AS roleid, usergroups.role, email, username, password, userstatuses.status, userstatuses.id AS statusid, active FROM users LEFT JOIN usergroups ON users.groupe = usergroups.id LEFT JOIN userstatuses ON users.active = userstatuses.id WHERE users.id = '$uid'";
          $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row;
    
   }  

       function d_debtors($id) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT COUNT(*) AS d FROM debtors WHERE kam = '$id'";
         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['d'];
    
   }  

          function d_outsourced($id) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(owing) AS d FROM debtors WHERE kam = '$id'";
         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['d'];
    
   }  

        function d_collected($kamname) {

         $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
     
         $sql = "SELECT SUM(amount) AS collected FROM payments WHERE status = '1' AND kam = '$kamname'";
         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['collected'];
    
   }  

        function d_collected_today($kamname) {

         $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

          $today = date('y-m-d');
     
         $sql = "SELECT SUM(amount) AS collected FROM payments WHERE status = '1' AND kam = '$kamname' AND date = CURDATE()";


         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         //return $row['collected'];
         return 'K '. number_format($row['collected'],2);
    
   } 

   function d_ptp_today($kamname) {

         $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

          $today = date('y-m-d');
     
         $sql = "SELECT SUM(amount) AS ptp FROM ptp WHERE kam = '$kamname' AND date = CURDATE()";


         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         //return $row['collected'];
         return 'K '. number_format($row['ptp'],2);
    
   } 

    function d_calls_today($kamname) {

         $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

         $today = date('y-m-d');
        
     
         $sql = "SELECT COUNT(*) AS calls FROM comments WHERE kam = '$kamname' AND date = '$today'";

         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['calls'];
    
   }  

             function d_write_off($id) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(write_off) AS d FROM debtors WHERE kam = '$id'";
         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['d'];
    
   }  

             function d_disputed($id) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(disputed) AS d FROM debtors WHERE kam = '$id'";
         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['d'];
    
   }  

             function d_handback($id) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT SUM(handed_back) AS d FROM debtors WHERE kam = '$id'";
         $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row['d'];
    
   }  


    function edituser($uid, $firstname, $lastname, $role, $email, $username, $password, $status) {

      $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', groupe = '$role', email = '$email', username = '$username', password = '$password', active = '$status' WHERE id = '$uid'";
          $result = mysqli_query($db,$sql);
         $row = $result -> fetch_assoc();
         return $row;
    
   }  


        function getroletypes() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT * FROM usergroups";
          $result = mysqli_query($db,$sql);
         return $result;
   }    

       function userstatuses() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT * FROM userstatuses";
          $result = mysqli_query($db,$sql);
         return $result;
   }    

    function ptpstatuses() {

        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "SELECT * FROM ptpstatuses";
          $result = mysqli_query($db,$sql);
         return $result;
   }    


function  getrawbookvalue()
 {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT SUM(owing) AS owing FROM debtors";
 	     
 	     $result = mysqli_query($db,$sql);

 	      while ($row = mysqli_fetch_array($result)) {

                 return $row ['owing'];
     }
 			
              
   }	

function sumdisputes($id) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
     $sql = "SELECT SUM(collected) AS sum FROM debtors WHERE status = 5 AND client = $id";
       
       $result = mysqli_query($db,$sql);
      
                while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['sum'],2);
     }
   }  

   function sumlegal($id) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
     $sql = "SELECT SUM(collected) AS sum FROM debtors WHERE status = 7 AND client = $id";
       
       $result = mysqli_query($db,$sql);
      
                while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['sum'],2);
     }
   }  


function sumsettled($id) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
     $sql = "SELECT SUM(collected) FROM debtors WHERE status = 16 AND client = $id";
       
       $result = mysqli_query($db,$sql);
      
                while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['sum'],2);
     }
   }  
    function sumactive($id) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
     $sql = "SELECT SUM(collected) FROM debtors WHERE status = 1 AND client = $id";
       
       $result = mysqli_query($db,$sql);
      
                    while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['sum'],2);
     }
   }  

   function sumskiptrace($id) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
     $sql = "SELECT SUM(collected) FROM debtors WHERE status = 13 AND client = $id";
       
       $result = mysqli_query($db,$sql);
      
                    while ($row = mysqli_fetch_array($result)) {

                 return 'K '. number_format($row ['sum'],2);
     }
   }  

    function sendaction($icon, $id, $action) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
    $sql = "INSERT INTO tracker (iconid, uid, action, datetime) VALUES ($icon, $id, '$action', NOW())";
   

       
    mysqli_query($db,$sql);
      
   }  


    function add_user($firstname, $lastname, $role, $email, $username, $password, $status) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
    $sql = "INSERT INTO users (firstname, lastname, groupe, email, username, password, joined, active) VALUES ('$firstname', '$lastname', '$role', '$email', '$username', '$password', CURDATE(), '$status')";
   

       
    mysqli_query($db,$sql);

    return mysqli_error($db);
      
   }  

       function edit_user($uid, $firstname, $lastname, $role, $email, $username, $password, $status) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
    $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', groupe = '$role', email = '$email', username = '$username', password = '$password', active = '$status' WHERE id = '$uid'";
       
    mysqli_query($db,$sql);

    return mysqli_error($db);
      
   }  

     function edit_ptp($uname, $ptpid, $status, $debtorid) {

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
    $sql = "UPDATE ptp SET status = '$status', kam = '$uname' WHERE id = '$ptpid'";
   
    mysqli_query($db,$sql);

    return mysqli_error($db);
      
   }

       function deleteUser($id) {

         $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        
         $sql = "DELETE FROM users WHERE id = '$id'";
          mysqli_query($db,$sql);
         
   }   
}
?>