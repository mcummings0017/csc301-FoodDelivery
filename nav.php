<!-- Image and text -->
<nav class="navbar navbar-expand navbar-light bg-danger text-white list-style-type-none">
  <a class="navbar-brand text-white" href="#">
    <img src="img/navimg.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
    Food Delivery
  </a>
	<div class="navbar-nav-scroll">
	  <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
		<li class="nav-item">
			<a class="nav-link" href="userindex.php" padding-right: 30px;>Home page</a>
		</li>
		<?php 
			if (isset($_SESSION)) {
				echo '<li class="nav-item">
						  <a class="nav-link" href="signout.php" padding-right: 30px;>Sign Out</a>
					  </li>';
			} else {
				echo '<li class="nav-item">
						  <a class="nav-link" href="signup.php" padding-right: 30px;>Sign Up</a>
					  </li>
					  <li class="nav-item">
						  <a class="nav-link" href="signin.php" padding-right: 30px;>Sign In</a>
					  </li>';
			}
		?>
	  </ul>
	</div>
</nav>