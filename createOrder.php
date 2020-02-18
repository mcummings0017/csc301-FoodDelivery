<?php
require_once('_JSONutility.php');
$filename="orders.json";
if(!empty($_POST["restaurant"]) 
	&& !empty($_POST["item"])
	&& !empty($_POST["email"])
    && !empty($_POST["shippingAddress"])
    && !empty($_POST["status"])) {
		$orders=jsonToArray($filename);
		$data=array(
			"restaurant"  => $_POST["restaurant"],
			"item" => $_POST["item"],
			"email" => $_POST["email"],
            "shippingAddress"  => $_POST["shippingAddress"],
			"status" => $_POST["status"],
		);
		array_push($restaurants, $data);
		writeAllJSON($filename,$restaurants);
        
		die("Order created for ".$_POST["name"].'!  Go back to the <a href="userindex.php">User Home</a>');
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
  <form action="createOrder.php" method="post">
  <p><label for="name">Restaurant: </label>
  <input type="text" name="Restaurant" id="inpuCategory">
  </p>
    <p><label for="category">Item: </label>
  <input type="text" name="order" id="inputCategory">
  </p>
  <p><label for="address">Email: </label>
  <input type="text" name="address" id="inputCategory">
  </p>
   <p><label for="name">Shipping Address: </label>
  <input type="text" name="shippingAddress" id="inputAddress">
  </p>
    <p><label for="Status">Item: </label>
  <input type="text" name="status" id="inputCategory">
  </p>
  <input type="submit" value="Submit">
  <input type="reset" value="Clear">      
   
  </form>
  
  </body>
 
</html>
