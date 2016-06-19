<?php


	include('database.php');
	include('functions.php');
	$conn = connect_db();
	$UID = sanitizeString($_POST['UID'],$conn);
	$PID = sanitizeString($_POST['PID'],$conn);
	$content = sanitizeString($_POST['content'],$conn);
	$username = sanitizeString($_POST['username'],$conn);
	$profile_pic = sanitizeString($_POST['profile_pic'],$conn);
	$likes = 0;


	$insert = "INSERT INTO comments(post_id,content,UID,name,profile_pic,likes) VALUES ('$PID','$content','$UID','$username','$profile_pic','$likes')";
	$server_check = $conn->query($insert);


	if($server_check){
		echo 'PISS on these BUGS';
		header('Feed-Assign1.php');
	}
	else{
		echo "Failed to communicate with server, try again";
	}









?>