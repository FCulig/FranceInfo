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
                    session_start();
                    if(isset($_SESSION["loggedin"])){
                        if($_SESSION["loggedin"] == 1){
                            echo '
                            <div class="row">
                                <h1 id="center">WRITE A NEW ARTICLE:</h1>
                                <a href="logout.php"><button class="btn btn-danger">LOGOUT</button></a>
                            </div>
                            ';
                            echo '
                                <form action="skripta.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title:</label><br>
                                    <input type="text" class="form-control" name="title" id="title" required><br>
                                    <span id="errorTitle" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="shortPreview">Short preview:</label><br>
                                    <textarea rows="5" name="shortPreview" class="form-control" id="shortPreview" required></textarea><br>
                                    <span id="errorShort" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="fullArticle">Full article:</label><br>
                                    <textarea rows="10" class="form-control" name="fullArticle" id="fullArticle" required></textarea><br>
                                    <span id="errorArticle" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Picture:</label>
                                    <input type="file"  name="picture" id="picture" required>
                                    <span id="errorPicture" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category:</label><br>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="1">EU Elections</option>
                                        <option value="0">Sports</option>
                                    </select><br>
                                    <span id="errorCategory" class="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="archive">Archive article:</label>
                                    <input type="checkbox" name="archive" id="archive"><br>
                                </div>
                                <div class="form-group">
                                    <input type="reset" class="btn btn-light" name="reset" value="Reset">
                                    <button type="submit" class="btn btn-light" name="submit" id="posalji" value="Submit">Submit</button>
                                </div>
                            </form>
                            ';
                        }
                    }else{
                        echo "You need to be logged in to see this page!";
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

    <script>
       document.getElementById("posalji").onclick = function(event) {
            var slanjeForme = true;

            var title = document.getElementById("title");
            if(title.value.length < 5 || title.value.length > 30){
                slanjeForme = false;
                document.getElementById("errorTitle").innerHTML = "Length of the title must be between 5 and 30 charachters!";
                title.style.border = "1px solid red";
            }else{
                title.style.border = "1px solid green";
            }

            var shortPreview = document.getElementById("shortPreview");
            if(shortPreview.value.length < 10 || shortPreview.value.length > 100){
                slanjeForme = false;
                document.getElementById("errorShort").innerHTML = "Length must be between 10 and 100 charachters!";
                shortPreview.style.border = "1px solid red";
            }else{
                shortPreview.style.border = "1px solid green";
            }

            var fullArticle = document.getElementById("fullArticle");
            if(fullArticle.value.length == 0){
                slanjeForme = false;
                document.getElementById("errorArticle").innerHTML = "You need to enter text here!";
                fullArticle.style.border = "1px solid red";
            }else{
                fullArticle.style.border = "1px solid green";
            }

            var picture = document.getElementById("picture");
            if(picture.value.length==0){
                slanjeForme = false;
                document.getElementById("errorPicture").innerHTML = "You need to upload a picture!";
                picture.style.border = "1px solid red";
            }else{
                picture.style.border = "1px solid green";
            }


            if(slanjeForme == false){
                event.preventDefault();
            }
        }
    </script>
</html>

