<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
    include 'queries.php';

    $q  = users();
    $check = mysqli_query($connection, $q);
    confirm_query($check);

    while($users = mysqli_fetch_assoc($check)){
        $update = isset($_POST['update']) ? $_POST['update'] : '';
        if ($update == $users['user_id']) {
            $First_Name = isset($_POST ['name'.$users['user_id']]) ? $_POST ['name'.$users['user_id']] : '';
            $First_Name = ($First_Name == '') ? $users['first_name'] : $First_Name;

            $Surname = isset($_POST ['surname'.$users['user_id']]) ? $_POST ['surname'.$users['user_id']] : '';
            $Surname = ($Surname == '') ? $users['surname'] : $Surname;

            $Admin = (isset($_POST['admin'.$users['user_id']]) ? $_POST['admin'.$users['user_id']] : '');
            $Admin = ($Admin == '') ? $users['admin'] : $Admin;
            
            $Group = (isset($_POST['group'.$users['user_id']]) ? $_POST['group'.$users['user_id']] : '');
            $Group = ($Group == '') ? $users['group_id'] : $Group;
            
            $q2  = update_user($First_Name,$Surname,$Admin,$Group,$users['user_id']);
            $check2 = mysqli_query($connection, $q2)
                    or die ('Error: insert failed'.mysql_error());  

        } 
        $delete = isset($_POST['delete']) ? $_POST['delete'] : "";
        if ($delete == $users["user_id"]){
            $qdrop = delete_user($users['user_id']);
            $drop = mysqli_query($connection, $qdrop)
                    or die ('Error: insert failed'.mysql_error());
        }

    }

    redirect_to('../admin.php');
?>