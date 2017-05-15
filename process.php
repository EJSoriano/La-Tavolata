#!/usr/local/php5/bin/php-cgi
<?php
	//REGEX for Price, Name, Description, Path
	$regprice = "/^\d+(?:\.\d{2})?$/";
	$regname = "/.*/";
	$regdesc = "/.*/";
	$regpath = "/.*/";
	$regcat = "/^\d+$/";
	$getarray = array();
	$error=false;
	//Sanitize Post Input
	//$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	foreach($_POST as $value){
		echo htmlspecialchars($value) . "\n";
	}
	//Connection Info
	require 'header.php';
	$type= sanitize($_POST[type]);
	
	
	function redirectTo($page){
		$url = $page;
		global $getarray;
		if(!empty($getarray)){
			$url.='?';
		}
		foreach($getarray as $value){
			$url .= '&'.$value . '=true';
		}
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$redirect = "Location: http://".$host.$uri.'/'.$url;
		header("Location: http://".$host.$uri.'/'.$url);

		die();
	}
	function sanitize($data)
	{
		$data = trim($data);
		$data= stripslashes($data);
		$data = htmlspecialchars($data);
		return $data; 
	}
	
	switch($type){
		case "add":
			if(!preg_match($regname, $_POST[name])){
				$getarray[]= "errname";
				$error=true;
			}
			if(!preg_match($regprice, $_POST[price])){
				$getarray[]= 'errprice';
				$error=true;
			}
			if(!preg_match($regdesc, $_POST[description])){
				$getarray[]= 'errdescription';
				$error=true;
			}
			if(!preg_match($regpath, $_POST[path])){
				$getarray[]= 'errpath';
				$error=true;
			}
			if(!preg_match($regcat, $_POST[category])){
				$getarray[]= 'errcat';
				$error=true;
			}
			if($error!=true){
				//Attempt Query
				echo "Got here";
				$query = "INSERT INTO menu_item (name,price,description,category_id,path_to_image)VALUES(?,?,?,?,?)";
				$stmt=mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($stmt, 'sssss',$name,$price,$description,$category,$path); 
				$name=sanitize($_POST[name]);
				$price=sanitize($_POST[price]);
				$description=sanitize($_POST[description]);
				$category=sanitize($_POST[category]);
				$path=sanitize($_POST[path]);
				
				if(mysqli_stmt_execute($stmt)==true){
					//Query Successful
					$getarray[] = 'success';
					redirectTo("add.php");
				}else{
					//Query Unsuccessful					
					$getarray[] = 'sqlfail';
					redirectTo("add.php");
				}
				mysqli_stmt_close($stmt);			
			}else{
				//Put all error's in the URL
				redirectTo("add.php");
			}
			break;
		case "modify":
			echo "Modify";
				
			break;
		case "delete":
			$query = "DELETE FROM menu_item WHERE name= ?";
			$stmt=mysqli_prepare($connection, $query);
			mysqli_stmt_bind_param($stmt, 's',$name); 
			$name= sanitize($_POST[name]);
			
			if(mysqli_stmt_execute($stmt)==true){
				//Query Successful
				$getarray[] = 'success';
				redirectTo("admin.php");
			}
			else{
				//Query Unsuccessful
				$getarray[] = 'sqlfail';
				redirectTo("admin.php");
			}
			mysqli_stmt_close($stmt);			
			break;
		default: 
			echo "How did you get here? Go Away";
			break;
	}
?>