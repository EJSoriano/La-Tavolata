#!/usr/local/php5/bin/php-cgi
<?php
	include 'required.php';
	//REGEX for Price, Name, Description, Path
	$regprice = "/^\d+(?:\.\d{2})?$/";
	$regname = "/^[\w\s\'\.\, ]+$/";
	$regdesc = "/^[\w\s\'\.\,]+$/";
	$regpath = "/^[\w\/\%\$\s\:\~\.\_]+$/";
	$regcat = "/^\d+$/";
	$getarray = array();
	$error=false; 
	//Connection Info
	require 'header.php';
	$type=$_POST[type];
	
	
	function redirectTo($page){
		$url = $page;
		global $getarray;
		if(strpos($page, '?')===false){
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
				$name=$_POST[name];
				$price=$_POST[price];
				$description=$_POST[description];
				$category=$_POST[category];
				$path=$_POST[path];
				
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
			if(!preg_match($regname, $_POST[oname])){
				$getarray[]= "erroname";
				$error=true;
			}
			if($error!=true){
				//Attempt Query
				echo "Got here";
				$query = "UPDATE menu_item SET name=?, price=?,description=?, category_id=?, path_to_image=? WHERE name=?";
				$stmt=mysqli_prepare($connection, $query);
				mysqli_stmt_bind_param($stmt, 'ssssss',$name,$price,$description,$category,$path,$oname); 
				$name=$_POST[name];
				$price=$_POST[price];
				$description=$_POST[description];
				$category=$_POST[category];
				$path=$_POST[path];
				$oname=$_POST[oname];
				if(mysqli_stmt_execute($stmt)==true){
					//Query Successful
					$getarray[] = 'success';
					redirectTo("admin.php");
				}else{
					//Query Unsuccessful					
					$getarray[] = 'sqlfail';
					redirectTo("modify.php?oname=".trim($oname));
				}
				mysqli_stmt_close($stmt);			
			}else{
				//Put all error's in the URL
				redirectTo("modify.php?oname=".trim($oname));
			}
			break;
				
			break;
		case "delete":
			$query = "DELETE FROM menu_item WHERE name= ?";
			$stmt=mysqli_prepare($connection, $query);
			mysqli_stmt_bind_param($stmt, 's',$name); 
			$name= $_POST[name];
			
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