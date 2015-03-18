<?php
include 'templates/imports_index.php';

session_start();

session_unset();
session_destroy();

echo ("You are now logged out.");

sleep(5);

redirect_to('index.php');

?>