<!DOCTYPE html>
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
            <?php
                include("connect.php");


                if(isset($_GET["edit"])){
                    if($_GET["edit"] == 1){
                        $query = "DELETE FROM news WHERE id=".$_GET["id"];
                        mysqli_query($dbc, $query);
                        $link = $_GET["url"];
                    }
                }

                if(isset($_POST["submit"])){
                    $archive = 0;
                    if(isset($_POST["archive"])){
                        $archive = 1;
                    }

                    if(!file_exists($_FILES['picture']['tmp_name'])|| !is_uploaded_file($_FILES['picture']['tmp_name'])){
                        $target_dir = $_GET["url"];
                    }else{
                        if(isset($_GET["edit"])){
                            if($_GET["edit"] == 1){
                                unlink($_GET["url"]);
                            }
                        }
                        
                        $path_parts = pathinfo($_FILES["picture"]["name"]);
                        $extension = $path_parts['extension'];

                        $date = date("d-M-Y-H-i-s");

                        $picture = $date.".".$extension;

                        $target_dir = 'img/'.$picture;
                        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
                    }

                    


                    $sql ="INSERT INTO `news`(`date`, `title`, `short`, `article`, `category`, `show`, `url`) VALUES 
                            (CURRENT_TIME(), '".$_POST["title"]."', '".$_POST["shortPreview"]."', '".$_POST["fullArticle"]."', 
                            '".$_POST["category"]."', '".$archive."', '".$target_dir."')";

                    $res = mysqli_query($dbc, $sql);

                    $latestID = mysqli_fetch_array(mysqli_query($dbc, "SELECT id FROM news ORDER BY id DESC LIMIT 1"));

                    if($res){
                        echo "
                        <div class='alert alert-success' role='alert'>
                            <h4 class='alert-heading'>SUCCESS!</h4>
                            <p>News article was published successfully. You can see your article <a style='font-weight:bold' href='clanak.php?articleID=".$latestID[0]."'>here</a>.</p>
                            <hr>
                            <p class='mb-0'>You can close this page now.</p>
                        </div>
                        ";                        
                    }else{
                        echo "
                        <div class='alert alert-danger' role='alert'>
                            <h4 class='alert-heading'>FAIL!</h4>
                            <p>News article was not published successfully.</p>
                            <hr>
                            <p class='mb-0'>There was an error while uploading article. If this message keeps reappearing please
                            contact page administrator!</p>
                        </div>
                        ";  
                    }
                }
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