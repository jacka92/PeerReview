<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';

    $q  = "SELECT DISTINCT group_id FROM groups ORDER BY group_id ASC ";
    $check = mysqli_query($connection, $q);
    confirm_query($check);

    while($groups = mysqli_fetch_assoc($check)){
        $update = isset($_GET['update']) ? $_GET['update'] : '';
        if ($update == $groups['group_id']) {
            
            $q  = "SELECT DISTINCT report_id FROM assignments WHERE group_id={$groups['group_id']} ORDER BY report_id ASC";
            $reports = mysqli_query($connection, $q);
            confirm_query($check);

            if (count($_GET["report".$groups["group_id"]])==0){

            }else{
                $qdrop = "DELETE FROM assignments WHERE group_id = {$groups['group_id']}";
                $drop = mysqli_query($connection, $qdrop)
                        or die ('Error: insert failed'.mysql_error());

                $Report_list = isset($_GET["report".$groups["group_id"]]) ? $_GET["report".$groups["group_id"]] : "";
                foreach ($Report_list as $report_output){
                    $Group = $groups['group_id'];
                    echo $Group;

                    $q2  = "INSERT INTO assignments (group_id, report_id) ";
                    $q2 .= "VALUES ('{$Group}', '{$report_output}')";
                    echo $q2;
                    $check2 = mysqli_query($connection, $q2)
                            or die ('Error: insert failed'.mysql_error());
                }
            }
        } 
    }
    redirect_to('../admin.php');
?>