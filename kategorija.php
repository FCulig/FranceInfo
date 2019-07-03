<!DOCTYPE html>
<?php
    include("connect.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>France Info</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <img src="img/logo.png">
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row">
                    <nav>
                        <ul>
                            <li><a href="index.php">home</a></li>
                            <li><a href="kategorija.php?catID=1">elections</a></li>
                            <li><a href="kategorija.php?catID=0">sports</a></li>
                            <li><a href="administration.php">administration</a></li>
                            <li><a href="unos.php">new article</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <hr>
        </header>
        <content>
            <div class="container">
                <div class="row">
                    <?php
                        if($_GET["catID"] == 1){
                            echo "<h1>EUROPEAN ELECTIONS 2019</h1></div>";
                        }else{
                            echo "<h1>SPORTS</h1></div>";
                        }

                        $query = "SELECT * FROM news WHERE category = ".$_GET["catID"]." ORDER BY date DESC";
                        $res = mysqli_query($dbc, $query);

                        while($row = mysqli_fetch_array($res)){
                            echo "
                                <a href='clanak.php?articleID=".$row["id"]."'>
                                <br><hr>
                                <div class='row kategorija'>
                                    <div class='col-sm-4'>
                                        <img src='".$row["url"]."' width = 100%>
                                    </div>
                                    <div class='col-sm-8'>
                                        <h2>".$row["title"]."</h2>
                                    </div>
                                </div><br>
                                </a>
                            ";
                        }
                    ?>
                

                <?php

                ?>
                
            </div>
        </content>
        <footer>
            <div class="container">
                <p><b>Author:</b> Filip Čulig</p>
                <p><b>E-mail:</b> <a href="mailto:filip.culig@gmail.com" target="_top">filip.culig@gmail.com</a></p>
                <p>June 2019</p>
            </div>
        </footer>
    </body>
</html>