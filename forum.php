<?php require_once 'templates/db_connection.php'; ?>

<?php
    $Message = "";
    if($_SESSION['check']===1){
        $Message = "
                <div class='row'>
                    <div class='alert alert-success' role='alert'>
                        <strong>Success!</strong> Your post is now live.
                    </div>
                </div>";
    }else{

    }
    $_SESSION['check'] = 0;
?>

<html>
    <head>
        <title>Forum</title>
        <?php include 'templates/imports.php'; ?>
        <?php include 'forum/queries.php'; ?>
    </head>

    <body role='document'>

        <?php
            include 'templates/template_header.php';
            echo $Message;
        ?>

        <div class="row">
        	<div class="page-header">
	            <h1>Forum</h1>
	        </div>
            <h3>Please either search for a thread, or scroll down to see all threads sorted by the date they were posted.
                <br>You may create a thread of the right.
            </h3>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Search for a thread. Choose an option to search by ...
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <form method="post" action="forum/search_user_drop.php">
                                        <td>Username:</td>
                                        <td>
                                            <select name="user_drop">
                                                <?php
                                                    $query  = search_users();
                                                    $result = mysqli_query($connection, $query);
                                                    confirm_query($result);
                                                ?>
                                                <option value=""></option>
                                                <?php
                                                    while($users = mysqli_fetch_assoc($result)){
                                                ?>
                                                    <option value=<?php echo $users["login"]; ?>>
                                                        <?php echo $users["login"]; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td><button name="search_user_drop" class="btn btn-primary">Search</button></td>
                                    </form>
                                </tr>
                                <tr>
                                    <form method="post" action="forum/search_thread_drop.php">
                                        <td>Thread name:</td>
                                        <td>
                                            <select name="thread_drop">
                                                <?php
                                                    $query  = search_threads();
                                                    $result = mysqli_query($connection, $query);
                                                    confirm_query($result);
                                                ?>
                                                <option value=""></option>
                                                <?php
                                                    while($threads = mysqli_fetch_assoc($result)){
                                                ?>
                                                    <option value=<?php echo $threads["post_title"]; ?>>
                                                        <?php echo $threads["post_title"]; ?>
                                                    </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td><button name="search_thread_drop" class="btn btn-primary">Search</button></td>
                                    </form>
                                </tr>
                                <tr>
                                    <th colspan="3">Alternatively, you could type in the search terms</th>
                                </tr>
                                <tr>
                                    <form method="post" action="forum/search_user.php">
                                        <td>Username:</td>
                                        <td>
                                            <input type="text" name='user_text' placeholder="Enter the username...">
                                        </td>
                                        <td><button name="search_user" class="btn btn-primary">Search</button></td>
                                    </form>
                                </tr>
                                <tr>
                                    <form method="post" action="forum/search_thread.php">
                                        <td>Thread name:</td>
                                        <td>
                                            <input type="text" name='thread_text' placeholder="Enter the thread title...">
                                        </td>
                                        <td><button name="search_thread" class="btn btn-primary">Search</button></td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Create a new Forum post
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                                <form method="post" action="forum/add_post.php">
                                    <tr>
                                        <td>Forum post title</td>
                                        <td><input type="text" name="title" placeholder="Enter the post title ..."></td>
                                    </tr>
                                    <tr>
                                        <td>Forum post content</td>
                                        <td><textarea name="content" rows="4" cols="50" placeholder="Enter the forum post text ..."></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button name="create" class="btn btn-primary">Create</button>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
	        $query = posts();
	        $result = mysqli_query($connection, $query);
	        confirm_query($result);
	    ?>
	    <?php
	        while($posts = mysqli_fetch_assoc($result)){
	    ?>
		    <div class="row">
				<form method="post" action="view_forum_comments.php">
			        <div class="page-header">
			            <h3 style="font-weight: bold;"><?php echo $posts["post_title"]; ?></h3>
			            <h4 style="font-style: italic;">
                            <strong>
                                Thread posted by 
                                <?php
                                    $q = poster_name($posts['user_id']);
                                    $result2 = mysqli_query($connection, $q);
                                    confirm_query($result2);
                                    while($poster = mysqli_fetch_assoc($result2)){
                                        echo $poster['login'];
                                    }
                                ?>
                            </strong>
                            <br>Date posted: <?php echo $posts["post_date"]; ?>
                        </h4>
			        </div>
			        <div>
			        	<p><?php echo $posts["post_content"]; ?></p>
			        </div>
			        <div>
			        	<button name="view" value=<?php echo $posts["post_id"]?> class="btn btn-primary">View Comments</button>
			        </div>
		        </form>
		    </div>
		    <div><br></div>
	    <?php
	        }
	    ?>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php mysqli_close($connection); ?>