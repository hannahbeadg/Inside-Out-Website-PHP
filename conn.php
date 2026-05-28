<?php
$server="localhost";
$username="root";
$password="";
$dbname="insideout_db";
$tablelogin="tbl_admin";
$tablecontentpage="tbl_pages";
$tablecontent="tbl_content";
$tableemotions="tbl_emotions";
$tablecharacters="tbl_characters";
$tablewatch="tbl_watch";
$tablemessages="tbl_messages";


$conn = mysqli_connect("$server","$username", "$password", "$dbname") or die ("cannot connect to db");

if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>