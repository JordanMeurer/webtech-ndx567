<!DOCTYPE html>
<html>
	<head>
		<title>Account Creation</title>
	</head>
<?php

	include('functions.php');
	include('Database-Assign1.php');

	$conn = connect_db();
	
	//variables
	$username = sanitizeString($_POST["username"], $conn);
	$password = sanitizeString($_POST["password"], $conn);
	$Email = sanitizeString($_POST["email"], $conn);
	$VerQuestion = sanitizeString($_POST["VerQuestion"], $conn);
	$VerAnswer = sanitizeString($_POST["VerAnswer"], $conn);
	$location = sanitizeString($_POST["location"], $conn);
	$name = sanitizeString($_POST["name"], $conn);
	$gender = sanitizeString($_POST["gender"], $conn);
	$dob = sanitizeString($_POST["dob"], $conn);
	$pic = sanitizeString($_POST["profile_pic"], $conn);

	//hash the password
	$password = hash_pass($password);
	
	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "";
	$dbname = "myDB-Assign1";



	
	
	$sql = "INSERT INTO users (username, password, name, email, verification_question,
	verification_answer, location, gender, dob, profile_pic) VALUES ('$username', '$password', '$name', '$Email', '$VerQuestion',
	'$VerAnswer', '$location', '$gender', '$dob', '$pic')";
	
	if ($conn->query($sql) === TRUE) {
		echo "Success creating account!";
	}
	else{
		echo "Error: " . $sql . "<br>" . $conn->error;
}


?>

	<br><a href="Login-Assign1.html">Back to login</a>
</html>