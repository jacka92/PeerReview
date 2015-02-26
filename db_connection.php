<?php
// Localhost test -------------------------------------------

/*
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
*/

// SQL Server test (from Azure's site)----------------------------------------------------

try {
   $conn = new PDO ( "sqlsrv:server = tcp:hvjcgi9sw1.database.windows.net,1433; Database = peerreview", "peerdataadmin", "datacunts4L!FE");
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch ( PDOException $e ) {
    print( "Error connecting to SQL Server." );
    die(print_r($e));
}

/*
$connectionInfo = array("UID" => "peerdataadmin@hvjcgi9sw1", "pwd" => "datacunts4L!FE", "Database" => "peerreview", "LoginTimeout" => 30, "Encrypt" => 1);
$serverName = "tcp:hvjcgi9sw1.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
*/


?>