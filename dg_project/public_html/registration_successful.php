<?php 
	$connection = mysqli_connect('localhost','root','','peer_assessment')
    or die('Error: '.mysql_error());

    		$First_Name = $_POST['name'];
            $Surname = $_POST['surname'];
            $Group_ID = $_POST['group_id'];
            $User = $_POST['user'];
            $Pass = $_POST['pass'];
            $CPass = $_POST['cpass'];

if ( (isset($_POST["name"])) and (isset($_POST["name"])) and(isset($_POST["name"])) and (isset($_POST["name"])) 
	and (isset($_POST["name"])) and (isset($_POST["name"])) and (isset($_POST["name"])) and ($Pass == $CPass)){
	
	$query = "INSERT INTO users (group_id, first_name, surname, login, password) VALUES ({$Group_ID},'{$First_Name}','{$Surname}','{$User}','{$Pass}')";
                $result = mysqli_query($connection, $query)
                    or die ('Error: '.mysql_error());  
} else {
	$Name = "";
}
if (isset($_POST["group_id"])){
	$Group_ID = $_POST["group_id"];
}

 

 			

 

echo "Hi, {$First_Name} , your Group ID is {$Group_ID}";

?>