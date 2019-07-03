<?php
    include("connect.php");
    
    $query = "DELETE FROM news WHERE id=".$_GET["id"];
    mysqli_query($dbc, $query);
    
    unlink($_GET["url"]);

    header("Location: administration.php");
?>