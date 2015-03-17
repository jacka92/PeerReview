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

	$Title = isset($_POST ['title']) ? $_POST ['title'] : '';
	$Content = isset($_POST ['content']) ? $_POST ['content'] : '';

    $q  = "INSERT INTO forum (post_id, post_title, post_content, post_date) VALUES (NULL, '{$Title}', '{$Content}', CURRENT_TIMESTAMP)";
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../forum.php');
?>