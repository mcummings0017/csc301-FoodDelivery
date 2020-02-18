<!doctype html>
<html lang="en">
<?php
require_once('_JSONutility.php');
$restaurants=jsonToArray('restaurants.json');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>User Home</title>
  </head>
  <body>
   <div class="container">
   <a href="createOrder.php" padding-right: 30px;>Make Your Order!</a><br></br>
   </div>
   <div class="container">
		<h1>All Restaurants</h1>
		<?php
		echo '<ul class="list-group list-group-flush"';
		echo '<div class="container">';
		for($i=0;$i<count($restaurants);$i++){
			echo '<div class="col-4 border border-dark bg-secondary text-white">
					  <div class="media-body">
						<h5 class="mt-0">'.$restaurants[$i]['name'].'</h5>
						<p >Category: '.$restaurants[$i]['category'].'</p>
						<p >Address: '.$restaurants[$i]['address'].'</p>
						<p >Meal Options:</p>';
						$meals=$restaurants[$i]['mealOptions'];
						for($j=0;$j<count($meals);$j++) {
							echo '<p >Name: '.$meals[$j]['mealName'].'</p>
							<p >Price: '.$meals[$j]['price'].'</p>';
						}
						echo '
					  </div>
					</div>';
		}
		echo '</div>';
		echo '</ul>';

		?>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>