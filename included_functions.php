<?php

function redirect_to($new_location){
	header("Location: ". $new_location);
	exit;
}

function password_encrypt($password){
	$hash_format = "$2y$10$"; //2y means use blowfish. 10 is cost parameter - number of times to run the blowfish hash.
	//Blowfish wants salts of 22 characters or more.
	$salt_length = 22;
	
	$salt = generate_salt($salt_length);
	$format_and_salt = 	$hash_format . $salt;
	
	$hash = crypt($password, $format_and_salt); ///If this was echoed, salt would appear at beginning as part of result.
	//Means hash can be passed in again as a salt. Then the has contains the salt making it easy to compare.
	return $hash;
}

function generate_salt($length){
	//MD5 returns 32 characters
	$unique_random_string = md5(uniqid(mt_rand(), true));
	
	//Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);
	
	//But not '+' which is valid in base 64 encoding (base 64 encode returns '+' when it should be '.')
	$modified_base64_string = str_replace('+','.', $base64_string);
	
	//Truncate string to the correct length
	$salt = substr($modified_base64_string, 0, $length);
	
	return $salt;
}

function password_check($password, $existing_hash){
	$hash = crypt($password, $existing_hash);
	return ($hash == $existing_hash);
}

function run_query($connection,$query){
	$result = sqlsrv_query($connection, $query);
	return result;
}



?>