<?php 

require_once('required.php');
if(isset($_GET["category"])){
	$category = $_GET["category"];
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
				</br></br>
				<table class="categoryTable">
				<?php
					//$sql = "SELECT CategoryName FROM Categories";
					//$result = mysqli_query($connection, $sql);
					//if ($result = mysqli_query($connection,$sql)){
					//	while ($row=mysqli_fetch_assoc($result)){
					//		echo "<li><a href = 'menu.php?category=" . $category . "'> " . $row["CategoryName"]. "</li></a>";
					//	}
					//	mysqli_free_result($result);
					//}
					//else { echo "No Menu Available<br>";}
				?>
					<tr>
						<td><a href="menu.php?category=Appetizer">Appetizers</a></li></td>
					</tr>
					<tr>
						<td><a href="menu.php?category=Soups">Soups</a></li></td>
					
					<tr><td>Salads</td></tr>
					<tr><td>Pastas</td></tr>
				</table>
			</div>
			<div class="menuMain">
					<?php 
						if(isset($category)){
							include 'foodtable.php';
						} else {
							echo "Opening content";
						}
					?>
			</div>
		</main>
		<?php include 'footer.php' ?>
	</body>
</html>