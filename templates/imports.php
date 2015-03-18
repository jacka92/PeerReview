<?php 
    include 'templates/included_functions.php';
    if (!isset($_SESSION)||empty($_SESSION['user_id'])){
		redirect_to('index.php');
	}
?>
<?php
	echo "<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>

		<!-- Bootstrap-->
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href='css/bootstrap-theme.min.css' rel='stylesheet'>
		<link href='css/custom.css' rel='stylesheet'>";
?>