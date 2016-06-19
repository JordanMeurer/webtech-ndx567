<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('Database-Assign1.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	$user_logged_in = $row;

	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='Posts-Assign1.php'>";
	echo "<p><textarea name='content' placeholder = 'Say something...'></textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<input type='hidden' name='profile_pic' value='$row[profile_pic]' />";
	echo "<p><input type='submit'></p>";	
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts
	for($i = 0; $i < $num_of_rows; $i++){
		$row = mysqli_fetch_row($result_posts);
		$result_comment_rows = mysqli_query($conn,"SELECT * FROM comments WHERE post_id='$row[0]'");
		$num_of_comments = mysqli_num_rows($result_comment_rows);
		echo "$row[3] said: $row[1] ($row[5]) Likes";
		echo "<form action='Likes-Assign1.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>";
		echo "Comments:<br>";
		if($num_of_comments > 0){
			for($j = 0; $j < $num_of_comments; $j++){
			$comment_row = mysqli_fetch_row($result_comment_rows);
			echo "<p>$comment_row[3] commented $comment_row[1] ($comment_row[6])</p>";
/*			echo "<form action='likes_comment.php' method='POST'>
			<input type='hidden' value='$comment_row[0]' name='PID' />
			<input type='submit' value='Like this Comment' />
			</form>";*/
			}
		}else{
			echo "Be the first to comment on this post!<br>";
		}
	//writing a comment
		echo "<form method='POST' action='Comment-Assign1.php'>";
		echo "Submit comment:<br>";
		echo "<p><textarea name='content' placeholder = 'Comment...'></textarea></p>";
		echo "<input type='hidden' name='UID' value='$user_logged_in[id]'/>";
		echo "<input type='hidden' name='username' value='$user_logged_in[Username]' />";
		echo "<input type='hidden' name='profile_pic' value='$user_logged_in[profile_pic]' />";
		echo "<input type='hidden' value='$row[0]' name='PID' />";
		echo "<p><input type='submit'></p>";	
		echo "</form>";
	}

?>


</body>
</html>
