<?php
	require('db_connect.php');
	header ("Content-Type: text / html; charset = UTF-8");

	$id = $_GET['id'];
	$query = "SELECT * FROM `materials` WHERE id='$id'";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

	if(!$result){
		echo json_encode(false);
		exit;
	}
	$data = mysqli_fetch_row($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	  <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>ТЕСТ СТАТТЯ</title>
	<meta name="description" content="Пошук робочого простору">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php include("../includes/styles.html");?>	
	
</head>	
<body>
	<?php include("../includes/header.html"); ?>

	<div class="container">
		<div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a longer card It's a broader card with text below as a natural lead-in to extra content. This content is a little longer. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">It's a broader card with text below as a natural lead-in to extra content. This content is a little longer.This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>

	</div>


	<?php include("../includes/footer.html");?>
	<?php include("../includes/scripts.html")?>
</body>
</html>