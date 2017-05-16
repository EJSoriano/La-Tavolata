<?php echo "<h1>" . $categoryTitle . "</h1>"; ?>
<br/>
<table class="foodTable">
	<?php
		$sql = "SELECT * FROM menu_item where category_id = " . $catID . ";";
			$result = mysqli_query($connection, $sql);
			if ($result = mysqli_query($connection,$sql)){
				while ($row=mysqli_fetch_assoc($result)){
					$foodName = $row["name"];
					$foodPrice = $row["price"];
					$foodDescription = $row["description"];
					$foodImage = $row["path_to_image"];
					echo "<tr><td>" . $foodImage . "</td>";
					echo "<td><div class='foodName'>" . $foodName . "</div>";
					echo "<div class='foodDetails'>" . $foodDescription . "</div>";
					echo "<div class='foodPrice'>$" . $foodPrice . "</div></td></tr>";
				}
				mysqli_free_result($result);
			}
			else { echo "No Menu Available<br>";}
	?>
</table>
	