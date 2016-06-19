<?php

//For signing out
function destroySession()
{
    $_SESSION=array();
    //$_SESSION = [];
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');
    session_destroy();
}


//to ensure no sql injection
function sanitizeString($var, $conn)
{
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);
	return $conn->real_escape_string($var);
}

function hash_pass($var){
$options = [
    'cost' => 11,
];
	$passwordFromPost = $var;
	$hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $options);
return $hash;
}
?>