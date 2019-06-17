<?php
	$some_name = session_name("some_name");
	 session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');
	 session_start();

if(isset($_SESSION['id'])){
		unset($_SESSION['id']);
		session_destroy();
		echo  "Ви успішно вийшли ";
	}else{
		echo "Ви не заходили";
	}
	/*if(isset($_COOKIE['cookie_id_user'])){
		unset($_COOKIE['cookie_id_user']);
		setcookie('cookie_id_user', '', time() - 3600, '/', 'spaceme.wd.nubip.edu.ua');
		echo  "Ви успішно вийшли";
	}else{
		echo "Ви не заходили";
	}*/
?>