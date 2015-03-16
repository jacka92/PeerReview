<?php require_once 'templates/db_connection.php'; ?>

<html>
    <head>
        <title>Forum</title>
        <?php include 'templates/imports.php'; ?>
    </head>

    <body role='document'>

        <?php include 'templates/template_header.php' ?>

        <div class="row">
	        <div class="page-header">
	            <h1>Forum</h1>
	        </div>
        </div>

        <?php
	        $query  = "SELECT * ";
	        $query .= "FROM forum ";
	        $query .= "ORDER BY post_id DESC ";
	        $result = mysqli_query($connection, $query);
	        confirm_query($result);
	    ?>
	    <?php
	        while($posts = mysqli_fetch_assoc($result)){
	    ?>
		    <div class="row">
		        <div class="page-header">
		            <h3 style="font-weight: bold;"><?php echo $posts["post_title"]; ?></h3>
		            <h4 style="font-style: italic;"><?php echo $posts["post_date"]; ?></h4>
		        </div>
		        <div>
		        	<p><?php echo $posts["post_content"]; ?></p>
		        </div>
		    </div>
	    <?php
	        }
	    ?>

	    <div class="row"><br></div>

	    <div class="row">
            <!--
administrator-users will have a separate interface through which student registration will be managed and
groups defined from the student registration list
            -->

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
									<td><input type="text" name="title"></td>
								</tr>
								<tr>
									<td>Forum post content</td>
									<td><textarea name="content" rows="4" cols="50" placeholder="Enter the forum post text here..."></textarea></td>
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

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php mysqli_close($connection); ?>