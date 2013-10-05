<?php
$link = mysqli_connect("localhost","root","password","housing");

	$place = $_REQUEST['place'];
	$roomNumber = $_REQUEST['roomNumber'];
	$numPeople = $_REQUEST['numPeople'];
	$building = $_REQUEST['building'];
	
	$query = "SELECT * from ".$place." WHERE id = '".$roomNumber."'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if($row['occupied'] == 1) echo "occupied";

	else{
		$query = "UPDATE ".$place." SET occupied = 1 WHERE id = '".$roomNumber."'";
		$result = mysqli_query($link, $query);
			
		for($i = 1; $i <= $numPeople; $i++)
		{
			$id = $_REQUEST['id'.$i];
			$query1 = "UPDATE ".$place." SET room".$i." = '".$id."' WHERE id = '".$roomNumber."'";
			$result1 = mysqli_query($link, $query1);
			$query2 = "UPDATE students SET room = '".$roomNumber.$i."' WHERE id = '".$id."'";
			$result2 = mysqli_query($link, $query2);
			$query3 = "UPDATE students SET building = '".$building."' WHERE id = '".$id."'";
			$result3 = mysqli_query($link, $query3);

		}
	}
	

?>