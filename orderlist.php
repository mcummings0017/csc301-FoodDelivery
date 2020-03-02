
<?php
require('_JSONutility.php');

function displayOrder($order, $ordernum){
	echo "<tr>";
	echo "<td>" . $order['restaurant'] . "</td>";
	echo "<td>" . $order['item'] . "</td>";
	echo "<td>" . $order['email'] . "</td>";
	echo "<td>" . $order['shippingAddress'] . "</td>";
	echo "<td>";
	echo "<label><input type='radio' name='radio" . $ordernum . "' ";
	if($order['status'] == "delivering") echo "checked";
	echo " value='delivering'>Delivering</label>";

	echo "<label><input type='radio' name='radio" . $ordernum . "' ";
	if($order['status'] == "delivered") echo "checked";
	echo " value='delivered'>Delivered</label>";
	echo "</td>";
	echo "</tr>";
}

function displayAll($ordersArray){
	echo "<table class='table'>";
	echo "<thead><tr>";
	echo "<th scope='col'>Restaurant</th>";
	echo "<th scope='col'>Item</th>";
	echo "<th scope='col'>Email</th>";
	echo "<th scope='col'>Shipping Address</th>";
	echo "<th scope='col'>Status</th>";
	echo "</tr></thead><tbody>";
	for($i = 0; $i < count($ordersArray); $i++){
		displayOrder($ordersArray[$i], $i);
	}

	echo "</tbody></table>";
}

if(isset($_POST['submit'])){
	$ordersArray = readJSON('orders.json');
	for($i = 0; $i < count($ordersArray); $i++){
		//the radio buttons names are written radio0, radio1,...etc
		//make the radio button index to access it from the
		//POST variable
		$r = 'radio' . $i . "";
		$status = $_POST[$r];
		if(isset($status)){
			echo $status;
			$ordersArray[$i]['status'] = $status;
		}else{
			echo "Delivery status unset, check status in orders.json";
		}
		echo "<br>";
	}
	writeAllJSON('orders.json', $ordersArray);
	die("Form submitted");
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Orders List</title>
  </head>
  <body>
	<?php
		$orders = readJSON('orders.json');
		echo "<form method='POST' name='form'>";
		displayAll($orders);
		echo "<button name='submit'>Submit</button>";
		echo "</form>";
	?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>