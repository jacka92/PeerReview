<?php 

if (isset($_POST["name"])){
	$Name = $_POST["name"];
} else {
	$Name = "";
}
if (isset($_POST["group_id"])){
	$Group_ID = $_POST["group_id"];
}

echo "Hi, {$Name} , your Group ID is {$Group_ID}";

?>