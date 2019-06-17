<?php
	require('php/db_connect.php');
  header ("Content-Type: text / html; charset = UTF-8");

  $id = $_GET["id"];

//count view
  $some_name = session_name("some_name");
  session_set_cookie_params(0, '/', 'spaceme.wd.nubip.edu.ua');
  session_start(); 
     
  if(isset($_SESSION['views'])) 
      $_SESSION['views'] = $_SESSION['views']+1; 
  else
      $_SESSION['views']=1; 
    // gets the user IP Address

  $user_ip=$_SERVER['REMOTE_ADDR'];

  $check_ip = mysqli_query($connection,"SELECT `userip` from `articleview` where article_id='$id' and userip='$user_ip'") or die(mysqli_error($connection));
  if(mysqli_num_rows($check_ip)>=1)
  {
  
  }
  else
  {
    $insertview = mysqli_query($connection,"INSERT INTO `articleview` values('','$id','$user_ip')") or die(mysqli_error($connection));
    $check_totalview = mysqli_query($connection,"SELECT * from `totalview` where article_id='$id' ") or die(mysqli_error($connection));
    if(mysqli_num_rows($check_totalview) < 1){
      mysqli_query($connection, "INSERT INTO `totalview` values('', '$id', '1')") or die(mysqli_error($connection));
    }else{
       $updateview = mysqli_query($connection,"UPDATE `totalview` set totalvisit = totalvisit+1 where article_id='$id' ") or die(mysqli_error($connection));
    }
  }
  $totalviews = mysqli_query($connection,"SELECT totalvisit from `totalview` where article_id='$id' ") or die(mysqli_error($connection));
  $totalviews = mysqli_fetch_row($totalviews);
        

//
	
	$query = "SELECT * FROM `materials` WHERE id = $id";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

  $query = "SELECT rating FROM `rating` WHERE id_article = $id";
  $score = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(!$result || !$score){
   echo "<script type='text/javascript'>alert('Помилка отримання даних для статті!')</script>";
		echo json_encode(false);
		exit;
	}
  $data = mysqli_fetch_row($result);

  $scoreData = mysqli_fetch_row($score);
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	  <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $data[1]; ?></title>
	<meta name="description" content="Пошук робочого простору">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../css/article.css">
    <link rel="stylesheet" href="../comments/css/styles.css">
	<?php include("includes/styles.html");?>	
	
</head>	
<body>
	<?php include("includes/header.html"); ?>


<div id="title-and-cards">
  <!-- ************** Title **************** -->
  <div class="container">
    <div class="title-bar">
      <h1><?php echo $data[1]; ?></h1>
      <div id="title-bar-info" class="offset-0 offset-sm-0 offset-md-2 col-md-8 offset-lg-2 col-lg-8">
        <table class="w-100 text-center">
          <tr>
            <th id="lastupdate" class=""><?php echo date('d.m.Y', strtotime($data[8])) ?></th>
            <th id="score" class="">
              <span id="star-1" class="fa fa-star <?php if($scoreData[0] >= 1){echo 'checked';}?>"></span>
              <span id="star-2" class="fa fa-star <?php if($scoreData[0] >= 1.5){echo 'checked';}?>"></span>
              <span id="star-3" class="fa fa-star <?php if($scoreData[0] >= 2.5){echo 'checked';}?>"></span>
              <span id="star-4" class="fa fa-star <?php if($scoreData[0] >= 3.5){echo 'checked';}?>"></span>
              <span id="star-5" class="fa fa-star <?php if($scoreData[0] >= 4.5){echo 'checked';}?>"></span>
              <span id="rating"><?php echo $scoreData[0]?></span>
            </th>
            
             <th id="views" class=""><i class="far fa-eye"></i><?php echo $totalviews[0]; ?></th>
          </tr>
        </table>
       
      </div>
    </div>
  </div>

<!-- ************** Info cards **************** -->
	<div class="container">
		<div class="card-deck">
      <div class="card">
         <div class="card-header">
          <h4>ЦІНИ</h4>
        </div>
        <div class="card-body">  
          <ul class="list-group list-group-flush">
            <?php
              $price_query = "SELECT * FROM `price` WHERE id_article = '$id'";
              $price_result = mysqli_query($connection, $price_query) or die(mysqli_error($connection));

              $price_count = mysqli_num_rows($price_result);
              if($price_count > 0){
                while ($price_data = mysqli_fetch_row($price_result)) {
                  $curr_price = $price_data[4] + 0;
                  echo " <li class='list-group-item'><span class='text-left'>$price_data[2] $price_data[3]</span><span class='text-right font-weight-bold'>від  $curr_price  $price_data[5]</span></li>";
                }
              }else{
                echo " <li class='list-group-item'><span>На жаль, даних про ціни немає</span>";
              }
            ?>
            <!--<li class="list-group-item"><span class="text-left">1 осб./1 год. Загальний простір</span><span class="text-right font-weight-bold">від 35 грн</span></li>
            <li class="list-group-item"><span class="text-left">1 осб./міс. Загальний простір</span><span class="text-right font-weight-bold">від 1230 грн</span></li>
            <li class="list-group-item"><span class="text-left">1 осб./1 год. Окремий офіс</span><span class="text-right font-weight-bold">від 70 грн</span></li>
            <li class="list-group-item"><span class="text-left">1 осб./міс. Окремий офіс</span><span class="text-right font-weight-bold">від 2230 грн</span></li>-->
          </ul>
          <p class="card-text pt-4 pl-3"><small class="text-muted">*Ціни можуть відрізнятися</small></p>
        </div>
      </div>
      <div class="card">
         <div class="card-header">
          <h4>КОНТАКТИ</h4>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <?php
              if(!$data[10] && !$data[11] && !$data[12] && !$data[13] && !$data[14] && !$data[15]){
                echo "<div class='list-group-item'>На жаль, контактних даних немає</div><div style='height: 120px;'></div>";
              }else{
                  if($data[10])
                    echo "<li class='list-group-item'><span class='text-left'>Сайт:</span><span class='text-right font-weight-bold'><a href='http://$data[10]' target='_blank'>$data[10]</a></span></li>";
                  if($data[11])
                    echo "<li class='list-group-item'><span class='text-left'>Номер:</span><span class='text-right font-weight-bold'>$data[11]</span></li>";
                  if($data[12])
                    echo "<li class='list-group-item'><span class='text-left'>Е-адреса:</span><span class='text-right font-weight-bold'>$data[12]</span></li>";
                  if($data[13])
                    echo "<li class='list-group-item'><span class='text-left'>Адреса:</span><span class='text-right font-weight-bold'>$data[13]";
                  if($data[14] && $data[15]){
                    echo "<br><a href='https://www.google.com.ua/maps/@$data[14] ,$data[15],18z?hl=ua' target='_blank' class='font-weight-normal'>на карті</a></span></li>";//href='http://spaceme.wd.nubip.edu.ua/map.html?lat=$data[14]&lng=$data[15]'
                  }else {
                      echo "</span></li>";
                  }
                }
              
            ?>
            <!--<li class="list-group-item"><span class="text-left">Сайт:</span><span class="text-right font-weight-bold">coworking.com</span></li>
            <li class="list-group-item"><span class="text-left">Номер:</span><span class="text-right font-weight-bold">+380 456 34 34</span></li>
            <li class="list-group-item"><span class="text-left">Е-адреса:</span><span class="text-right font-weight-bold">cowork@cow.com</span></li>
            <li class="list-group-item"><span class="text-left">Адреса:</span><span class="text-right font-weight-bold">м. Київ вул. Шота Руставелі 13/2, оф. 12 (2 пов)<br><a href="#" class="font-weight-normal">на карті</a></span></li>-->
          </ul>
        </div>
      </div>
      <!--<div class="card">
         <div class="card-header">
          <h4>ПЕРЕВАГИ</h4>
        </div>
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">It's a broader card with text below as a natural lead-in to extra content. This content is a little longer.This card has even longer content than the first to show that equal height action.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>-->
	</div>
</div>

<div class="artilce-body">
  <div class="container">
    <div id="short-discription">
      <p><?php echo $data[4];?></p>
    </div>
  </div>
<!--
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <div class="container offset-0 offset-sm-0 offset-md-2 offset-lg-2 col-md-8 col-lg-8">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/articles-photos/article-1/article-1-1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/articles-photos/article-1/article-1-2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/articles-photos/article-1/article-1-3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
</div>-->

  <div class="article-slider">
    <div class="container offset-0 offset-sm-0 offset-md-3 offset-lg-3 col-md-6 col-lg-6">
      <?php 

        $query2 = "SELECT * FROM `article_photo` WHERE id_article = '$id'";
        $result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));

        $count2 = mysqli_num_rows($result2);
        if($count2 > 0){
          echo "<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
              <ol class='carousel-indicators'>";
              echo "<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>";
              for($i = 1; $i < $count2-1; $i++){
                echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
              }
              echo "</ol>
              <div class='carousel-inner'>";
              $data2 = mysqli_fetch_row($result2);
                echo "<div class='carousel-item active'>
                  <img class='d-block w-100' src='$data2[2]' alt='$data2[0] slide'>
                </div>";
                while($data2 = mysqli_fetch_row($result2)){
                echo " <div class='carousel-item'>
                  <img class='d-block w-100' src='$data2[2]' alt='$data2[0] slide'>
                </div>";
                }
               echo "
              </div>
              <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
              </a>
              <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
              </a>
            </div>";
        }
      ?>
    </div>

  </div>

   <div class="container">
    <div id="full-discription">
      <p><?php echo $data[5];?></p>
    </div>
    <hr align="right" size="5" color="#4d5fea" />
  </div>

</div>


<div class="container">
  <div class="article-comments offset-0 offset-sm-0 offset-md-2 offset-lg-2 col-md-8 col-lg-8">

  <?php
      // Сообщение об ошибке:
      error_reporting(E_ALL^E_NOTICE);

      include ('comments/comment.class.php');          
      /* Выбираем все комментарии и наполняем массив $comments объектами */
      $comments = array();
      $result = mysqli_query($connection, "SELECT * FROM `comment` WHERE id_article='$id' ORDER BY id ASC") or die(mysqli_error($connection));
      while($row = mysqli_fetch_assoc($result))
      {
        $comments[] = new Comment($row);
      }           
      /* Вывод комментариев один за другим: */
      foreach($comments as $c){
        echo $c->markup();
      }
    ?>
    <div id="addCommentContainer">
      <form id="addCommentForm" method="post" action="/comments/submit.php">
          <div>      
                <label for="body">Додати коментар (Коментарні можуть додавати лише зареєстровані користувачі!)</label>
                <textarea name="body" id="body" cols="10" rows="1"></textarea>
                <input type="text" name="article_id" value="<?php echo $id; ?>" style="display: none;">        
                <input type="submit" id="submit" value="Додати" onClick="checkSubmit(<?php echo $_SESSION['id'];  ?>)"/>
                <script type="text/javascript">
                  function checkSubmit(curr_id){
                  if (!parseInt(curr_id)){
                      aletr("Коментар не додано! Незареєстровані користувачі не можуть залишати коментарі!");
                    }
                    
                    else if($('#body').val().trim().length < 1){
                      alert("Коментар не додано! Поле вводу коментаря пусте!");
                    }
                  }
                </script>
            </div>
        </form>
    </div>
  </div>
  </div>


	<?php include("includes/footer.html");?>
	<?php include("includes/scripts.html");?>
  <script src="js/articleStarsRating.js" type="text/javascript"></script>

</body>
</html>