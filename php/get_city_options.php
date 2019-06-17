<?php
	require('db_connect.php');
	header ("Content-Type: text / html; charset = UTF-8");

	$query = "SELECT DISTINCT id, cityName FROM `city` ORDER BY cityName ASC";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(!$result){
		echo json_encode(false);
		exit;
	}
	
	while($data = mysqli_fetch_row($result))
{   
    echo "<li><a id='city' value='$data[0]'>$data[1]</a></li>";
}
	echo "<li><a id='city' value='0'>Вся Україна</a></li>";
?>