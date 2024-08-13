<?php

$sever = "localhost";
$user = "root";
$password = "";
$dbname = "movie";

$con = new mysqli($sever, $user, $password, $dbname);

if ($con->connect_error) {
    echo "Connection failed: " . $con->connect_error;
}
?>