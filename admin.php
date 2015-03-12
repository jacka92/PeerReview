<?php
    require_once 'templates/db_connection.php';
    include 'admin/functions.php';
?>

<html>
    <head>
        <title>Admin page</title>
        <?php include 'templates/imports.php';?>
    </head>

    <body role='document'>
        <?php include 'templates/template_header.php';?>

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
                        Make a user an Admin
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>User ID</td>
                                <td>Username</td>
                                <td>First Name</td>
                                <td>Surname</td>
                                <td>Admin/User</td>
                                <td>Current Group ID</td>
                                <td>New Group ID</td>
                                <td>Remove User</td>
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
                                        <?php echo $users["user_id"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $users["login"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $users["first_name"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $users["surname"]; ?>
                                    </td>
                                    <td>
                                        <?php if ($users["admin"] == 0) {
                                            echo "User";
                                        } else {
                                            echo "Admin";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $users["group_id"]; ?>
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        To be inputted
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
the administrator-user interface will support searching for details of a particular student and browsing of
student details
            -->


            
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


