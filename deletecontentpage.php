<?php

    include("session.php");
    include("conn.php");

    $page_id = (int) $_GET['sid'];

    mysqli_query(
        $conn,
        "DELETE FROM $tablecontentpage WHERE page_id='$page_id'"
    );

    $_SESSION['status'] = "Content Page Successfully Deleted!";

    header('location:admindashboard.php');

?>