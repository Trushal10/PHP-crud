<?php
    include 'connection.php';


    $row=[];
    if(!empty($_GET['editid'])) {
        $id = $_GET['editid'];
        $sql = "SELECT * FROM `movies` WHERE `id` = '$id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);


        if($row['genre']) {
            $row['genre'] = !empty($row['genre']) ? explode(",", $row['genre']) : '';
        }
    }




?>

