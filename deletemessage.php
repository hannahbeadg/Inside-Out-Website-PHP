<?php

    include("session.php");
    include("conn.php");

    $message_id = (int) $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM $tablemessages WHERE message_id='$message_id'"
    );

    $_SESSION['status'] = "Message Successfully Deleted!";

    header('location:adminmessages.php');

?>