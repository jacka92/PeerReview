<?php require_once 'templates/db_connection.php'; ?>

<html>
    <head>
        <title>Admin page</title>
        <?php include 'templates/imports.php';?>
        <?php
            if ($_SESSION['admin']!=1){
                redirect_to('dashboard.php');
            }
        ?>
    </head>

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
                    <table class="table table-hover">
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
                                <form method="post" action="admin/edit_user.php">

                                    <tr>
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
                                                    $query .= "FROM groups ";
                                                    $query .= "ORDER BY group_id ASC ";
                                                    $result2 = mysqli_query($connection, $query);
                                                    confirm_query($result2);
                                                ?>
                                                <option value=""></option>
                                                <?php
                                                    while($groups = mysqli_fetch_assoc($result2)){
                                                ?>
                                                    <option value=<?php echo $groups["group_id"]; ?>>
                                                        <?php echo $groups["group_id"]; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <button name="update" value=<?php echo $users["user_id"]; ?> class="btn btn-primary">
                                                Update
                                            </button>
                                        </td>
                                        <td>
                                            <button name="delete" value=<?php echo $users["user_id"]; ?> class="btn btn-danger">
                                                Delete
                                            </button>
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
the administrator-users will be able to see a list of the groups */
ranked according with the aggregation of peer assessments on their submissions 
            -->
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Create a group
                        </h3>
                    </div>
                    <?php
                        $query_group  = "SELECT DISTINCT group_id ";
                        $query_group .= "FROM groups ";
                        $query_group .= "ORDER BY group_id ASC ";
                        $result_group = mysqli_query($connection, $query_group);
                        confirm_query($result_group);
                    ?>
                    <div class="panel-body">
                        <p>Current groups: 
                            <?php
                                while($group = mysqli_fetch_assoc($result_group)){
                                    echo $group["group_id"]." ";
                                }
                            ?>
                        </p>
                        <form method="post" action="admin/add_group.php">
                            <button name="create_group" class="btn btn-primary">Create new group</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--
the administrator-user interface will allow particular groups to be allocated to the peer assessment of
particular other groups
            -->
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Assign groups to reports
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Group ID</td>
                                    <th>Currently Assigned Reports</td>
                                    <th>Reports to be assigned</td>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query  = "SELECT DISTINCT group_id ";
                                    $query .= "FROM groups ";
                                    $query .= "ORDER BY group_id ASC ";
                                    $result = mysqli_query($connection, $query);
                                    confirm_query($result);
                                ?>
                                <?php
                                    while($group = mysqli_fetch_assoc($result)){
                                ?>
                                    <form method="get" action="admin/assign_report.php">
                                        <tr>
                                            <td><?php echo $group["group_id"]; ?></td>
                                            <td>
                                                <?php
                                                    $query  = "SELECT DISTINCT report_id ";
                                                    $query .= "FROM assignments ";
                                                    $query .= "WHERE group_id=".$group["group_id"]." ";
                                                    $query .= "ORDER BY report_id ASC ";
                                                    $result2 = mysqli_query($connection, $query);
                                                    confirm_query($result2);
                                                ?>
                                                <?php
                                                    while($reports = mysqli_fetch_assoc($result2)){
                                                        echo $reports["report_id"]." ";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <select name=<?php echo "report".$group['group_id']; ?>[] size=6 multiple>
                                                    <?php
                                                        $query  = "SELECT DISTINCT report_id ";
                                                        $query .= "FROM reports ";
                                                        $query .= "WHERE group_id <> ".$group['group_id']." ";
                                                        $query .= "ORDER BY report_id ASC ";
                                                        $result3 = mysqli_query($connection, $query);
                                                        confirm_query($result3);
                                                    ?>
                                                    <option value=""></option>
                                                    <?php
                                                        while($report_list = mysqli_fetch_assoc($result3)){
                                                    ?>
                                                        <option value=<?php echo $report_list["report_id"]; ?>>
                                                            <?php echo $report_list["report_id"]; ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button name="update" value=<?php echo $group["group_id"]; ?> class="btn btn-primary">
                                                    Update
                                                </button>
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
        </div>
        <div class="row">
            <!--

the administrator-user interface will support searching for details of a particular student and browsing of
student details
            -->
            
        </div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>
