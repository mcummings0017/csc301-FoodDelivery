<?php
if(!isset($_GET['id'])){
	die('No id: Please provide a valid id number!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
}

require_once('_JSONutility.php');
$filename='restaurants.json';
$id=$_GET['id'];
$restaurants=jsonToArray($filename);
$restaurant=$restaurants[$id];

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
	$restaurant["mealOptions"] = $meals;
	$data=$restaurant;
	modifyJSON($filename,$id,$data);

	//echo "Listing updated for ".$_POST["name"];
	die("Meals Added to: ".$restaurant["name"].'!  Go back to the <a href="adminIndex.php">Admin Home page</a>');
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
			<?php 
			if(!empty($restaurants[$_GET['id']]['mealOptions']{0})) {
				$firstmeal=$restaurants[$_GET['id']]['mealOptions']{0};
			} else {
				$firtmeal="";
			}
			?>
			<p><label for="name">Meal Name: </label>
			<input type="text" name="name[]" id="inputName" 
			<?php 
			if(!empty($firstmeal)) {
				echo 'value='.$firstmeal['mealName'];
			} else {
				echo 'placeholder="Enter Meal Name"';
			}
			?>
			>
			<label for="price">Price: </label>
			<input type="number" name="price[]" id="inputPrice" 				
			<?php 
				if(!empty($firstmeal)) {
					echo 'value='.$firstmeal['price'];
				} else {
					echo 'placeholder="Enter Price"';
				}
			?>
			>
			</p>
			</div>
		</div>
		<script>
			var meals_object=JSON.parse('<?php echo json_encode($restaurants[$_GET['id']]['mealOptions']); ?>');
			var body = $("body");
			if (Array.isArray(meals_object) && meals_object.length) {
				var i;
				for(i=1;i<meals_object.length;i++) {
					let str = '<div><p><label for="name">Meal Name: </label><input type="text" name ="name[]" ';
					str += 'value=' + '\"' + meals_object[i].mealName + '\"';
					str += '/><label for="price">Price: </label><input type="number" name ="price[]"';
					str += 'value=' + '\"' + meals_object[i].price + '\"' ;
					str += '/><a href="javascript:void(0);" class="removeMeal">Remove</a></p></div>';
					console.log(str);
					$(".wrapper").append(str);
				}
			}
		</script>
		<p><button class="addMeal">Add Meal</button></p>
		<input type="submit" value="Submit">
		</form>
		<script>
		$(document).ready(function() {
			var maxMeals = 10;
			var wrapper = $(".wrapper");
			var addButton = $(".addMeal");
			var meals = <?php echo getNumMeals(); ?>;
			

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
		
		$(document).on('click','.meal-content button.btn-danger',function(){
			$(this).parent().remove();
			
			
			
		});
		</script>
  </body>
</html>