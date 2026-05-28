<?php

    include("session.php");
    include("conn.php");

    $content_id = (int) $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM $tablecontent WHERE content_id='$content_id'"
    );

    $_SESSION['status'] = "Content Successfully Deleted!";

    header('location:admincontent.php');

?>