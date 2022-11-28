<?php

	class SMSPost {
		
		var $SenderAddress = "" ;		
		var $Destination = "" ;
		var $Message = "" ;
		var $User = "" ;
		var $Chars = "" ;
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

           
			/*
			
				Sample return string: 1701|260977785208|e02004bb-edc4-4312-a598-98378adb7743
				
				Status | Mobile number | Unique SMS ID */
	
          $myfile = fopen("newsms.txt", "w") or die("Unable to open file!");
$txt = $status . ', '. $number. ', ' $smsid. ', '. $message. ', '. $user. ', '. $chars. ', ';
fwrite($myfile, $txt);

fclose($myfile);

                   
		}
		
		
	}




?>
