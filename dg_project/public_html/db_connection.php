<?php
////Use constants here instead of variables
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'peer_assessment';

$connection = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

//error handling
if (mysqli_connect_errno()){
	die("Database connection failed: "
			.mysqli_connect_error()
			." (" .mysqli_connect_errno(). ")"
	);
}
?>