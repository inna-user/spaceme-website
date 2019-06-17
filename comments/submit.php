<?php

// Сообщение об ошибке:
error_reporting(E_ALL^E_NOTICE);
require('../php/db_connect.php');
include ("comment.class.php");

/*
/	Данный массив будет наполняться либо данными,
/	которые передаются в скрипт,
/	либо сообщениями об ошибке.
/*/

$arr = array();
$validates = Comment::validate($arr);

$some_name = session_name("some_name");
	 session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');
	 session_start();
  
  if(!isset($_SESSION['id'])){
  	echo '{"status":0,"errors":'.json_encode($arr).'}';
  	goprewpage();
  	exit;
  }else{
  	$user_id = $_SESSION['id'];
  }

    $query = "SELECT * FROM `user_login` WHERE id=$user_id";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);
 	
	if($count == 1){
		$data = mysqli_fetch_row($result);
		$user_name = $data[1];
	}

	if(isset($_POST['article_id'])){
	$id_article = test_input($_POST['article_id']);
	}else {
		echo '{"status":0,"errors":'.json_encode($arr).'}';
		goprewpage();
  		exit;
	}

	if(isset($_POST['body'])){
	$body = $_POST['body'];
	}else {
		echo '{"status":0,"errors":'.json_encode($arr).'}';
		goprewpage();
  		exit;
	}


if($validates)
{
	/* Все в порядке, вставляем данные в базу: */
	
	
	mysqli_query($connection, "INSERT INTO comment(id_article,id_user,user_name,body)
					VALUES (
						'".$id_article."',
						'".$_SESSION['id']."',
						'".$user_name."',
						'".$body."'
					)")  or die(mysqli_error($connection));
	
	$arr['dt'] = date('r',time());
	$arr['id'] = mysqli_insert_id();
	
	/*
	/	Данные в $arr подготовлены для запроса mysql,
	/	но нам нужно делать вывод на экран, поэтому 
	/	готовим все элементы в массиве:
	/*/
	$arr['body'] = $body;
	$arr = array_map('stripslashes',$arr);
	
	$insertedComment = new Comment($arr);

	/* Вывод разметки только-что вставленного комментария: */

	json_encode(array('status'=>1,'html'=>$insertedComment->markup()));

	goprewpage();
}
else
{
	
	/* Вывод сообщений об ошибке */
	echo '{"status":0,"errors":'.json_encode($arr).'}';
	goprewpage();
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function goprewpage(){
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
}
?>