<?php

    include("session.php");
    include("conn.php");

    $watch_id = (int) $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM $tablewatch WHERE watch_id='$watch_id'"
    );

    $_SESSION['status'] = "Watch Video Successfully Deleted!";

    header('location:adminwatch.php');

?>