<?php
$link = mysqli_connect("localhost","root","password","housing");

	$numPeople = $_REQUEST['numPeople'];
	$correct = 1;
	
	for($i = 1; $i <= $numPeople; $i++)
	{
		$firstname = $_REQUEST['firstname'.$i];
		$lastname = $_REQUEST['lastname'.$i];
		$id = $_REQUEST['id'.$i];
		$query ="SELECT 1 FROM students WHERE firstname = '".$firstname."' AND lastname = '".$lastname."' AND id = '".$id."'";
		$result = mysqli_query($link, $query);
		if(!(mysqli_num_rows($result))){
			$correct = 0;		
      	}

	}
	
	echo $correct;	

?>