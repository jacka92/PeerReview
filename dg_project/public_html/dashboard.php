<!DOCTYPE html>

<?php
// Creating the db connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'peer_assessment';
session_start();

$connection = mysqli_connect ( $dbhost, $dbuser, $dbpassword, $dbname );

// error handling
if (mysqli_connect_errno ()) {
	die ( "Database connection failed: " . mysqli_connect_error () . " (" . mysqli_connect_errno () . ")" );
}

$Welcome = "Hello " . $_SESSION ['Name'] . ", your Group ID is " . $_SESSION ['GroupID'];

echo $Welcome;
?>



<html>
<head>

<title>Dashboard</title>
        <?php include 'templates/imports.php';?>

    </head>

<body role='document'>

        <?php include 'templates/template header.php';?>

        <h1>Dat home page though</h1>

	<form action="viewreport.php">
		<input type="submit" value="View your reports">
	</form>        

        <?php include 'templates/template footer.php';?>
    </body>
</html>