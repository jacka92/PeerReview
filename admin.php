<?php
    require_once 'templates/db_connection.php';
?>

<html>
    <head>
        <title>Admin page</title>
        <?php include 'templates/imports.php';?>
    </head>

    <body role='document'>
        <?php include 'templates/template_header.php';?>

        <div class="row">
            <!--
administrator-users will have a separate interface through which student registration will be managed and
groups defined from the student registration list
            -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Username : </td>
                                <td><input name="username" type="text" id="username" value=<?php echo htmlentities($User); ?>></td>
                            </tr>
                            <tr>
                                <td>Password : </td>
                                <td><input name="password" type="password" id="password"></td>
                            </tr>
                            <tr>
                                <td colspan = "3"><input type="submit" name="submit" value="Login"></td>
                            </tr>
                            <tr>
                                <td colspan = "3"><a href="registration.php">Register account</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="row">
            <!--
the administrator-user interface will support searching for details of a particular student and browsing of
student details
            -->
            
        </div>

        <div class="row">
            <!--
the administrator-user interface will allow particular groups to be allocated to the peer assessment of
particular other groups
            -->
            
        </div>

        <div class="row">
            <!--
the administrator-users will be able to see a list of the groups ranked according with the aggregation of peer
assessments on their submissions
            -->
            
        </div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>


