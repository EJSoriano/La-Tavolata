<?php
	include 'required.php';
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>La Tavolita</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href="reset.css">
		<link rel = "stylesheet" href="layout.css">
		<link rel = "stylesheet" href="index.css">
	</head>

	<body>
		<?php include 'header.php' ?>
		<main>
			<div class = "welcomeMain">
				<h1 class="welcomeHeading">Welcome!</h1>
				<?php
				if (isset($_GET['welcome'])) {
					echo '<p class="green-alert">Successfully logged in. Welcome admin!</p>';
				}
				if (isset($_GET['bye'])) {
					echo '<p class="yellow-alert">Successfully logged out. Good bye!</p>';
				}
				?>
				<div class="welcomeWrapper">
					<p class="welcomeContent">La Tavolata is a fresh pasta cafe located in Cerritos, CA. We serve authentic Italian pasta, antipasti, entrees, and desserts, as well as an excellent selection of beers and wines.</p>
					<img src="Images/restaurant.jpg" class="welcomeImg" alt="La Tavolata interior"/>
				</div>
			</div>
		</main>
		<?php include 'footer.php' ?>
	</body>
</html>
