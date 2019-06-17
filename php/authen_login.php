<?php
$some_name = session_name("some_name");
session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');
session_start();
unset($_SESSION['id']);
require('db_connect.php');
header ("Content-Type: text / html; charset = UTF-8");

if(isset($_POST['username']) and isset($_POST['user_pass'])){
	//Assigning POST values to variables
	$username = test_input($_POST['username']);
	$user_pass = test_input($_POST['user_pass']);

	//check for the record from table
	$query = "SELECT * FROM `user_login` WHERE Username='$username' and Password='$user_pass'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);

	echo "<!DOCTYPE html><html lang='en'> <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head><body>";
 	
	if($count == 1){

		$data = mysqli_fetch_row($result);
		$_SESSION['id'] = $data[0]; //если юзер авторизирован, присвоим переменной $UID его id
		$UID = $_SESSION['id'];
		//setcookie('cookie_id_user', '5',  time()+31557600, '/', 'spaceme.wd.nubip.edu.ua');
		//echo "<script type='text/javascript'>alert($UID)</script>";
		
		$admin = is_admin($UID, $connection); //определяем, админ ли юзер
		
		if($admin){
			$_SESSION['admin'] = true;
		}

		//echo "Login Credentials verified"
	
		/*echo "<script type='text/javascript'>alert('Вхід підтверджено')</script>";
		echo "<p>Це ваш особистий кабінет</p><br>";
		if($admin){
			echo "<p>Ви адміністратор</p><br>";
			echo "<a href='../index.html'>Перейти на сторінку адміністрування</a>";
		}
		echo "<a href='../index.html'>Перейти на головну сторінку</a>";*/
		
		echo "<script type='text/javascript'>window.location.href='../index.html';</script>";
		unset($_SESSION['wrong_username']);
		unset($_SESSION['wrong_pass']);

		
	}else{
		
		
		echo "<script type='text/javascript'>alert('Помилка входу. Введено невірний логін або пароль користувачa');</script>";
		
		//header('Location: ../Login/Login/login.php'); 
		//echo "Invalid Login Credentials";

		$username_query ="SELECT Username FROM `user_login` WHERE Username='$username'";
		$username_result = mysqli_query($connection, $username_query) or die(mysqli_error($connection));
		$username_count = mysqli_num_rows($username_result);
		if($username_count == 1){
			unset($_SESSION['wrong_username']);
			$_SESSION['wrong_pass'] = "wrong";
		}else{
			$_SESSION['wrong_username'] = "wrong";
			$_SESSION['wrong_pass'] = "wrong";
		}

		echo "<script>history.go(-1);</script>";

	}
	echo "</body></html>";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function is_admin($uid, $con) { 	
	$admin_query ="SELECT rights FROM `user_login` WHERE id='$uid' AND rights='1'";
		$admin_result = mysqli_query($con, $admin_query) or die(mysqli_error($con));
		$admin_count = mysqli_num_rows($admin_result);
	//$rez = mysqli_query($connection, "SELECT rights FROM `user_login` WHERE id='$id' AND rights='1'") or die(mysqli_error($connection));

	if ($admin_count == 1) 	
	{ 		
		return true; 		
	}else {
		return false;	 
	}
}
function check_login()
{
	$result = $_COOKIE['cookie_id_user'];
	
	echo "<p>$result</p>";
	if(!$result){
		echo json_encode(false);
		exit;
	}
	echo "$result";
}

?>
