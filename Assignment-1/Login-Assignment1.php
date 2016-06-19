<?php
		
	include('functions.php');
	include('Database-Assign1.php');
	
	//start session
	session_start();	

	$conn = connect_db();
	
	//get username and password from $_POST
	$username = sanitizeString($_POST["username"], $conn);
	$password = sanitizeString($_POST["password"], $conn);

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "";
	$dbname = "myDB-Assign1";


	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	$user = mysqli_fetch_row($result);
	
	$num_of_rows = mysqli_num_rows($result);
	//Check in the DB
/*	$hashed = hash_pass($password);
	if(password_verify($password, $hashed)){
		echo 'now it works!';
	}
	else{
		echo 'how?';
	}*/
	echo $user[2];
	if(password_verify($password, $user[2])){
		//If authenticated: say hello!
		$_SESSION["username"] = $username;
		header("Location: Feed-Assign1.php");
		//echo "Success!! Welcome ".$username;
	}else{
		//else ask to login again..	
		echo "Invalid password! Try again! $password";

	}
	
	
?>
