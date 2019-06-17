<?php

require('db_connect.php');
  header ("Content-Type: text / html; charset = UTF-8");

//count view
  $some_name = session_name("some_name");
  session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');
  session_start(); 
  unset($_SESSION['id']);

$checkSum=$_GET['checkSum'];

$email=$_GET['email'];


echo "<!DOCTYPE html>
<html lang='en'>
<head>
      <!-- Basic Page Needs
  ================================================== -->
    <meta charset='utf-8'>
    <meta name='description' content='Пошук робочого простору'><body>";

$q=mysqli_query($connection, "SELECT id FROM `validate_temp` WHERE Email='".$email."'")  or die(mysqli_error($connection));

if(mysqli_num_rows($q)==0) {
   
    echo "<script type='text/javascript'>alert('На жаль, ви не зареєстровані! Помилка при перевірці даних!'); window.location.href='../index.html';</script>";
    die();
    }

$q=mysqli_query($connection, "SELECT id, Username, createDate FROM `user_login` WHERE Email='".$email."'");

$row=mysqli_fetch_array($q);

$login=$row['Username'];
$createDate=$row['createDate'];

$time=time();

$total_date=$time-$createDate;
$date=$time+$total_date;
$end_time=date("d:m",$time);
$date_stamp=explode(":",$end_time);

if($date_stamp[1]!=date("m",$date) || ($date_stamp[1]-date("m",$date))>4) {
    echo "<script type='text/javascript'>alert('На жаль, ви не зареєстровані! Простроченна дата активації ключа!' ); window.location.href='../index.html';</script>";
    die();
    }

$email_cnx=explode("@",$email);
$new_checkSum=base64_encode(substr($login,0,3).$email_cnx[0].md5($createDate));

if($checkSum!=$new_checkSum) {
   echo "<script type='text/javascript'>alert('На жаль, ви не зареєстровані! Помилка при перевірці ключа!'); window.location.href='../index.html';</script>";
   die();
    }
else {
    unset($q);
    $q=mysqli_query($connection, "UPDATE `user_login` SET Status='1'  WHERE Email='".$email."'") or die(mysqli_error($connection));
}

$q=mysqli_query($connection, "DELETE FROM `validate_temp` WHERE Email='".$email."'")or die(mysqli_error($connection));


mysqli_close($connection);
$_SESSION['id'] = $row['id'];
echo "<script type='text/javascript'>alert('Вітаю, ".$login."! Підтвердження реєстрації пройшло успішно!'); window.location.href='../index.html';</script>";

?>
