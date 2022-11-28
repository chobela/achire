<?php

	class SMSPost {
		
		var $SenderAddress = "" ;		
		var $Destination = "" ;
		var $Message = "" ;
		var $User = "" ;
		var $Chars = "" ;
		var $Debtorid = "" ;
		var $objResult = "" ;
		
		
		function sendSMS() {
			
			$fields = array(
				'type' => 0, 
				'dlr' => 1,
				'destination' => '' . $this->Destination  . '', 
				'source' => ''. $this->SenderAddress .'',
				'message' => ''. $this->Message . '', 
				'user' => ''. $this->User . '', 
				'chars' => ''. $this->Chars . '',
				'debtorid' => ''. $this->Debtorid . '',
				'username' => 'chobela12', 
				'password' => 'theresa1'
			);			
			
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($fields),
				),
			);
			$context  = stream_context_create($options);
			$result = file_get_contents(base64_decode("aHR0cDovL2FwaS5ybWxjb25uZWN0Lm5ldC9idWxrc21zL2J1bGtzbXM="), false, $context);
			
			$this->objResult = $result ;			
			
			$this->saveMessage() ;
						
		}
		
		function saveMessage() {
					
			$postresult = explode("|", trim($this->objResult)) ;

			$status = $postresult[0];
			$number = $postresult[1];
			$smsid = $postresult[2];
            $message = $this->Message;
            $user = $this->User;
            $chars = $this->Chars;
            $debtorid = $this->Debtorid;


	
            $dbs = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                        
			$sql2 = "INSERT INTO sentmessages (number, message, chars, poststatus, smsid, user, debtorid, sent_on) VALUES ('$number', '$message', '$chars', '$status', '$smsid', '$user','$debtorid', NOW())";

            mysqli_query($dbs,$sql2);

                   
		}
		
		
	}




?>
