<?php require_once 'templates/db_connection.php'; ?>

<html>
	<head>
	<title>Peer Assessment</title>
        <?php include 'templates/imports_index.php'; ?>
    </head>

<?php
	$Message = '';

	if(isset($_SESSION)&&!empty($_SESSION['user_id'])){
		redirect_to('dashboard.php');
	}else{
	}
	if (isset ( $_POST ['submit'] )) {
		$User = mysqli_real_escape_string($connection, $_POST ['username']);
		$Pass = mysqli_real_escape_string($connection, $_POST ['password']);
		
		// If neither field is blank
		if (! empty ( $User ) && ! empty ( $Pass )) {
			
			$hashed_password = password_encrypt($_POST ['password']);
			
			$query = "SELECT * FROM users WHERE '$User' = login AND '$hashed_password' = password LIMIT 1";
			$result = mysqli_query ( $connection, $query ) or die ( 'Error: ' . mysql_error () );
			
			// If query produces nothing
			if (empty ( $result )) {
				$Message = "
					<div class='alert alert-danger' role='alert'>
						<strong>Oh snap!</strong> Everything's blank! Please fill in everything.
				  	</div>";
			} else {
				while ( $row = mysqli_fetch_assoc ( $result ) ) {
					$_SESSION ['first_name'] = $row ["first_name"];
					$_SESSION ['group_id'] = $row ["group_id"];
					$_SESSION ['user_id'] = $row ["user_id"];
					$_SESSION ['admin'] = $row ["admin"];

    				$_SESSION['check'] = 0;
				}
				
				if (! isset ( $_SESSION ) || empty ( $_SESSION ['first_name'] )) {
					$Message = "
						<div class='alert alert-danger' role='alert'>
							<strong>Oh snap!</strong> You've entered an incorrect password and/or username. Change a few things up and try submitting again.
					  	</div>";
				} else {
					redirect_to ('dashboard.php');
				}
			}
		} else {
			$Message = "
				<div class='alert alert-danger' role='alert'>
					<strong>Oh snap!</strong> You're missing some fields. Please fill in everything.
			  	</div>";
		}
	} 

	else {
		$User = "";
	}

?>

	<body role='document'>
        <?php
			require_once 'templates/template_header.php';
			echo $Message;
		?>

        <div class="jumbotron">
		<h1>Welcome to Peer Review!</h1>
		<p>Please either enter your login details to access the site, or sign
			up using the registration link below</p>
	</div>

	<div class="row">
		<form name="form1" method="post" action="index.php">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Member login</h3>
					</div>
					<div class="panel-body">
						<table class="table">
							<tbody>
								<tr>
									<td>Username :</td>
									<td>
										<input name="username" type="text" id="username" placeholder="Enter your username">
									</td>
								</tr>
								<tr>
									<td>Password :</td>
									<td>
										<input name="password" type="password" id="password" placeholder="Enter your password">
									</td>
								</tr>
								<tr>
									<td colspan="3"><input type="submit" name="submit"
										value="Login"></td>
								</tr>
								<tr>
									<td colspan="3"><a href="registration.php">Register account</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
        <?php include 'templates/template footer.php';?>
    </body>
</html>
<?php
mysqli_close ( $connection );
?>