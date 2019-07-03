<?php
    header('Content-Type: text/html; charset=utf-8');
    $dbc = mysqli_connect("localhost", "root", "", "franceinfo") or die("Error connecting to MySQL server!");
    mysqli_set_charset($dbc, "utf8");
?>