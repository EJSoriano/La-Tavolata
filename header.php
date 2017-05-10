<header>
	<div class="logo">
		<h1><a href = "index.php"><img src="Images/logo.png" alt="La Tavolita Restaurant Logo"/></a></h1>
	</div>
	<nav>
		<ul>
			<li><a href = "index.php">Home</a></li>
			<li><a href = "menu.php">Menu</a></li>
			<li><a href = "contact.php">Contact &#38; Location</a></li>
		</ul>
	</nav>
	<div class="phone">
		<p>Phone (###) ###-####</p>
		<?php if (isset($_SESSION['UserID'])): ?>
			<p><a href="logout.php">Logout</a></p>
		<?php else: ?>
			<a href="login.php">Login</a>
		<?php endif ?>
	</div>
</header>
