<?php
	session_start();
	$_SESSION = array();
	
	
	include("include/db_connect.php");
	include("include/pepper.php");
	
	$email 		= $_POST['email'];
	$pw    		= $_POST['password'].PEPPER;
	

	
	try{
		
		$pdo = new PDO($pdo_connection['mysql'], $pdo_connection['user'], $pdo_connection['pwd']);
		
		$sql	= "SELECT * FROM adminuser WHERE admin_user_mail = :email AND admin_user_active = 1";
		
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		
		$selected = $statement->execute();
		
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$user_id		= $row['admin_user_id'];
			$user_name		= $row['admin_user_name'];
			$user_mail		= $row['admin_user_mail'];
			$user_admin		= $row['admin_user_admin'];
			$password		= $row['admin_user_password'];

			
			if(password_verify($pw, $password)){
				$_SESSION['admin_user_id']			= $user_id;
				$_SESSION['admin_user_name']		= $user_name;
				$_SESSION['admin_user_mail']		= $user_mail;
				$_SESSION['admin_user_admin']		= $user_admin;
				
			}
			
			
		}
			
		
	}catch (Exception $e){
		$fetch_user_error = $e->getMessage();	
		print_r($fetch_user_error);
	}	
	
	
	if(isset($_SESSION['admin_user_id'])){
		
		if($_SESSION['admin_user_id']<1){
			header("Location:login.php?e");
			exit;	
		}else{
			header("Location:index.php");
			exit;
		}
	}else{
		header("Location:login.php?e");
		exit;
	}
	
	
	
?>