<?php
if (!isset($_GET['id'])){
	die('No id: Please provide a valid id number!  Go back to the <a href="index.php">Home page</a>');
}

require_once('_JSONutility.php');
$filename='restaurants.json';
if(!empty($_POST["id"])) {
	deleteJSON($filename,$_POST["id"]);
	echo "Listing ".$_POST["name"]." was deleted!";
	echo "<br />";
	die('Listing Deleted!  Go back to the <a href="adminIndex.php">Admin Home Page</a>');
}
$id=$_GET['id'];
$restaurants=jsonToArray($filename);

if(!is_numeric($_GET['id']) || $_GET['id']<0 || $_GET['id']>=count($restaurants)){
	die('Invalid: go back to the <a href="index.php">Home page</a>');
	
}
?>

<!doctype html>
<html lang="en">
  <head>
  <title>Delete Listing</title>
  </head>
  <body>
		
		<form action="<?= 'deleteRestaurant.php?id='.$id ?>" method="post">
		<p><h1 for="name">Are you sure you want to delete the Restaurant? </h1> </p>
		<input type="hidden" name="id" value="<?= $id ?>">
		<input type="hidden" name="name" value="<?= $restaurants[$_GET['id']]['name'] ?>">
		<div class="container">
			<h1><?= $restaurants[$_GET['id']]['name'] ?></h1>
			<p><span class="badge badge-dark">Category:</span> <?= $restaurants[$_GET['id']]['category'] ?></p>
			<p><span class="badge badge-dark">Address:</span> <?= $restaurants[$_GET['id']]['address'] ?></p>
		</div>
		<input type="submit" value="Delete">
		</form>
  </body>
</html>