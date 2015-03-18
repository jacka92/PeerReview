<?php
require_once 'templates/db_connection.php';
include 'templates/imports.php';
include 'templates/template_header.php';


$target_dir = "Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$XMLFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "" . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
// Check if file already exists
/*if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($XMLFileType != "xml" ) {
    echo "Sorry, only xml files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//simplexml load xml file
$library =  simplexml_load_file("C:/xampp/htdocs/peer_review/Uploads/test.xml");

echo "xml loaded<br/><br/>";

//loop through parsed xmlfeed and print output

foreach ($library->message as $message) {
	printf("project_ID: %s\n", $project_ID->project_ID);
}

echo "xml parsed<br/><br/>";

//insert into databse
$query = ("INSERT INTO reports (group_id, report_text) VALUES ({$_SESSION['group_id']}, '{$library}')")
or die(mysql_error());


echo "inserted into mysql<br/><br/>";

//show updated records
printf ("Records inserted: %d\n", mysql_affected_rows());



//close connection
mysql_close($con2);
echo " <br /> Finished "
?>

?>
