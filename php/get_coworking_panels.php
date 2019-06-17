<?php
	$arr = [
  'січ',
  'лют',
  'бер',
  'квіт',
  'трав',
  'черв',
  'лип',
  'серп',
  'вер',
  'жовт',
  'лист',
  'груд'
];

	require('db_connect.php');
	header ("Content-Type: text / html; charset = UTF-8");

	$cityName = $_GET['cityName'];
	if($cityName && $cityName != 0){
		$query = "SELECT id, title, city, short_dicription, banner_photo, data_lastupdate FROM `materials` WHERE id_city='$cityName' ORDER BY data_lastupdate";
	}else{
		$query = "SELECT id, title, city, short_dicription, banner_photo, data_lastupdate FROM `materials` ORDER BY city ASC";
	}
	
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(!$result){
		echo json_encode(false);
		exit;
	}

	
	while($data = mysqli_fetch_row($result))
{   
	$articleUrl = "article.php?id=$data[0]";
	$month = date('n')-1;
    echo "<div id='article-panel' class='mb-5'>
        <div class='card flex-md-row mb-4 h-md-250 shadow-sm bg-white'>
          <img class='centered-and-cropped flex-auto d-block' data-src='holder.js/200x250?theme=thumb' alt='office [200x250]' src='$data[4]' onclick='window.location=\"$articleUrl\";'>
          <div class='card-body d-flex flex-column align-items-start'>             
            <h3 class='articleca'>
              <a href='$articleUrl' <strong class=' mb-1 text-dark'>$data[1]</strong></a>
            </h3>            
            <div class='mb-1 text-muted text-info'>$data[2] | " .$arr[date(date('n', strtotime($data[5]))) - 1] . date(' d, Y', strtotime($data[5]))."</div>
            <p class='card-text mb-auto'> $data[3]</p>
            <a href='$articleUrl'>Продовжити читання</a>
          </div> 
        </div>     
      </div>";

}
	


?>