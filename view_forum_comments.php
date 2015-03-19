<?php require_once 'templates/db_connection.php'; ?>
<html>
    <head>
		<?php 
			include 'templates/imports.php';
			include 'forum/queries.php';
		?>
		<?php
		    $query = posts();
		    $check = mysqli_query($connection, $query);
		    confirm_query($check);
		?>
<?php
    while($posts = mysqli_fetch_assoc($check)) {
        $update = isset($_POST['view']) ? $_POST['view'] : '';
        if ($update == $posts["post_id"]) {
?>

        <title><?php echo $posts['post_title'] ?></title>
    </head>
    <body role='document'>
        <?php include 'templates/template_header.php' ?>
		<div class="row">
        	<div class="page-header">
	            <h1>Forum post: <?php echo $posts["post_title"]; ?></h1>
	            <h4 style="font-style: italic;">Post originally created: <?php echo $posts["post_date"]; ?></h4>
	        </div>
        </div>

		<div class="row">
	        <div>
	        	<p><?php echo $posts["post_content"]; ?></p>
	        </div>
	    </div>
	    <div><br></div>
        <div class="row">
        	<div class="col-sm-8">
	        	<div class="panel panel-default">
					<div class="panel-heading">
					  	<h3 class="panel-title">Comments</h3>
					</div>
					<div class="panel-body">

						<?php
					        $query = comments($posts['post_id']);
					        $result = mysqli_query($connection, $query);
					        confirm_query($result);
					    ?>
					    <?php
					        while($comments = mysqli_fetch_assoc($result)){
					    ?>
						    <div class="row" style="margin-left: 10px;">
						        <div class="page-header">
						            <h3 style="font-weight: bold;"><?php echo $comments["comment_title"]; ?></h3>
						            <h4 style="font-style: italic;"><?php echo $comments["comment_date"]; ?></h4>
						        </div>
						        <div>
						        	<p><?php echo $comments["comment_content"]; ?></p>
						        </div>
						    </div>
						    <div><br></div>
					    <?php
					        }
					    ?>

					</div>
				</div>
			</div>
        </div>

		<div class="row">
            <div class="col-md-8">
            	<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Create a new comment
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tbody>
                            	<form method="post" action="forum/add_comment.php">
    								<input type="text" name="post_id" class="data" value=<?php echo $posts['post_id']; ?> placeholder="Enter the post title ...">
                                	<tr>
    									<td>Comment title</td>
    									<td><input type="text" name="title"></td>
    								</tr>
    								<tr>
    									<td>Comment content</td>
    									<td><textarea name="content" rows="4" cols="50" placeholder="Enter the comment text here..."></textarea></td>
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
        }
    }
?>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php mysqli_close($connection); ?>