<?php
// admin.php ----------------------------------------
	function groups(){
		$query  = "SELECT DISTINCT group_id ";
        $query .= "FROM groups ";
        $query .= "ORDER BY group_id ASC ";
        return $query;
	}
	function users(){
		$query  = "SELECT * ";
        $query .= "FROM users ";
        $query .= "ORDER BY user_id ASC ";
        return $query;
	}
	function report_assigned($group){
		$query  = "SELECT DISTINCT report_id ";
        $query .= "FROM assignments ";
        $query .= "WHERE group_id={$group} ";
        $query .= "ORDER BY report_id ASC ";
        return $query;
	}
	function report_available($group){
		$query  = "SELECT DISTINCT report_id ";
        $query .= "FROM reports ";
        $query .= "WHERE group_id <> {$group} ";
        $query .= "ORDER BY report_id ASC ";
        return $query;
	}

// assign_report.php ----------------------------------------
	function delete_assigned($group){
		$query  = "DELETE FROM assignments ";
        $query .= "WHERE group_id = ".$group;
        return $query;
    }
	function report_assign($group,$report_output){
		$query  = "INSERT INTO assignments (group_id, report_id) ";
        $query .= "VALUES ('{$group}', '{$report_output}')";
        return $query;
	}

// edit_user.php ----------------------------------------
	function update_user($First_Name,$Surname,$Admin,$Group,$User){
		$query  = "UPDATE users ";
        $query .= "SET first_name='{$First_Name}', surname='{$Surname}', ";
        $query .= "admin={$Admin}, group_id={$Group} ";
        $query .= "WHERE user_id={$User}";
        return $query;
    }
	function delete_user($users){
		$query  = "DELETE FROM users ";
        $query .= "WHERE user_id = {$users}";
        return $query;
	}

// add_group.php ----------------------------------------
	function insert_group(){
		$query  = "INSERT INTO groups (group_id) VALUES (NULL)";
        return $query;
    }
?>