<?php

    include("session.php");
    include("conn.php");

    $emotion_id = (int) $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM $tableemotions WHERE emotion_id='$emotion_id'"
    );

    $_SESSION['status'] = "Emotion Successfully Deleted!";

    header('location:adminemotions.php');

?>