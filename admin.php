#!/usr/local/php5/bin/php-cgi

<!DOCTYPE html>
<html lang = "en">
<?php	
	include 'required.php';
	if (!isset($_SESSION['UserID'])){
		header('Location: login.php');
	}
	  if (isset($_GET[sqlfail])){
		  $sqlErr = "SQL Error: " . mysqli_error($connection);
	  }
	  if (isset($_GET[success])){
		  $success = "Operation Successful";
	  }
?>
	<head>
		<title>Manage Menu</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href="reset.css">
		<link rel = "stylesheet" href="layout.css">
	</head>

	<body>
		<?php 
			include 'header.php';
		?>

		<main>
			<div class="adminMain">
				<h1>Manage Menu</h1>
				<p><a href="add.php" class="addButt">Add Menu Item</a></p>
				<div class="panel panel-danger spaceabove">  
					<span class='message'> <?php echo $sqlErr; ?> </span>
					<span class='message'> <?php echo $success; ?> </span>
					<table class="adminTable">
					<tr>
						<th>Name</th>
						<th>Price</th>
						<th>Category</th>
						<th>Manage</th>
					</tr>
					<?php
						$query = "SELECT name, price, category_id FROM menu_item ORDER BY name ASC";
						$result = mysqli_query($connection, $query);
						if ($result){
							while ($row=mysqli_fetch_assoc($result)){
								echo "<tr>";
								echo "<td>". $row["name"]. "</td>"; 
								echo "<td> $" . $row["price"] . "</td>";
								$query = "SELECT name FROM menu_categories WHERE id LIKE " . $row["category_id"];
								$catResult = mysqli_query($connection, $query);
								$catrow = mysqli_fetch_assoc($catResult);
								echo "<td>" . $catrow["name"] . "</td>";
								echo "<td style='overflow-x:auto'><form method='GET' action='modify.php'> 
								<input type='hidden' name='oname' value=\"".$row["name"]."\"> 
								<input type='submit' value='Edit' class='modifyButt'> 
								</form>";
								echo "<form method='POST' action='process.php'> 
								<input type='hidden' name='name' value=\"".$row["name"]."\"> 
								<input type='hidden' name='type' value='delete'> 
								<input type='submit' value='Delete' class='deleteButt'> 
								</form></td>";
								echo "</tr>";
							}
							mysqli_free_result($result);
						  }
						  else { echo "Database Query Error Detected, no results returned<br>";}
					?>
					</table>
				</div>   
			</div>
		</main>
		
		<?php include 'footer.php' ?>
	</body>
</html>
