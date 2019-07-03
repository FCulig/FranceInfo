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
                <div class="row">
                    <h1>EDIT ARTICLE:</h1>
                </div>
                <div class="row">
                    <?php
                        include("connect.php");

                        $query = "SELECT * FROM news WHERE id=".$_GET["id"];
                        $res = mysqli_query($dbc, $query);

                        $row = mysqli_fetch_assoc($res);

                        echo '
                            <form style="width: 100%" action="skripta.php?edit=1&id='.$_GET["id"].'&url='.$row["url"].'" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="title">Title:</label><br>
                                <input type="text" class="form-control" name="title" id="title" value="'.$row["title"].'" required><br>
                                <span id="errorTitle" class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="shortPreview">Short preview:</label><br>
                                <textarea name="shortPreview" class="form-control" id="shortPreview" required>'.$row["short"].'</textarea><br>
                                <span id="errorShort" class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="fullArticle">Full article:</label><br>
                                <textarea class="form-control" name="fullArticle" id="fullArticle" required>'.$row["article"].'</textarea><br>
                                <span id="errorArticle" class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture:</label>
                                <input type="file"  name="picture" id="picture"><br>
                                <img src="'.$row["url"].'" width="300px">
                                <span id="errorPicture" class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label><br>
                                <select value="'.$row["category"].'" class="form-control" name="category" id="category" required>
                                    <option value="1">EU Elections</option>
                                    <option value="0">Sports</option>
                                </select><br>
                                <span id="errorCategory" class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="archive">Archive article:</label>
                                <input value="'.$row["show"].'" type="checkbox" name="archive" id="archive"><br>
                            </div>
                            <div class="form-group">
                                <input type="reset" class="btn btn-light" name="reset" value="Reset">
                                <button type="submit" class="btn btn-light" name="submit" id="posalji" value="Submit">Submit</button>
                            </div>
                        </form>
                        ';
                    ?>
                </div>
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