<?php require_once 'templates/db_connection.php'; ?>

<html>
    <head>
        <title>Forum</title>
        <?php include 'templates/imports.php'; ?>
        <?php include 'forum/queries.php'; ?>
    </head>

    <body role='document'>

        <?php
            include 'templates/template_header.php';
        ?>

        <div class='row'>
            <div class='alert alert-warning' role='alert'>
                The user you searched for has multiple threads. Please select one.
            </div>
        </div>

        <div class="row">
        	<div class="page-header">
	            <h1>Forum Search Results</h1>
	        </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Choose one of the following threads by this user ...
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                        <?php
                            $user = isset($_POST['view']) ? $_POST['view'] : '';
                            $q = user_threads($user);
                            $check = mysqli_query($connection, $q)
                                    or die ('Error: insert failed'.mysql_error());  
                            confirm_query($check);
                            while($posts = mysqli_fetch_assoc($check)){
                        ?>
                            
                            <tr>
                                <form method="post" action="forum_comments.php">
                                    <td>
                                        <h3>
                                            <?php echo $posts["post_title"]; ?>
                                        </h3>
                                    </td>
                                    <td>
                                        <button name="view" value=<?php echo $posts["post_id"]?> class="btn btn-primary">
                                            View Comments
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        <?php
                            }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php mysqli_close($connection); ?>