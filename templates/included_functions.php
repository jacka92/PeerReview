<?php
	function redirect_to($new_location){
		header("Location: ". $new_location);
		exit;
	}

	function password_encrypt($password){
		$password = sha1('hqb%$t'.$password.'cg*l');
		return $password;
		
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed!");
		}
	}
?>