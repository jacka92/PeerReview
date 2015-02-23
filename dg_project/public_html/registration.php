<!DOCTYPE html>
<?php
$connection = mysqli_connect ( 'localhost', 'root', '', 'peer_assessment' ) or die ( 'Error: ' . mysql_error () );

$Message = "";
?>
<?php

require_once 'included_functions.php';
if (isset ( $_POST ['submit'] )) {
	$First_Name = $_POST ['name'];
	$Surname = $_POST ['surname'];
	$Group_ID = $_POST ['group_id'];
	$User = $_POST ['user'];
	$Pass = $_POST ['pass'];
	$CPass = $_POST ['cpass'];
	
	$Num = 0;
	
	/*$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
	 * if(filter_var($email,FILTER_SANITIZE_EMAIL)){
	 * echo 'valid email address'.
	 * 
	 * 
	 * SHA - secure hash algorithm in MySQL - stores hash in database. Make sure to override e.g:
	 * INSERT INTO users (username, password) VALUES ('user', SHA('password'));	
	 * 
	 * Or php hashing can also be used: $password = md5($_POST['pass']);
	 * Additional config needed for https connection
	 * 
	 * Stored procedures are immune from SQL attack
	 * htmlspecialchars method can be used on php to protect against html/JS injection
	 * */
	
	
	
	if($Pass!=$CPass){
		$Num++;
	}
	
	foreach ( $_POST as $Value ) {
		if ($Value=='' ) { /////////Use empty here?
			$Num ++;
		}
	}
	
	if ($Num == 0) {
		
		///Query then redirect
		$query = "INSERT INTO users (group_id, first_name, surname, login, password) VALUES ({$Group_ID},'{$First_Name}','{$Surname}','{$User}','{$Pass}')";
                $result = mysqli_query($connection, $query)
                    or die ('Error: '.mysql_error());  
		
		redirect_to('index.php');
		
	} else{
		$Message = "Please fill in all fields!";
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
        <?php include 'templates/header imports.php';?>
    </head>

<body role='document'>
        <?php include 'templates/template header.php';?>
        <?php echo $Message?>

        <div id="Sign-Up">
		<fieldset style="width: 30%">
			<legend>Registration Form</legend>
			<table border="0">
				<tr>
					<form method="post" action="registration.php">
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