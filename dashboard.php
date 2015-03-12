<?php
	require_once 'templates/db_connection.php';
	session_start();
	$Welcome = "Hello " . $_SESSION ['first_name'] . ", your Group ID is " . $_SESSION ['group_id'];
	echo $Welcome;
?>

<html>
	<head>

		<title>Dashboard</title>
		<?php include 'templates/imports.php';?>

    </head>

	<body role='document'>

        <?php include 'templates/template_header.php';?>

        <h1>Dat home page though</h1>

		<form action="viewreport.php">
			<input type="submit" value="View your reports">
		</form>        

        <?php include 'templates/template footer.php';?>
    </body>
</html>