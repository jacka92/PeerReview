<?php

function redirect_to($new_location){
	header("Location: ". $new_location);
	exit;
}

function password_encrypt($password){
	$password = sha1('hqb%$t'.$password.'cg*l');
	return $password;
	
}

function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed");
	}
}
/*
function select_query($collumn, $table, $condition){
	global $connection;
	$sql  = "SELECT $collumn ";
	$sql .= "FROM $table ";
	$sql .= "WHERE $condition" ;
	$sql .= "LIMIT 1"
	$result = mysql_result(mysql_query($connection, $sql),0);
	return mysql_fetch_assoc($result);
}
*/
?>