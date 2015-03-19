<?php
	$Message = "";
	require_once 'templates/db_connection.php';
?>

<html>
	<head>
		<title>Registration</title>
        <?php include 'templates/imports_index.php';?>
    </head>
    
<?php
if (isset ( $_POST ['submit'] )) {
	$First_Name = mysqli_real_escape_string($connection, $_POST ['name']);
	$Surname = mysqli_real_escape_string($connection, $_POST ['surname']);
	$User = mysqli_real_escape_string($connection,$_POST ['user']);
	$Pass = mysqli_real_escape_string($connection,$_POST ['pass']);
	$CPass = mysqli_real_escape_string($connection,$_POST ['cpass']);
	
	$Num = 0;
	
	if($Pass!=$CPass){
		$Num++;
	}
	
	foreach ( $_POST as $Value ) {
		if (empty($Value)) { 
			$Num ++;
		}
	}
	
	if ($Num == 0) {
		
		/// Hash and salt input password then store in DB.
		$Pass = password_encrypt($Pass); 
		
		///Query then redirect
		$query = "INSERT INTO users (first_name, surname, login, password) VALUES ('{$First_Name}','{$Surname}','{$User}','{$Pass}')";
                $result = mysqli_query($connection, $query)
                    or die ('Error: insert failed'.mysql_error());  
		
		redirect_to('index.php');
		
	} else{
		$Message = "
		  <div class='alert alert-danger' role='alert'>
			<strong>Oh snap!</strong> You're missing some fields or have entered some things in incorrectly. Change a few things up and try submitting again.
		  </div>";
	}
} else {
	$First_Name = "";
	$Surname = "";
	$User = "";
	$Pass = "";
	$CPass = "";
}

?>

	<body role='document'>
        <?php include 'templates/template_header.php';?>
        <?php echo $Message?>

        <div class="row">
        	<div class="page-header">
	            <h1>Registration</h1>
	        </div>
        </div>

        <div class="row">
        	<div id="Sign-Up">
				<form method="post" action="registration.php">
					<div class="col-sm-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">
									Please enter your registration details
								</h3>
							</div>
							<div class="panel-body">
								<table class="table">
									<tbody>
										<tr>
											<td>First name</td>
											<td><input type="text" name="name" value=<?php echo $First_Name ?>></td>
										</tr>
										<tr>
											<td>Surname</td>
											<td><input type="text" name="surname" value=<?php echo $Surname ?>></td>
										</tr>
									<!--	<tr>
											<td>Group ID</td>
											<td><input type="text" name="group_id" value=<?php echo $Group_ID ?>></td>
										</tr>
									-->	<tr>
											<td>Username</td>
											<td><input type="text" name="user" value=<?php echo $User ?>></td>
										</tr>
										<tr>
											<td>Password</td>
											<td><input type="password" name="pass"></td>
										</tr>
										<tr>
											<td>Confirm Password</td>
											<td><input type="password" name="cpass"></td>
										</tr>
										<tr>
											<td><input id="button" type="submit" name="submit" value="Sign-Up"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>


        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
mysqli_close ( $connection );
?>