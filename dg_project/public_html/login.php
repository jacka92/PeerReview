/* For login:  if($_POST['name'] && $_POST['pass']){
                $username = mysql_real_escape_string($_POST['user']);
                $pass = mysql_real_escape_string(hash("sha512", $_POST['pass']));
                $user = //SQL query: SELET * FROM users WHERE 'username'=  '$username'
                if($user == '0'){
                    die("That user doesn't exist! <a href='registration.php')>&larr; Back</a>");
                }

                if($user['pass']!=$pass){
                    die("Incorrect password <a href='registration.php')>&larr; Back</a>");
                }
                $salt = hash("sha512", rand().rand().rand());
                setcookie("c_user", hash("sha512", $username), time() +24*60*60,"/");
                    
                $userID = $user['ID'];
                ///Update the salt value for the user with the generated salt code
                mysql_query("UPDATE 'users' SET 'Salt'='$salt' WHERE 'ID'='$userID'");
                die("ou are now logged in as $Username :)");
            }

            ///Before html of table
            include "login_check.php";

            if($logged == true){
            die("You are already logged in.")
        }







            */