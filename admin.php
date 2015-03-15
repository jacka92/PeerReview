<?php require_once 'templates/db_connection.php'; ?>

<html>
    <head>
        <title>Admin page</title>
        <?php include 'templates/imports.php';?>
    </head>

<?php
    $q  = "SELECT * ";
    $q .= "FROM users ";
    $q .= "ORDER BY user_id ASC ";
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
            
            $q2  = "UPDATE users ";
            $q2 .= "SET first_name='{$First_Name}', surname='{$Surname}', ";
            $q2 .= "admin={$Admin}, group_id={$Group} ";
            $q2 .= "WHERE user_id={$users['user_id']}";
            $check2 = mysqli_query($connection, $q2)
                    or die ('Error: insert failed'.mysql_error());  

        } 
        $delete = isset($_POST['delete']) ? $_POST['delete'] : "";
        if ($delete == $users["user_id"]){
            $qdrop = "DELETE FROM users WHERE user_id = {$users['user_id']}";
            $drop = mysqli_query($connection, $qdrop)
                    or die ('Error: insert failed'.mysql_error());
        }

    }
?>


    <body role='document'>

        <?php include 'templates/template_header.php' ?>

        <div class="page-header">
            <h1>Admin Page</h1>
        </div>

        <div class="row">
            <!--
administrator-users will have a separate interface through which student registration will be managed and
groups defined from the student registration list
            -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Change user details
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th colspan="2">First Name</th>
                                <th colspan="2">Surname</th>
                                <th colspan="2">Admin/User</th>
                                <th colspan="2">Group ID</th>
                                <th>Update</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query  = "SELECT * ";
                                $query .= "FROM users ";
                                $query .= "ORDER BY user_id ASC ";
                                $result = mysqli_query($connection, $query);
                                confirm_query($result);
                            ?>
                            <?php
                                while($users = mysqli_fetch_assoc($result)){
                            ?>
                                <form method="post" action="admin.php">

                                    <tr id=<?php echo $users["user_id"]; ?>>
                                        <td>
                                            <?php echo $users["user_id"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $users["login"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $users["first_name"]; ?>
                                        </td>
                                        <td><input type="text" name=<?php echo 'name'.$users['user_id'] ?>></td>
                                        <td>
                                            <?php echo $users["surname"]; ?>
                                        </td>
                                        <td><input type="text" name=<?php echo "surname".$users['user_id'] ?>></td>
                                        <td>
                                            <?php if ($users["admin"] == 0) {
                                                echo "User";
                                            } else {
                                                echo "Admin";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <select name=<?php echo "admin".$users["user_id"]; ?>>
                                                <option value=""></option>
                                                <option value="0">User</option>
                                                <option value="1">Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php echo $users["group_id"]; ?>
                                        </td>
                                        <td>
                                            <select name=<?php echo "group".$users["user_id"]; ?>>
                                                <?php
                                                    $query  = "SELECT DISTINCT group_id ";
                                                    $query .= "FROM users ";
                                                    $query .= "ORDER BY group_id ASC ";
                                                    $result2 = mysqli_query($connection, $query);
                                                    confirm_query($result2);
                                                ?>
                                                <option value=""></option>
                                                <?php
                                                    while($groups = mysqli_fetch_assoc($result2)){
                                                ?>
                                                    <option value=<?php echo $groups["group_id"] ?>>
                                                        <?php echo $groups["group_id"] ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <button name="update" value=<?php echo $users["user_id"]; ?> class="btn btn-primary">Update</button>
                                        </td>
                                        <td>
                                            <button name="delete" value=<?php echo $users["user_id"]; ?> class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </form>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="row">
            <!--
the administrator-user interface will support searching for details of a particular student and browsing of
student details
            -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Assign groups to reports
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Group ID</td>
                                <td>Currently Assigned Reports</td>
                                <td>Reports to be assigned</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query  = "SELECT * ";
                                $query .= "FROM users ";
                                $query .= "WHERE admin = 0 ";
                                $query .= "ORDER BY user_id ASC ";
                                $result = mysqli_query($connection, $query);
                                confirm_query($result);
                            ?>
                            <?php
                                while($users = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td>
                                        To be inputted
                                    </td>
                                    <td>
                                        To be inputted
                                    </td>
                                    <td>
                                        <select multiple>
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="opel">Opel</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>

        <div class="row">
            <!--
the administrator-user interface will allow particular groups to be allocated to the peer assessment of
particular other groups
            -->
            
        </div>

        <div class="row">
            <!--
the administrator-users will be able to see a list of the groups ranked according with the aggregation of peer
assessments on their submissions
            -->
            
        </div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>


