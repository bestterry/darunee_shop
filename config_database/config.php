<?php
$host = "localhost";
$userdb = "root";
$passdb ="";
$db = "darunee";

$conn= new mysqli($host,$userdb,$passdb,$db);
mysqli_set_charset($conn, "utf8");
if(mysqli_connect_error())
{
    echo "failed connect to MSQL :" . mysqli_connect_error();
    die();
}
?>