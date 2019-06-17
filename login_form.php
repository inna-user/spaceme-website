<?php

header ("Content-Type: text / html; charset = UTF-8");
  session_start();
 // echo "0 <br />";
  if(isset($_SESSION['wrong_username'])) { //if data is correct form send this data to the server to connect with database and insert it into 
  	echo "<script type='text/javascript'>window.onload = function(){ 
  		document.getElementById('wrong-username').style.display = 'block';
		document.getElementById('wrong-pass').style.display = 'block';
		document.getElementById('login-more-info').classList.remove('p-t-100');
		
		};
		</script>";
    //echo "1 <br />" ;
  } else if(isset($_SESSION['wrong_pass'])){
	//echo "2 <br />" ;
		echo "<script type='text/javascript'>window.onload = function(){ 
  			document.getElementById('wrong-pass').style.display = 'block';
  			document.getElementById('login-more-info').classList.remove('p-t-100');
		};
		</script>";
  }
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Spaceme</title>
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
			<div class="wrap-login100 p-t-5 p-b-20">
				<form class="login100-form validate-form" id="login-form" method="post" action="../../php/authen_login.php">
					<span class="login100-form-title p-b-50">
						Вітаємо
					</span>
					<!--<span class="login100-form-avatar">
						<img src="images/avatar-01.jpg" alt="AVATAR">
					</span>-->

					<div class="wrap-input100 validate-input m-t-55" id="valid_username" data-validate = "Введіть ім'я">
						<input class="input100" type="text" name="username" id="username" >
						<span class="focus-input100" data-placeholder="Ім'я користувача"></span>
					</div>
					<div  class="wrong-vals">
						<span id="wrong-username">Неправильно введене ім'я</span>
					</div>

					<div class="wrap-input100 validate-input m-t-35" id="valid_pass" data-validate="Введіть пароль">
						<input class="input100" type="password" name="user_pass" id="user_pass" >
						<span class="focus-input100" data-placeholder="Пароль"></span>
					</div>
					<div  class="wrong-vals">
						<span id="wrong-pass">Неправильно введений пароль</span>
					</div>

					<div class="container-login100-form-btn m-t-50 ">
						<input type="submit" name="login" value="Увійти" class="login100-form-btn">	
					</div>

					<ul class="login-more p-t-100 p-t-40" id="login-more-info">
						<!--<li class="m-b-8">
							<span class="txt1">
								Забули
							</span>
							<a href="#" class="txt2">Ім'я користувача / Пароль?</a>
						</li>-->

						<li>
							<span class="txt1">
								Не маєте облікового запису?
							</span>
							<a href="signup_form.php" class="txt2">Зареєструватися</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
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

</body>
</html>