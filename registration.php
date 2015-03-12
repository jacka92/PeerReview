<!DOCTYPE html>

<?php
$Message = "";
	require_once 'templates/db_connection.php';
require_once 'included_functions.php';

if (isset ( $_POST ['submit'] )) {
	$First_Name = $_POST ['name'];
	$Surname = $_POST ['surname'];
	$Group_ID = $_POST ['group_id'];
	$User = $_POST ['user'];
	$Pass = $_POST ['pass'];
	$CPass = $_POST ['cpass'];
	
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
		$query = "INSERT INTO users (group_id, first_name, surname, login, password) VALUES ({$Group_ID},'{$First_Name}','{$Surname}','{$User}','{$Pass}')";
                $result = mysqli_query($connection, $query)
                    or die ('Error: insert failed'.mysql_error());  
		
		redirect_to('index.php');
		
	} else{
		$Message = "
		  <div class='alert alert-danger' role='alert'>
			<strong>Oh snap!</strong> You're missing some fields or have entered some things in incorrectly. Change a few things up and try submitting again.
		  </div>"; ////Place properly
	}
} else {
	$First_Name = "";
	$Surname = "";
	$Group_ID = "";
	$User = "";
	$Pass = "";
	$CPass = "";
}

?>
<html>
<head>
<title>Registration</title>
        <?php include 'templates/imports.php';?>
    </head>

<body role='document'>
        <?php include 'templates/template_header.php';?>
        <?php echo $Message?>

        <div id="Sign-Up">
		<fieldset style="width: 30%">
			<legend>Registration Form</legend>
			<table border="0">
				<form method="post" action="registration.php">
					<tr>
						<td>First name</td>
						<td><input type="text" name="name" value=<?php echo $First_Name ?>></td>
					</tr>
					<tr>
						<td>Surname</td>
						<td><input type="text" name="surname" value=<?php echo $Surname ?>></td>
					</tr>
					<tr>
						<td>Group ID</td>
						<td><input type="text" name="group_id" value=<?php echo $Group_ID ?>></td>
					</tr>
					<tr>
						<td>UserName</td>
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
				</form>
				</tr>
			</table>
		</fieldset>
	</div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
mysqli_close ( $connection );
?>