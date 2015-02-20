<!DOCTYPE html>
<html>
<?php 
	$connection = mysqli_connect('localhost','root','','peer_assessment')
    or die('Error: '.mysql_error());

    		$First_Name = $_POST['name'];
            $Surname = $_POST['surname'];
            $Group_ID = $_POST['group_id'];
            $User = $_POST['user'];
            $Pass = $_POST['pass'];
            $CPass = $_POST['cpass'];

if ( (isset($_POST["name"])) and (isset($_POST["surname"])) and(isset($_POST["group_id"])) and (isset($_POST["user"])) 
	and (isset($_POST["pass"])) and (isset($_POST["cpass"])) and ($Pass == $CPass)){
	
	$query = "INSERT INTO users (group_id, first_name, surname, login, password) VALUES ({$Group_ID},'{$First_Name}','{$Surname}','{$User}','{$Pass}')";
                $result = mysqli_query($connection, $query)
                    or die ('Error: '.mysql_error());  


echo "Hi, {$First_Name} , your Group ID is {$Group_ID}";
                    
} else {
	echo "Invalid input, please re-enter";
}







?>

<a href = "registration.php">Register account</a>
</html>