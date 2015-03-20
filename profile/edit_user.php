<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
    include 'queries.php';

    $q  = user();
    $check = mysqli_query($connection, $q);
    confirm_query($check);

    while($users = mysqli_fetch_assoc($check)){
        $Login = isset($_POST ['login']) ? $_POST ['login'] : '';
        $Login = mysqli_real_escape_string($connection,(($Login == '') ? $users['login'] : $Login));

        $First_Name = isset($_POST ['name']) ? $_POST ['name'] : '';
        $First_Name = mysqli_real_escape_string($connection,(($First_Name == '') ? $users['first_name'] : $First_Name));

        $Surname = isset($_POST ['surname']) ? $_POST ['surname'] : '';
        $Surname = mysqli_real_escape_string($connection,(($Surname == '') ? $users['surname'] : $Surname));

        echo $Login;
        echo $First_Name;
        echo $Surname;

        $sql = check_login($Login);
        $check = mysqli_query($connection, $sql) or die("Query to check if username exists failed");
        confirm_query($check);

        if(!null == (mysqli_fetch_assoc($check))){
            $_SESSION ['check'] = 2;
        }else{
            $q  = update_user($Login,$First_Name,$Surname);
            $check = mysqli_query($connection, $q)
                or die ('Error: insert failed'.mysql_error());
            $_SESSION ['check'] = 1;
        }
    }

    redirect_to('../profile.php');
?>