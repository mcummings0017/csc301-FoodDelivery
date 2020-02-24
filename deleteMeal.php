<?php
require_once('_JSONutility.php');
$restaurants=jsonToArray('restaurants.json');
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
  <title>Delete Meal</title>
  </head>
  <body>
		<?php
			$meals=$restaurants[$_GET['id']]['mealOptions'];
			for($j=0;$j<count($meals);$j++) {
				echo '<p >Name: '.$meals[$j]['mealName'].' Price: '.$meals[$j]['price'].'</p>';
				echo '<a href="deleteMeal.php?id='.$_GET['id'].'">Delete Meal</a>';
			}
		?>
  </body>
</html>