<?php
include "connection.php";


    $id = [];
    if(!empty($_GET["deleteid"])) {
        $id = $_GET["deleteid"];
        $sql = "DELETE FROM movies WHERE id=$id";
        $result = mysqli_query($con, $sql);

        if($result) {
            echo header("location:index.php");
        } else {
            echo "Error deleting record: ";
        }
    }


?>