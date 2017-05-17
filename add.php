#!/usr/local/php5/bin/php-cgi
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
	</head>
	<?php require 'header.php'; 
	//PHP Session validation here
	
	$regprice = "/^\d+(?:\.\d{2})?$/";
	$regname = "/.*/";
	$regdesc = "/.*/";
	$regpath = "/.*/";
	$regcat = "^\d+$";
	$error=false;	
	//$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$name= $_POST[name];
	$price= $_POST[price];
	$description= $_POST[description];
	$path = $_POST[path];
	$category= $_POST[category];
	$error=false;



	  if(isset($_GET[errname])) {
		  $nameErr = "* Must have valid characters in Name. No Special Characters Allowed eg '.' ',' '^' etc"; 
	  } 
	  if (isset($_GET[errprice])) {
		  $priceErr = "* Price must be in valid format. eg '12' or '12.40'"; 
	  }
	  if (isset($_GET[errdescription])) {
		  $descErr = "* Description must have valid alphanumeric characters in it. No Special Characters Allowed";
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
		  $success = "Your Item was Successfully Added";
	  }
	?>

	<body>
	<main>
		<div class="back"> Click <a href="admin.php"> Here </a> </div>
		<span class='errorblock'> <?php echo $sqlErr; ?> </span>
		<span class='successblock'> <?php echo $success; ?> </span>
		<form method="POST" action='process.php' >
			<fieldset>
				<legend> New Menu Item Form </legend>
					<input type='hidden' name='type' value='add'>
					<div class= 'form_name'>	
						<label for= 'name'>Item Name </label>
							<input type='text' name='name' >
							<span class='error'> <?php echo $nameErr; ?> </span>
					</div>
					<div class= 'form_price'>
						<label for = 'price'> Price </label>
							<input type='text' name='price'>
							<span class='error'> <?php echo $priceErr; ?> </span>
					</div>
					<div class= 'form_category'>
						<select name = 'category' id= 'category' >
						<option selected value='' disabled>Choose a Category</option>
						<?php 			
							$query = "SELECT name, id FROM menu_categories ORDER BY name ASC";
							$result = mysqli_query($connection, $query);
							if($result){
								while($row=mysqli_fetch_assoc($result)){
								echo "<option value='" . $row[id] . "'>" . $row[name] . "</option>\r\n"; 
								}
							}else{echo "Database Query Error Detect, no results returned <br/>";}
						?>
						</select>
						<span class='error'> <?php echo $catErr ?> </span>
					</div>
					<div class= 'form_path'>
						<label for = 'path'>File Path </label>
							<input type='text' name = 'path'>
							<span class='error'><?php echo $pathErr; ?></span>
					</div>
					<div class= 'form_description'>
						<label for= 'description'>Description </label>
							<input type='text' name = 'description'>
							<span class='error'><?php echo $descErr; ?></span>			
					</div>
						<input type='submit' value='submit'>		
			</fieldset>
		</form>
		<main>
	</body>
</html>

<?php mysqli_close();?>