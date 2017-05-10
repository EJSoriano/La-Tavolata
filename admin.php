#!/usr/local/php5/bin/php-cgi
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
         <div class="panel panel-danger spaceabove">           
           <div class="tablediv"><h4>Items</h4></div>
           <table class="table">
             <tr>
               <th>Name</th>
               <th>Price</th>
               <th>Category</th>
               <th>City</th>
             </tr> 
			 <?php
				$query = "SELECT name, price, category_id FROM menu_item";
				  $result = mysqli_query($connection, $query);
				  if ($result){
					while ($row=mysqli_fetch_assoc($result)){
						echo "<tr><td>". $row[name]. "</td>"; 
						echo "<td>" . $row[price] . "</td>";
						echo "<td>" . $row[University] . "</td>";
						echo "<td>" . $row[City] . "</td></tr>";
					}
					mysqli_free_result($result);
				  }
				  else { echo "no result<br>";}
			?>

           </table>
         </div>   
		</main>
	</body>
</html>
<?php mysqli_close();?>