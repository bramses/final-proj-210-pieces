<?php
$con = mysqli_connect("localhost","root","password","housing");


for($i = 2; $i < 12; $i++)
{
	mysqli_query($con,"INSERT INTO valentine3 (id) values ({$i}30)");
	mysqli_query($con,"INSERT INTO valentine3 (id) values ({$i}40)");
	mysqli_query($con,"INSERT INTO valentine3 (id) values ({$i}70)");
	mysqli_query($con,"INSERT INTO valentine3 (id) values ({$i}80)");
}


?>