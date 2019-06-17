<?php
  require('php/db_connect.php');

  //set validation error flag as false
    $error = false;

    //check if form is submitted
  if(isset($_POST['signup']) and isset($_POST['new_username']) and isset($_POST['new_pass']) and isset($_POST['new_pass_confirm']) and isset($_POST['new_email'])){
	//Assigning POST values to variables
	$username = mysqli_real_escape_string($connection, $_POST['new_username']);
	$user_pass = mysqli_real_escape_string($connection, $_POST['new_pass']);
	$user_pass_confirm = mysqli_real_escape_string($connection, $_POST['new_pass_confirm']);
	$user_email =  mysqli_real_escape_string($connection, $_POST['new_email']);

	//check for the record from table
	$query = "SELECT Username FROM `user_login` WHERE Username='$username'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$namesCount = mysqli_num_rows($result);

	$query = "SELECT Email FROM `user_login` WHERE Email='$user_email'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$emailsCount = mysqli_num_rows($result);
	 
	//count < 1 means there isn't users with such name in DB
	if($namesCount < 1 && $emailsCount < 1){
		echo "<script type='text/javascript'>alert('На вашу електронну адресу відправленно повідомлення. Для підтвердження реєстрації перейдіть за посиланням в листі')</script>";

		//add confirm row
		$time=time();
		$confirm = mysqli_query($connection,"INSERT INTO `user_login` (Username,Password, Email, Status, createDate)VALUES('$username','$user_pass','$user_email', '0', '$time')"); 
		             
		if($confirm){
			//send email

						/**

			*Начинаем процесс составления ХЕШ-подписи, для подтверждения личности 
			*пользователя при активации

			**/

			//Получаем логин пользователя в EMAIL-сети

			$email_cnx=explode("@",$user_email);

			//Формируем подпись 
			$checkSum=base64_encode(substr($username,0,3).$email_cnx[0].md5($time));// encrypted username+email+timestamp

			//Получаем временную метку

			$base_url='http://spaceme.wd.nubip.edu.ua/php/';
			
			unset($q);

			//Добавляем данные во временную таблицу

			$q=mysqli_query($connection, "INSERT into `validate_temp` VALUES('','".$user_email."','".
			                 $checkSum."','".$time."')") or die(mysqli_error($connection));


			//Сообщение зарегистрированному пользователю

			$message="<p>Сьогодні о ".date("d.m.Y",$date)." на сайті SpaceMe.wd.nubip.edu.ua був зараєстрований користувач з вашим email'ом. Тому ви отримали даний лист. 
			Якщо ви не реєструвались на нашому сайті, то видаліть даний лист, а якщо це були ви, то перейдіть по нижчевказаному посиланні.</p>

			<p>Акаунт буде діяти до
			".date("d.m.Y",mktime(0,0,0,date("d",$date)+4,date("m",$date),date("Y",$date))).", 
			після чого зареєструвати акаунт буде неможливо!</p>

			<p>Посиланн для активації: <a
			href=\"".$base_url."register_activate.php?checkSum=".$checkSum."&email=".$user_email."\">" .$base_url. "register_activate.php?checkSum=".$checkSum."&email=".$user_email."</a>;</p>
			<hr>

			З повагою адміністрація SpaceMe.wd.nubip.edu.ua";

			//Посылаем сообщение пользователю

			mail($user_email,"Spaceme підтвердження реєстрації",$message,"Content-Type: text/html; 
			charset=utf-8","From: donotreplyrobot@spaceme.com");

			mysqli_close();



			/*include 'send_mail.php';
			 $base_url='http://inna.wd.nubip.edu.ua/php/';
			 $to=$user_email;
			 $subject="Подтверждение электронной почты";
			 $body='Здравствуйте! <br/> <br/> Мы должны убедиться в том, что вы человек. Пожалуйста, подтвердите адрес вашей электронной почты, и можете начать использовать ваш аккаунт на сайте. <br/> <br/> <a href="'.$base_url.'activation/'.$activation.'">'.$base_url.'activation/'.$activation.'</a>';



			echo "<script type='text/javascript'>alert('На вашу електронну адресу відправленно повідомлення. Для підтвердження реєстрації перейдіть по силці в листі')</script>";
			   //let's send the email
				//$confirmcode = rand();
				$message = "Натисни на посилання для підтвепдження реєстрації
				http://spaceme.wd.nubip.edu.ua/php/emailconfirm.php?username=$username&codee=$activation";
				mail($user_email, "Spaceme підтвердження реєстрації", "Form:Donotreply@gmail.com");*/

				/*echo "Rgistration complete ";*/
		 
		}else{		                 
		    echo "<script type='text/javascript'>alert('Помилка підтвердження внесення нових даних до БД')</script>";                 
		}

	}else{
		$error = true;
		if($namesCount > 1){
			 $username_error = "Нажаль ім'я " . $username . " вже використовується!";
			 echo '<style type="text/css">#wrong-new-username {display: block;}</style>';
		}else{
			 $email_error = "Нажаль email " . $user_email . " вже використовується!";
			 echo '<style type="text/css">#wrong-new-email {display: block;}</style>';
		}
       
		
	}
}




  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendors/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendors/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendors/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendors/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendors/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendors/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/login_signup_css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login_signup_css/main.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!--===============================================================================================-->
</head>
<body>
	<div class="cancel">
		<div class="return-home" style="text-align: left;">
			<a href="../index.html">         
            	<p style="left: 0"><i class="fas fa-arrow-left"></i>SpaceMe</p>
            	
        	</a>
		</div>		
		<div class="return-home" style="text-align: right;">
			<a href="../index.html">         
            	<p><i class="fas fa-times"></i></p>
        	</a>
		</div>		
	</div>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-5 p-b-10">
				<form class="login100-form validate-form" id="signup-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<span class="login100-form-title p-b-10">
						Вітаємо
					</span>
					<!--<span class="login100-form-avatar">
						<img src="images/avatar-01.jpg" alt="AVATAR">
					</span>-->

					<div class="wrap-input100 validate-input m-t-45 " data-validate = "Введіть ім'я">
						<input class="input100" type="text" name="new_username" id="new_username" required value="<?php if($error) echo $username; ?>">
						<span class="focus-input100" data-placeholder="Ім'я користувача"></span>
					</div>
					<div  class="wrong-vals">
						<span id="wrong-new-username"><?php if (isset($username_error)) echo $username_error; ?></span>
					</div>

					<div class="wrap-input100 validate-input m-t-35" data-validate="Введіть пароль">
						<input class="input100" type="password" name="new_pass" required>
						<span class="focus-input100" data-placeholder="Пароль"></span>
					</div>
					<div  class="wrong-vals">
						<span id="wrong-new-pass">Неправильний формат</span>
					</div>

					<div class="wrap-input100 validate-input m-t-35" data-validate="Введіть пароль">
						<input class="input100" type="password" name="new_pass_confirm" required>
						<span class="focus-input100" data-placeholder="Повторіть пароль"></span>
					</div>
					<div  class="wrong-vals">
						<span id="wrong-new-pass-confirm">Паролі не співпадають</span>
					</div>

					<div class="wrap-input100 validate-input m-t-35" id="valid_email" data-validate="Введіть електрону адресу">
						<input class="input100" type="email" name="new_email" id="new_email" required value="<?php if($error) echo $user_email; ?>">
						<span class="focus-input100" data-placeholder="Електрона адреса"></span>
					</div>
					<div  class="wrong-vals">
						<span id="wrong-new-email"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="container-login100-form-btn m-t-50 ">
						<input type="submit" name="signup" value="Зареєструватися" class="login100-form-btn">
						</input>
					</div>

					<ul class="login-more p-t-30">

						<li>
							<span class="txt1">
								Вже маєте обліковий запис?
							</span>

							<a href="login_form.php" class="txt2">
								Увійти
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	



	
<!--===============================================================================================-->
	<script src="vendors/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendors/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendors/bootstrap/js/popper.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendors/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendors/daterangepicker/moment.min.js"></script>
	<script src="vendors/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendors/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/login_signup_main.js"></script>
	<script src="js/main_signup.js"></script>

</body>
</html>