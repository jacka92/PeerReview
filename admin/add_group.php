<?php
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
session_start ();
?>
<?php
	include '../templates/included_functions.php';

    $q  = "INSERT INTO groups (group_id) VALUES (NULL)";
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../admin.php');
?>