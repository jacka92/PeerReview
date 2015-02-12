<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
    $connection = mysqli_connect('localhost','user','datacunts4lyf','peer_assessment')
        or die('Error: '.mysql_error());
    $query = "SELECT * FROM assessments";
    $result = mysqli_query($connection, $query)
        or die ('Error: '.mysql_error());
    while($row = mysqli_fetch_row($result)){
        var_dump($row);
        echo $row;
    }    
?>




<html>

    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='css/bootstrap.min.css' rel='stylesheet'>
    </head>
        <body>
            <h1>Bullshit fucking database</h1>
            <h2>These are the pieces of shits involved in this stupid application</h2>
            <p>Pejhmon asshole Kamaie</p>
            <p>Jack weak-as-fuck Armstrong</p>
            <p>Samuel name-complex Partridge</p>
        </body>
</html>

<?php
    mysqli_close($connection);
?>