<?php require_once 'templates/db_connection.php'; ?>
<?php include 'admin/queries.php'; ?>

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
                                $query  = users();
                                $result = mysqli_query($connection, $query);
                                confirm_query($result);
                            ?>
                            <?php
                                while($users = mysqli_fetch_assoc($result)){
                            ?>
                                <form method="post" action="admin/edit_user.php">

                                    <tr>
                                        <td><?php echo $users["user_id"]; ?></td>
                                        <td><?php echo $users["login"]; ?></td>
                                        <td><?php echo $users["first_name"]; ?></td>
                                        <td><input type="text" name=<?php echo 'name'.$users['user_id'] ?>></td>
                                        <td><?php echo $users["surname"]; ?></td>
                                        <td><input type="text" name=<?php echo "surname".$users['user_id'] ?>></td>
                                        <td>
                                            <?php 
                                                if ($users["admin"] == 0) {
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
                                        <td><?php echo $users["group_id"]; ?></td>
                                        <td>
                                            <select name=<?php echo "group".$users["user_id"]; ?>>
                                                <?php
                                                    $query  = groups();
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
the administrator-user interface will allow particular groups to be allocated to the peer assessment of
particular other groups
            -->
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Assign reports to groups for marking
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Group ID</td>
                                    <th>This Group's Reports</td>
                                    <th>Currently Assigned Reports</td>
                                    <th>Reports to be assigned</td>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query  = groups();
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
                                                    $query  = report_owned($group["group_id"]);
                                                    $result_owned = mysqli_query($connection, $query);
                                                    confirm_query($result_owned);
                                                ?>
                                                <?php
                                                    while($reports_owned = mysqli_fetch_assoc($result_owned)){
                                                        echo $reports_owned["report_id"]." ";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $query  = report_assigned($group["group_id"]);
                                                    $result_assigned = mysqli_query($connection, $query);
                                                    confirm_query($result_assigned);
                                                ?>
                                                <?php
                                                    while($reports_assigned = mysqli_fetch_assoc($result_assigned)){
                                                        echo $reports_assigned["report_id"]." ";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <select name=<?php echo "report".$group['group_id']; ?>[] size=6 multiple>
                                                    <?php
                                                        $query  = report_available($group["group_id"]);
                                                        $result_available = mysqli_query($connection, $query);
                                                        confirm_query($result_available);
                                                    ?>
                                                    <option value=""></option>
                                                    <?php
                                                        while($report_list = mysqli_fetch_assoc($result_available)){
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
                        $query_group  = groups();
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
        </div>
        <div class="row">
            <!--
the administrator-user interface will support searching for details of a particular student and browsing of
student details

make drop down list of all usesr_id / username, select, show
            -->
            
        </div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>
