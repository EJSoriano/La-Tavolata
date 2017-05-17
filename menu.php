#!/usr/local/php5/bin/php-cgi

<?php 

require_once('required.php');
if(isset($_GET["category"])){
	$categoryTitle = $_GET["category"];
	$sql = "SELECT * FROM menu_categories where name = '" . $categoryTitle . "';";
	$result = mysqli_query($connection, $sql);
	if ($result = mysqli_query($connection,$sql)){
		while ($row=mysqli_fetch_assoc($result)){
			$catID = $row["id"];
		}
		mysqli_free_result($result);
	}
} else {
	$sql = "SELECT * FROM menu_categories;";
	$result = mysqli_query($connection, $sql);
	if ($result = mysqli_query($connection,$sql)){
		if ($row=mysqli_fetch_assoc($result)){
			header('Location:menu.php?category='. $row["name"]);
		}
		mysqli_free_result($result);
	}
}

?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>La Tavolita</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href="reset.css">
		<link rel = "stylesheet" href="layout.css">
	</head>

	<body>
	<?php include 'header.php' ?>
		<main>
			<div class="menuNav">
				<h1><a href="menu.php"><img src="Images/menuIcon.png" alt="Menu Items"/></a></h1>
				</br>
				<table class="categoryTable">
				<?php
					$sql = "SELECT * FROM menu_categories;";
					$result = mysqli_query($connection, $sql);
					if ($result = mysqli_query($connection,$sql)){
						while ($row=mysqli_fetch_assoc($result)){
							$category = $row["name"];
							$selected = "";
							if ($categoryTitle == $row["name"]){
								$selected = $row["name"];
								echo "<tr><td class='selected'>" . $category . 
							"</td></tr>";
							} else {
							echo "<tr><td>
								<a href = 'menu.php?category=" . $category . "'>" . $category . 
							"</a></td></tr>";
							}
						}
						mysqli_free_result($result);
					}
					else { echo "No Menu Available<br>";}
				?>
				</table>
				</br></br></br></br></br></br></br></br></br></br></br>
			</div>
			<div class="menuMain">
				<div class="menuWrapper">
					<?php 
						if(isset($categoryTitle)){
							include 'foodtable.php';
						} else {
							echo "Opening content";
						}
					?>
				</div>
			</div>
		</main>
		<?php include 'footer.php' ?>
	</body>
</html>