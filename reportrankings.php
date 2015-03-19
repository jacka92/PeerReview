<?php require_once 'templates/db_connection.php'; ?>

<html>
	<head>
		<title>Report Rankings</title>
        <?php include 'templates/imports.php';?>
    </head>

	<body role='document'>
        <?php include 'templates/template_header.php' ?>

        <div class="page-header">
			<h1>Group rankings</h1>
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
								<th>Aggregated Mark</th>
							</tr>
						</thead>
						<tbody>
	                            <?php
	                                $query  = "SELECT AVG(t1.assessment), t2.group_id FROM assessments t1 INNER JOIN reports t2 ON(t1.report_id = t2.report_id) GROUP BY t2.group_id ORDER BY AVG(t1.assessment) DESC";
	                                $result = mysqli_query($connection, $query)or die("didn't connect");
	                                confirm_query($result);

	                                $counter = 1;
	                                $max = mysqli_num_rows($result);
	                                while($row = mysqli_fetch_assoc($result)){
	                            ?>
	                			
	                			<?php
		                				if($counter == 1){
											echo "<tr class='success'>";
		                				}elseif($counter == $max){
		                					echo "<tr class='danger'>";
		                				}else{
		                					echo "<tr>";
		                				}
								?>
									<td><?php echo $row["group_id"]; ?></td>
									<td><?php echo $row["AVG(t1.assessment)"]; ?></td>
								</tr>
								<?php
										$counter ++;
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