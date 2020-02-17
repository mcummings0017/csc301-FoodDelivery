<?php
if (!isset($_GET['id'])){
	die('No id: Please provide a valid id number!  Go back to the <a href="index.php">Home page</a>');
}

require_once('_JSONutility.php');
$filename='restaurants.json';
$id=$_GET['id'];
$restaurants=jsonToArray($filename);
$restaurant=$restaurants[$id];
if(!empty($id) && $id>=0 && $id<count($restaurants)) {
	if(!empty($_POST["name"]) 
		&& !empty($_POST["category"])
		&& !empty($_POST["address"])) {
			$data=array(
				"name"  => $_POST["name"],
				"category" => $_POST["category"],
				"address" => $_POST["address"],
				"mealOptions" => $restaurant["mealOptions"]
			);
			modifyJSON($filename,$id,$data);
			
			//echo "Listing updated for ".$_POST["name"];
			die("Listing updated for ".$_POST["name"].'!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
	} else {
		echo "Please fill out all information below!";
	}
}

?>
<!doctype html>
<html lang="en">
  <head>
  <title>Edit Restaurant</title>
  </head>
  <body>	
		<form action="<?= 'editRestaurant.php?id='.$id ?>" method="post">
		  <p><label for="name">Name: </label>
		  <input type="text" name="name" id="inputName" value="<?= $restaurants[$id]['name'] ?>">
		  </p>
			<p><label for="category">Category: </label>
		  <input type="text" name="category" id="inputCategory" value="<?= $restaurants[$id]['category'] ?>">
		  </p>
		  <p><label for="address">Address: </label>
		  <input type="text" name="address" id="inputAddress" value="<?= $restaurants[$id]['address'] ?>">
		  </p>
		<input type="submit" value="Submit">
		<input type="reset" value="Clear">
		</form>
  </body>
</html>