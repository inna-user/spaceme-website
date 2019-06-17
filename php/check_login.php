<?php

	require('db_connect.php');
	header ("Content-Type: text / html; charset = UTF-8");

	$some_name = session_name("some_name");
	 session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');
	 session_start();
  
  if(isset($_SESSION['id'])){
    echo $_SESSION['id'];
  } else{
   echo json_encode(false);
		exit;
  }
 
	/*$result = $_COOKIE['cookie_id_user'];
	$result = $result + "1" + $_SESSION["id"];
	
	echo "$result";
	if(!$result){
		echo json_encode(false);
		exit;
	}
	echo "$result";*/
?>