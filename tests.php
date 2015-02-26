<?php
	try {
	   $conn = new PDO ( "sqlsrv:server = tcp:hvjcgi9sw1.database.windows.net,1433; Database = peerreview", "peerdataadmin", "datacunts4L!FE");
	       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch ( PDOException $e ) {
	    print( "Error connecting to SQL Server." );
	    die(print_r($e));
	}


	$sql = "INSERT INTO header_pages (id, data) VALUES (?, ?)";
	$params = array(1, "some data");

	$stmt = sqlsrv_query( $conn, $sql, $params);
	if( $stmt === false ) {
	     die( print_r( sqlsrv_errors(), true));
	}

	echo "string";
?>