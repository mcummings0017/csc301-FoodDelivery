<?php
require_once('_JSONutility.php');
$filename="restaurants.json";
if(!empty($_POST["name"]) 
	&& !empty($_POST["category"])
	&& !empty($_POST["address"])) {
		$restaurants=jsonToArray($filename);
		$data=array(
			"name"  => $_POST["name"],
			"category" => $_POST["category"],
			"address" => $_POST["address"],
			"mealOptions" => array()
		);
		array_push($restaurants, $data);
		writeAllJSON($filename,$restaurants);
		
		die("Restaurant created for ".$_POST["name"].'!  Go back to the <a href="adminIndex.php">Admin Home</a>');
} else {
	echo "Please fill out all information below!";
}

?>
<!doctype html>
<html lang="en">
  <head>
  <title>Create Restaurant</title>
  </head>
  <body>
  <form action="createRestaurant.php" method="post">
  <p><label for="name">Name: </label>
  <input type="text" name="name" id="inputName">
  </p>
    <p><label for="category">Category: </label>
  <input type="text" name="category" id="inputCategory">
  </p>
  <p><label for="address">Address: </label>
  <input type="text" name="address" id="inputAddress">
  </p>
  <input type="submit" value="Submit">
  <input type="reset" value="Clear">
  </form>
  
  
  
  </body>
 
</html>