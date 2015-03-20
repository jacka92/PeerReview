<?php
// admin.php ----------------------------------------
	function user(){
		$query  = "SELECT * ";
        $query .= "FROM users ";
        $query .= "WHERE user_id = {$_SESSION['user_id']} ";
        return $query;
	}

// edit_user.php ----------------------------------------
	function update_user($Login,$First_Name,$Surname){
		$query  = "UPDATE users ";
        $query .= "SET login='{$Login}', first_name='{$First_Name}', surname='{$Surname}' ";
        $query .= "WHERE user_id = {$_SESSION['user_id']} ";
        return $query;
    }
    function check_login($Login){
        $query  = "SELECT * ";
        $query .= "FROM users ";
        $query .= "WHERE login = '{$Login}' ";
        $query .= "AND user_id <> {$_SESSION['user_id']} ";
        return $query;
    }
?>