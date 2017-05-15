#!/usr/local/php5/bin/php-cgi
<!DOCTYPE html>
<html lang = "en">
<?php
	  if (isset($_GET[errsql])){
		  $sqlErr = "SQL Error: " . mysqli_error($connection);
	  }
	  if (isset($_GET[success])){
		  $success = "Your Item was Successfully added";
	  }
?>
	<head>
		<title>La Tavolita</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href="reset.css">
		<link rel = "stylesheet" href="layout.css">
	</head>

	<body>
		<?php 
			include 'header.php';
			//require 'required.php';	
		?>

		<main>
			<span class='errorblock'> <?php echo $sqlErr; ?> </span>
			<span class='successblock'> <?php echo $success; ?> </span>
		<div class="AddButtonContainer">
				<p> Add a New Item <a href="add.php"> Here </a></p>
			</div>
         <div class="panel panel-danger spaceabove">           
           <div class="tablediv"><h4>Items</h4></div>
           <table class="table">
             <tr>
				<th>Name</th>
				<th>Price</th>
				<th>Category</th>
				<th></th>
				<th></th>

             </tr> 
			 <?php
				$query = "SELECT name, price, category_id FROM menu_item ORDER BY category_id , name ASC";
				  $result = mysqli_query($connection, $query);
				  if ($result){
					while ($row=mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>". $row[name]. "</td>"; 
						echo "<td> $" . $row[price] . "</td>";
						$query = "SELECT name FROM menu_categories WHERE id LIKE " . $row[category_id];
						$catResult = mysqli_query($connection, $query);
						$catrow = mysqli_fetch_assoc($catResult);
						echo "<td>" . $catrow[name] . "</td>";
						echo "<td><form method='GET' action='modify.php'> 
						<input type='hidden' name='name' value=".$row[name]."> 
						<input type='submit' value='Modify'> 
						</form></td>";
						echo "<td><form method='POST' action='process.php'> 
						<input type='hidden' name='name' value=".$row[name]."> 
						<input type='hidden' name='type' value='delete'> 
						<input type='submit' value='Delete'> 
						</form></td>";
						echo "</tr>";
					}
					mysqli_free_result($result);
				  }
				  else { echo "Database Query Error Detected, no results returned<br>";}
			?>
           </table>
         </div>   
		</main>
	</body>
</html>
<?php mysqli_close();?>