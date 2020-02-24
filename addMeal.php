<?php
if(!isset($_GET['id'])){
	die('No id: Please provide a valid id number!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
}

require_once('_JSONutility.php');
$filename='restaurants.json';
$id=$_GET['id'];
$restaurants=jsonToArray($filename);
$restaurant=$restaurants[$id];
// if(!empty($id) && $id>=0 && $id<count($restaurants)) {
	// if(!empty($_POST["name"]) 
		// && !empty($_POST["price"])) {
			// $meal=array(
				// "mealName"  => $_POST["name"],
				// "price"  => $_POST["price"]
			// );
			// array_push($restaurant["mealOptions"], $meal);
			// $data=$restaurant;
			// modifyJSON($filename,$id,$data);
			
			// //echo "Listing updated for ".$_POST["name"];
			// die("Meal Added to: ".$restaurant["name"].'!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
	// } else {
		// echo "Please fill out all information below!";
	// }
// }

$meals=array();

if(isset($_POST["name"]) && is_array($_POST["name"])
	&& isset($_POST["price"]) && is_array($_POST["price"])) {
		$names = array_values(array_filter($_POST["name"]));
		$prices = array_values(array_filter($_POST["price"]));
		for($i=0;$i<count($names);$i++) {
			$name=$names[$i];
			$price=$prices[$i];
			if(!empty($name)&&!empty($price)) {
				$meal=array(
				"mealName" => $name,
				"price" => $price
				);
				array_push($meals, $meal);
			}
		}
}

if(count($meals)>0) {
	if(count($restaurant["mealOptions"])<10) {
		foreach($meals as $item) {
			
			array_push($restaurant["mealOptions"], $item);
		}
		$data=$restaurant;
		modifyJSON($filename,$id,$data);

		//echo "Listing updated for ".$_POST["name"];
		die("Meal Added to: ".$restaurant["name"].'!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
	}
}

function getNumMeals() {
	require_once('_JSONutility.php');
	$filename='restaurants.json';
	$id=$_GET['id'];
	$restaurants=jsonToArray($filename);
	$restaurant=$restaurants[$id];
	return count($restaurant["mealOptions"]);
}

?>


<!doctype html>
<html lang="en">
  <head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
		</script>
		<script>
		$(document).ready(function() {
			var maxMeals = 10;
			var wrapper = $(".wrapper");
			var addButton = $(".addMeal");
			var meals = <?php echo getNumMeals(); ?> + 1;

			$(addButton).click(function(e) {
				e.preventDefault();
				if(meals<maxMeals) {
					meals++;
					$(wrapper).append('<div><p><label for="name">Meal Name: </label><input type="text" name ="name[]" placeholder="Enter Meal Name" /><label for="price">Price: </label><input type="number" name ="price[]" placeholder="Enter A Price" /><a href="javascript:void(0);" class="removeMeal">Remove</a></p></div>');
				}
			});
			
			$(wrapper).on("click",".removeMeal", function(e){ 
				e.preventDefault();
				$(this).parent('p').parent('div').remove();
				meals--;
			})
		});
		</script>
  <title>Add Meal</title>
  </head>
  <body>
		<form action="<?= 'addMeal.php?id='.$id ?>" method="post">
		<div class="container">
			<h1><?= $restaurants[$_GET['id']]['name'] ?></h1>
			<p><span class="badge badge-dark">Category:</span> <?= $restaurants[$_GET['id']]['category'] ?></p>
			<p><span class="badge badge-dark">Address:</span> <?= $restaurants[$_GET['id']]['address'] ?></p>
		</div>
		<div class="wrapper">
			<div>
			<p><label for="name">Meal Name: </label>
			<input type="text" name="name[]" id="inputName" placeholder="Enter Meal Name">
			<label for="price">Price: </label>
			<input type="number" name="price[]" id="inputPrice" placeholder="Enter A Price">
			</p>
			</div>
		</div>
		<p><button class="addMeal">Add Meal</button></p>
		<input type="submit" value="Submit">
		</form>
  </body>
</html>