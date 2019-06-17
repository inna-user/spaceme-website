<?php
include 'db.php';
 $msg='';
 if(!empty($_GET['code']) && isset($_GET['code']))
 {
 $code=mysql_real_escape_string($_GET['code']);
 $c=mysqli_query($connection,"SELECT id FROM user_login WHERE Activation='$code'");
 if(mysqli_num_rows($c) > 0)
 {
 $count=mysqli_query($connection,"SELECT id FROM user_login WHERE activation='$code' and Status='0'");

 if(mysqli_num_rows($count) == 1)
 {
mysqli_query($connection,"UPDATE user_login SET Status='1' WHERE Activation='$code'");
 $msg="Ваш аккаунт активирован"; 
 }
 else
 {
 $msg ="Ваш аккаунт уже активирован, нет необходимости активировать его снова.";
 }
 }
 else
 {
 $msg ="Неверный код активации.";
 }
 }
?>
//HTML часть
<?php echo $msg; ?>