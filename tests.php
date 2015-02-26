<?php
	try {
	   $conn = new PDO ( "sqlsrv:server = tcp:hvjcgi9sw1.database.windows.net,1433; Database = peerreview", "peerdataadmin", "datacunts4L!FE");
	       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch ( PDOException $e ) {
	    print( "Error connecting to SQL Server." );
	    die(print_r($e));
	}

	$query  = "CREATE TABLE header_pages ";
	$query .= "( ";
	$query .= "column_name1 data_type(size), ";
	$query .= "column_name2 data_type(size), ";
	$query .= "column_name3 data_type(size) ";
	$query .= ")";
	
	$result = sqlsrv_query( $conn, $query);
?>