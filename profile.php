<?php require_once 'templates/db_connection.php'; ?>
<?php include 'profile/queries.php'; ?>

<?php
    $Message = "";
    if($_SESSION['check']===1){
        $Message = "
                <div class='row'>
                    <div class='alert alert-success' role='alert'>
                        <strong>Success!</strong> Your details have been updated.
                    </div>
                </div>";
    }elseif($_SESSION['check']===2){
        $Message = "
                <div class='row'>
                    <div class='alert alert-danger' role='alert'>
                        <strong>Oh snap!</strong> The username you've tried to take already exists. Please try another.
                    </div>
                </div>";
    }else{

    }
    $_SESSION['check'] = 0;
?>

<html>
    <head>
        <?php include 'templates/imports.php';?>
        <title><?php echo $_SESSION['first_name']."'s "; ?>Profile Page</title>
    </head>

    <body role='document'>

        <?php
            include 'templates/template_header.php';
            echo $Message;
        ?>

        <div class="page-header">
            <h1><?php echo $_SESSION['first_name']."'s "; ?>Profile Page</h1>
        </div>


        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Change your details
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th colspan="2">Username</th>
                                <th colspan="2">First Name</th>
                                <th colspan="2">Surname</th>
                                <th>Group ID</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query  = user();
                                $result = mysqli_query($connection, $query);
                                confirm_query($result);
                            ?>
                            <?php
                                while($users = mysqli_fetch_assoc($result)){
                            ?>
                                <form method="post" action="profile/edit_user.php">
                                    <tr>
                                        <td><?php echo $users["user_id"]; ?></td>
                                        <td><?php echo $users["login"]; ?></td>
                                        <td><input type="text" name='login' placeholder="Enter the first name..."></td>
                                        <td><?php echo $users["first_name"]; ?></td>
                                        <td><input type="text" name='name' placeholder="Enter the first name..."></td>
                                        <td><?php echo $users["surname"]; ?></td>
                                        <td><input type="text" name="surname" placeholder="Enter the surname..."></td>
                                        <td><?php echo $users["group_id"]; ?></td>
                                        <td><button name="update" class="btn btn-primary">Update</button></td>
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

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php mysqli_close($connection); ?>