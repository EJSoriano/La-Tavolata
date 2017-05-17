<header>

	<div class="logo">
		<h1><a href = "index.php"><img src="Images/logo1.png" alt="La TavolAta Restaurant Logo"/></a></h1>
	</div>
	<nav>
		<ul>
			<li><a href = "index.php" class="navButton">Home</a></li>
			<li><a href = "menu.php"  class="navButton">Menu</a></li>
			<li><a href = "contact.php"  class="navButton">Contact</a></li>
			<?php if (isset($_SESSION['UserID'])){
				echo "<li><a href = 'admin.php'  class='navButton'>Manage</a></li>";
			}			
			?>
			
		</ul>
	</nav>
	<div class="phone">
		<p>Phone (562) 924-8000</p>
		<?php if (isset($_SESSION['UserID'])): ?>
			<p><a href="logout.php" class="logBut">Logout</a></p>
		<?php else: ?>
			<p><a href="login.php" class="logBut">Login</a><p>
		<?php endif ?>
	</div>
</header>