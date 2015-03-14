<?php require_once 'templates/db_connection.php'; ?>
<?php session_start (); ?>
<?php
	if(isset($_SESSION)&&!empty($_SESSION['user_id'])){
		redirect_to('dashboard.php');
/*		header("Location: ". 'dashboard.php');
		exit;*/
	}
	// ///Check if user already logged in to redirect
?>
<?php
// /No blank fields
$Message = "";

if (isset ( $_POST ['submit'] )) {
	$User = $_POST ['username'];
	$Pass = $_POST ['password'];
	
	// If neither field is blank
	if (! empty ( $User ) && ! empty ( $Pass )) {
		
		//$hashed_password = password_encrypt ( $_POST ['password'] );
		$hashed_password = sha1('hqb%$t'.$_POST ['password'].'cg*l');
		
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
				// /TODO Store user id in session as well
				$_SESSION ['first_name'] = $row ["first_name"];
				$_SESSION ['group_id'] = $row ["group_id"];
				$_SESSION ['user_id'] = $row ["user_id"];
			}
			
			if (! isset ( $_SESSION ) || empty ( $_SESSION ['first_name'] )) {
				$Message = "
					<div class='alert alert-danger' role='alert'>
						<strong>Oh snap!</strong> You've entered an incorrect password and/or username. Change a few things up and try submitting again.
				  	</div>";
			} else {
				redirect_to ('dashboard.php');
				/*header("Location: ". 'dashboard.php');
				exit;*/
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
<html>
	<head>
	<title>Peer Assessment</title>
        <?php include 'templates/imports.php'; ?>
    </head>

	<body role='document'>
        <?php
			require_once 'templates/template_header.php';
			/*
			 * $html_string = header();
			 * echo html_string;
			 */
			
			// $Message = $User;
			echo $Message
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
									<td><input name="username" type="text" id="username"
										value=<?php echo htmlentities($User); ?>></td>
								</tr>
								<tr>
									<td>Password :</td>
									<td><input name="password" type="password" id="password"></td>
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

	<!--
		<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr>
				<form name="form1" method="post" action="index.php">
					<td>
						<table width="100%" border="0" cellpadding="3" cellspacing="1"
							bgcolor="#FFFFFF">
							<tr>
								<td colspan="3"><strong>Member Login </strong></td>
							</tr>
							<tr>
								<td width="78">Username</td>
								<td width="6">:</td>
								<td width="294"><input name="username" type="text"
									id="username" value=<?php echo htmlentities($User); ?>></td>
							</tr>
							<tr>
								<td>Password</td>
								<td>:</td>
								<td><input name="password" type="password" id="password"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><input type="submit" name="submit" value="Login"></td>
							</tr>
						</table> <a href="registration.php">Register account</a>
					</td>
				</form>
			</tr>
		</table>
-->

        <?php include 'templates/template footer.php';?>
    </body>
</html>
<?php
mysqli_close ( $connection );
?>