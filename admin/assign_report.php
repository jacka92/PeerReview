<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
    include 'queries.php';

    $q  = groups();
    $check = mysqli_query($connection, $q);
    confirm_query($check);

    while($groups = mysqli_fetch_assoc($check)){
        $update = isset($_GET['update']) ? $_GET['update'] : '';
        if ($update == $groups['group_id']) {
            
            $Group_ID = mysqli_real_escape_string($connection,$groups['group_id']);
            $q  = report_assigned($Group_ID);
            $reports = mysqli_query($connection, $q);
            confirm_query($check);

            if (count($_GET["report".$groups["group_id"]])==0){

            }else{
                $qdrop = delete_assigned($Group_ID);
                $drop = mysqli_query($connection, $qdrop)
                        or die ('Error: insert failed'.mysql_error());

                $Report_list = isset($_GET["report".$groups["group_id"]]) ? $_GET["report".$groups["group_id"]] : "";
                foreach ($Report_list as $report_output){
                    $Report = mysqli_real_escape_string($connection,$report_output);

                    $q2  = report_assign($Group_ID,$Report);
                    $check2 = mysqli_query($connection, $q2)
                            or die ('Error: insert failed'.mysql_error());
                }
            }
        } 
    }
    redirect_to('../admin.php');
?>