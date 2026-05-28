<?php

    include("session.php");
    include("conn.php");

    $character_id = (int) $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM $tablecharacters WHERE character_id='$character_id'"
    );

    $_SESSION['status'] = "Character Successfully Deleted!";

    header('location:admincharacters.php');

?>