<?php
$link = mysqli_connect("localhost","root","password","housing");

if (mysqli_connect_errno()) {
    echo("Connect failed:" . mysqli_connect_error());
    exit();
}

$place = $_REQUEST["place"];

$sql = ("SELECT * FROM ".$place." WHERE occupied = 0"); 

$result = mysqli_query($link, $sql);

echo "<select id = \"available\">";
echo "<option id=\"blank\" value=\"blank\">Please select a living space</option>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	echo "<option id=" . $row['id'] ." value=" . $row['id'] . ">" . $row['id'] . "</option>";
}

echo "</select>";

?>