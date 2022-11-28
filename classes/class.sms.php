<?php

	class SMSPost {
		
		var $SenderAddress = "" ;		
		var $Destination = "" ;
		var $Message = "" ;
		var $UserId = "" ;
		var $PromoId = "" ;
		var $objResult = "" ;
		
		
		function sendSMS() {
			
			$fields = array(
				'type' => 0, 
				'dlr' => 1,
				'destination' => '' . $this->Destination  . '', 
				'source' => ''. $this->SenderAddress .'',
				'message' => ''. $this->Message . '', 
				'userid' => ''. $this->UserId . '', 
				'promoid' => ''. $this->PromoId . '',
				'username' => 'chobela12', 
				'password' => 'xxx'
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
            $userid = $this->UserId;
            $promoid = $this->PromoId;

           
			/*
			
				Sample return string: 1701|260977785208|e02004bb-edc4-4312-a598-98378adb7743
				
				Status | Mobile number | Unique SMS ID */
			
			

                        $dbs = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORDD,DB_DATABASEE);
                        
			$sql2 = "INSERT INTO sentmessages (number, message, poststatus, smsid, promoid, userid, sent_on) VALUES ('$number', '$message', '$status', '$smsid', '$promoid', '$userid', NOW())";

                        mysqli_query($dbs,$sql2);

                   
		}
		
		
	}




?>
