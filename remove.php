<?php
	$link = mysqli_connect("localhost","root","password","housing");

	$numPeople = $_REQUEST['numPeople'];
	$place = $_REQUEST['place'];
	$roomNumber = $_REQUEST['roomNumber'];
	
	for($i = 1; $i <= $numPeople; $i++)
	{
		$id = $_REQUEST['id'.$i];
		$sql = "UPDATE students SET room = NULL, building = NULL WHERE id = '".$id."'";
		$result = mysqli_query($link, $sql);
		$sql = "UPDATE $place SET room$i = NULL, occupied = 0 WHERE id = '".$roomNumber."'";
		$result = mysqli_query($link, $sql);
		
		$query ="SELECT * FROM students WHERE id = $id";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		
		$dest_addr = $row['email'];
		$body = "Hi ".$row['firstname'].", your rooming assignment has been removed by one of your roommates." ;
		$subject = "University of Rochester housing assignment removal";
		$from_addr = "mgord12@u.rochester.edu";
		$url = 'http://sendgrid.com/';
		$user = 'mgordon';
		$pass = 'welcome1'; 
				
		$params = array(
	    'api_user'  => $user,
	    'api_key'   => $pass,
	    'to'        => $dest_addr,
	    'subject'   => $subject,
	    'html'      => $body,
	    //'text'      => 'testing body',
	    'from'      => $from_addr,
	  );
	
		$request =  $url.'api/mail.send.json';
		
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		
		// obtain response
		$response = curl_exec($session);
		
		//If the result is {"message":"success"}, then the mail is sent.  
		curl_close($session);
	}
	
	echo "You have been successfully removed from your housing assignment.";
	
		

?>