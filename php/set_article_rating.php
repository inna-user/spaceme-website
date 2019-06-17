<?php

$article_id=$_GET['id'];
$starsCount=$_GET['starsCount'];

$votes_count = 0;
$rating = 1;

require('db_connect.php');

if($article_id && $starsCount){
	$query=mysqli_query($connection, "SELECT id, id_article, votes_count, rating FROM `rating` WHERE id_article='".$article_id."'")  or die(mysqli_error($connection));
	$count = mysqli_num_rows($query);
	if($count == 0){
		$query2 = mysqli_query($connection, "INSERT INTO `rating` (id_article, votes_count, rating) VALUES('$article_id', '0', '1')") or die(mysqli_error($connection));
	}else{
		$data = mysqli_fetch_row($query);
		$votes_count = $data[2];
		$rating = $data[3];
		
	}
	if($votes_count == 0){
		$new_rating = $starsCount;
	}else{
		$new_rating = ($rating * $votes_count)/($votes_count+1) + $starsCount/($votes_count+1);
	}
	$votes_count++;
	$query = mysqli_query($connection, "UPDATE `rating` SET votes_count='$votes_count', rating='$new_rating' WHERE id_article='$article_id'") or die(mysqli_error($connection));
	echo "<script type='text/javascript'>alert('Ваша оцінка встановлена');</script>";
	echo round($new_rating,2);

}else{
	echo "<script type='text/javascript'>alert('Помилка встановлення оцінки');</script>";
}


?>