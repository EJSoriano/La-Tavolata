#!/usr/local/php5/bin/php-cgi
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>La Tavolita</title>
		<meta charset="utf-8">
		<link rel = "stylesheet" href="reset.css">
		<link rel = "stylesheet" href="layout.css">
	</head>
	<?php 
	include 'header.php'; 
	include 'required.php';
	//PHP Session validation here
	  if(isset($_GET[errname])) {
		  $nameErr = "* Must have valid characters in Name. No Special Characters Allowed eg '.' ',' '^' etc"; 
	  } 
	  if (isset($_GET[errprice])) {
		  $priceErr = "* Price must be in valid format. eg '12' or '12.40'"; 
	  }
	  if (isset($_GET[errdescription])) {
		  $descErr = "* Description is required";
	  }
	  if (isset($_GET[errpath])) {
		  $pathErr = "* Path needs to be valid"; 
	  }
	  if (isset($_GET[errcat])) {
		  $catErr = "* You Need to set a Category"; 
	  }
	  if (isset($_GET[sqlfail])){
		  $sqlErr = "SQL Error: " . mysqli_error($connection);
	  }
	  if (isset($_GET[success])){
		  $success = "Your Item was Successfully added";
	  }
	  $query = "SELECT name, price, category_id, path_to_image,description from menu_item WHERE name = ?";
	  $stmt=mysqli_prepare($connection, $query);
	  mysqli_stmt_bind_param($stmt, 's',$oname);
	  $oname= $_GET[oname];
	  echo $oname;

	  mysqli_stmt_execute($stmt);
	  mysqli_stmt_bind_result($stmt, $name, $price, $category, $path, $description);
	  if(!mysqli_stmt_fetch($stmt)){
		  echo "Illegal Link, Click <a href='admin.php'> Here </a> to go back";
		  die();
	  }
	  mysqli_stmt_close($stmt);
	?>

	<body>
		<main>
		<div class="back"> Click <a href="admin.php"> Here </a> to return </div>
		<span class='errorblock'> <?php echo $sqlErr; ?> </span>
		<span class='successblock'> <?php echo $success; ?> </span>
		<form method="POST" action='process.php' >
			<fieldset>
				<legend> New Menu Item Form </legend>
					<input type='hidden' name='type' value='modify'>
					<input type='hidden' name='oname' value="<?php echo $_GET[oname]; ?>"
					<div class= 'form_name'>	
						<label for= 'name'>Item Name </label>
							<input type='text' name='name' value="<?php echo $name ?>">
							<span class='error'> <?php echo $nameErr; ?> </span>
					</div>
					<div class= 'form_price'>
						<label for = 'price'> Price </label>
							<input type='text' name='price' value='<?php echo $price ?>'>
							<span class='error'> <?php echo $priceErr; ?> </span>
					</div>
					<div class= 'form_category'>
						<select name = 'category' id= 'category' >
						<?php 			
							$query = "SELECT name, id FROM menu_categories ORDER BY name ASC";
							$result = mysqli_query($connection, $query);
							if($result){
								while($row=mysqli_fetch_assoc($result)){
									echo "<option value='" . $row[id] ."'"; 
									if($row[id]==$category){echo " selected='selected'" ;}  
									echo ">" . $row[name]. "</option>\r\n"; 
								}
							}else{echo "Database Query Error Detect, no results returned <br/>";}
						?>
						</select>
						<span class='error'> <?php echo $catErr ?> </span>
					</div>
					<div class= 'form_path'>
						<label for = 'path'>File Path </label>
							<input type='text' name = 'path'  value="<?php echo $path ?>">
							<span class='error'><?php echo $pathErr; ?></span>
					</div>
					<div class= 'form_description'>
						<label for= 'description'>Description </label>
							<input type='text' name = 'description'  value="<?php echo $description ?>">
							<span class='error'><?php echo $descErr; ?></span>			
					</div>
						<input type='submit' value='submit'>		
			</fieldset>
		</form>
		</main>
	</body>
</html>

<?php mysqli_close();?>