<?php
	require_once 'db_connection.php';
	/*
			Pejh attempting to do something useful. Please keep

	try {
	   $conn = new PDO ( "sqlsrv:server = tcp:hvjcgi9sw1.database.windows.net,1433; Database = peerreview", "peerdataadmin", "datacunts4L!FE");
	       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch ( PDOException $e ) {
	    print( "Error connecting to SQL Server." );
	    die(print_r($e));
	}
	*/

	session_start();
	
	/////Check if user already logged in
?>
<?php

///No blank fields	
$Message = "";
require_once 'included_functions.php';
	if (isset ( $_POST ['submit'] )) {
		$User = $_POST['username'];
		$Pass = $_POST['password'];
		
		
		//If neither field is blank
		if(!empty($User)&& !empty($Pass)){
			
			$hashed_password = password_encrypt($_POST['password']);
			
		
			
 			$query = "SELECT * FROM users WHERE '$User' = login AND '$hashed_password' = password LIMIT 1";
 			$result = mysqli_query($connection, $query)
 			or die ('Error: '.mysql_error());
			
 			//If query produces nothing
 			if(empty($result)){ 	
 				$Message = "Incorrect username and/or password.";
 			}else{
 				while($row = mysqli_fetch_assoc($result)){
 					///TODO Store user id in session as well
 					$_SESSION['first_name'] = $row["first_name"];
 					$_SESSION['group_id'] = $row["group_id"];
 					$_SESSION['user_id'] = $row["user_id"];
 				}
			
 			redirect_to('dashboard.php');
 		}
		
		
		}else{
			$Message = "Fill in all fields";
		}
		
	}
	
	else{
		$User = "";
	}

?>
<!DOCTYPE html>
<html>
	<head>

		<title>Peer Assessment</title>
        <?php include 'templates/imports.php'; ?>

    </head>

<body role='document'>

        <?php
        	include 'templates/template_header.php';
        
        	require_once 'templates/template_header.php';
	        $html_string = header();
	        echo html_string;
	        
        $Message = $User;
        echo $Message
		
        ?>

        <h1>Bullshit fucking database</h1>
	<h2>These are the pieces of shits involved in this stupid application</h2>
	<p>Pejhmon asshole Kamaie</p>
	<p>Jack weak-as-fuck Armstrong</p>
	<p>Samuel name-complex Partridge</p>
	<table width="300" border="0" align="center" cellpadding="0"
		cellspacing="1" bgcolor="#CCCCCC">
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
						<tr>

						</tr>

					</table> <a href="registration.php">Register account</a>
				</td>
			</form>

		</tr>

	</table>
        

        <?php include 'templates/template footer.php';?>
    </body>
</html>
<?php
mysqli_close ( $connection );
?>