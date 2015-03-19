<?php require_once 'templates/db_connection.php'; ?>

<html>
	<head>
		<title>Assessor Marks</title>
        <?php include 'templates/imports.php';?>
    </head>

<body role='document'>

        <?php include 'templates/template_header.php' ?>

        <div class="page-header">
		<h1>Assessor marks</h1>
		<p>Shown below are the assessments given to the assessors assigned to provide marks on your report.</p>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"></h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Group ID</th>
							<th>Assessment Mark</th>
						</tr>
					</thead>
					<tbody>
                            <?php
                                $GroupID = $_SESSION['group_id'];
                                //QUery to select user's report id
                                $query = "SELECT report_id FROM reports WHERE group_id = {$GroupID}";
                                $result = mysqli_query($connection, $query)or die("Report ID slection failed.");
                                confirm_query($result);
                            ?>
                            <?php
                            	//Assign user's report id to a var
                                while($row = mysqli_fetch_assoc($result)){
                                	$ReportID = $row["report_id"];}
                    
                                	//Query to find marks given to assessor's group
                                	
                                	$query2 = 	"SELECT t1.* FROM assessments t1, assignments t2, users t4 
                                				WHERE (t2.report_id = {$ReportID}) 
                                				AND (t4.group_id = t2.group_id) 
                                				AND (t4.user_id = t1.user_id)";
                                
                    
                                $result2 = mysqli_query($connection, $query2)or die("Query to find marks of assessors failed");
                                confirm_query($result2);
                                while($row = mysqli_fetch_assoc($result2)){
                                	
                            ?>
                
							<tr>
								<td>
                                            <?php echo $row["group_id"]; ?>
                                        </td>
								<td>
                                            <?php echo $row["assessment"];} ?>
                                        </td>
                                        
							</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
        <?php include 'templates/template footer.php';?>
        <?php
    mysqli_close($connection);
?>
        </body>
</html>

