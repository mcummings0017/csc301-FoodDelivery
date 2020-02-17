<?php
if(!isset($_GET['id'])){
	die('No id: Please provide a valid id number!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
}

require_once('_JSONutility.php');
$filename='restaurants.json';
$id=$_GET['id'];
$restaurants=jsonToArray($filename);
$restaurant=$restaurants[$id];
if(!empty($id) && $id>=0 && $id<count($restaurants)) {
	if(!empty($_POST["name"]) 
		&& !empty($_POST["price"])) {
			$meal=array(
				"mealName"  => $_POST["name"],
				"price"  => $_POST["price"]
			);
			array_push($restaurant["mealOptions"], $meal);
			$data=$restaurant;
			modifyJSON($filename,$id,$data);
			
			//echo "Listing updated for ".$_POST["name"];
			die("Meal Added to: ".$restaurant["name"].'!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
	} else {
		echo "Please fill out all information below!";
	}
}

?>
<!doctype html>
<html lang="en">
  <head>
  <title>Add Meal</title>
  </head>
  <body>	
		<form action="<?= 'addMeal.php?id='.$id ?>" method="post">
		<div class="container">
			<h1><?= $restaurants[$_GET['id']]['name'] ?></h1>
			<p><span class="badge badge-dark">Category:</span> <?= $restaurants[$_GET['id']]['category'] ?></p>
			<p><span class="badge badge-dark">Address:</span> <?= $restaurants[$_GET['id']]['address'] ?></p>
		</div>
		<p><label for="name">Meal Name: </label>
		<input type="text" name="name" id="inputName">
		</p>
	    <p><label for="price">Price: </label>
	    <input type="number" name="price" id="inputPrice">
	    </p>
		<input type="submit" value="Submit">
		<input type="reset" value="Clear">
		</form>
  </body>
</html>