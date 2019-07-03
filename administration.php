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
        <script src="https://kit.fontawesome.com/a5f482a6ef.js"></script>
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
                                
                            ';

                            if($_SESSION["level"]==0){
                                echo"
                                    <div class='row'>
                                        <h1 id='center'>ADMINISTRATION</h1>
                                        <a href='logout.php'><button class='btn btn-danger'>LOGOUT</button></a>
                                    </div>
                                    <div class='row'>
                                        <h1>LOGGED IN</h1>
                                    </div>
                                    <div class='row'>
                                        <p>Hello, ".$_SESSION["username"]."! You don't have administrator rights!</p>
                                    </div>
                                ";
                            }else{
                                echo "
                                    <div class='row'>
                                        <h1 id='center'>ADMINISTRATION</h1>
                                        <a href='logout.php'><button class='btn btn-danger'>LOGOUT</button></a>
                                    </div>
                                ";
                                $query = "SELECT * FROM news ORDER BY date DESC";
                                $res = mysqli_query($dbc, $query);

                                while($row = mysqli_fetch_array($res)){
                                    echo "
                                        <br><hr>
                                        <div class='row kategorija'>
                                            <div class='col-6 col-lg-3'>
                                                <img src='".$row["url"]."' width = 100%>
                                            </div>
                                            <div class='col-6 col-lg-5'>
                                                <h2>".$row["title"]."</h2>
                                            </div>
                                            <div class='col-6 col-lg-2'>
                                                <a href='delete.php?id=".$row["id"]."&url=".$row["url"]."'>
                                                    <button type='button' class='btn btn-danger'>
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class='col-6 col-lg-2'>
                                                <a href='edit.php?id=".$row["id"]."'>
                                                    <button type='button' class='btn btn-success'>
                                                        <i class='fas fa-edit'></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div><br>
                                    ";
                                }
                                
                            }
                        }else{
                            ispisForme();
                        }
                    }else{
                        ispisForme();
                    }

                    function ispisForme(){
                        echo '
                            <div class="row" id="spacing">
                            <div class="col-12 col-lg-6">
                                <div class="row" id="spacing">
                                    <h3 style="text-align:center" id="center">Login into your existing account:</h3>
                                </div>
                                <div class="row">
                                    <form action="login.php" method="POST" id="smaller-form">
                                        <div class="form-group">
                                            <label for="usernameLog" >Username:</label>
                                            <input class="form-control" type="text" id="usernameLog" name="username" required>
                                            <span id="loginUsernameError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="passLog" >Password:</label>
                                            <input class="form-control" type="password" id="passLog" name="pass" required>
                                            <span id="loginPasswordError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-dark" type="submit" value="Login" name="login" id="login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6" id="border">
                                <div class="row" id="spacing">
                                    <h3 style="text-align:center" id="center">Register as a new user:</h3>
                                </div>
                                <div class="row">
                                    <form action="register.php" method="POST" style="margin-left:50px" id="smaller-form">
                                        <div class="form-group">
                                            <label for="name" >Name:</label>
                                            <input class="form-control" type="text" id="name" name="name" required>
                                            <span id="nameError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" >Surname:</label>
                                            <input class="form-control" type="text" id="surname" name="surname" required>
                                            <span id="surnameError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" >Username:</label>
                                            <input class="form-control" type="text" id="username" name="username" required>
                                            <span id="usernameError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass" >Password:</label>
                                            <input class="form-control" type="password" id="pass" name="pass" required>
                                            <span id="passwordError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="passRepeat" >Repeat password:</label>
                                            <input class="form-control" type="password" id="passRepeat" name="passRepeat" required>
                                            <span id="repeatError" class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-dark" type="submit" value="Register" name="register" id="register">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>   
                        ';
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
        document.getElementById("login").onclick = function (event){
            var slanjeLogin = true;

            var user = document.getElementById("usernameLog");
            if(user.value.length == 0){
                slanjeLogin = false;
                user.style.border = "1px solid red";
                document.getElementById("loginUsernameError").innerHTML = "You need to enter your username!";
            }else{
                document.getElementById("loginUsernameError").innerHTML = "";
            }

            var pass = document.getElementById("passLog");
            if(pass.value.length == 0){
                slanjeLogin = false;
                pass.style.border = "1px solid red";    
                document.getElementById("loginPasswordError").innerHTML = "You need to enter your password!";
            }else{
                document.getElementById("loginPasswordError").innerHTML = "";
            }


            if(slanjeLogin == false){
                event.preventDefault();
            }
        }

        document.getElementById("register").onclick = function (event){
            var slanjeRegister = true;

            var name = document.getElementById("name");
            if(name.value.length == 0){
                slanjeRegister = false;
                document.getElementById("nameError").innerHTML = "You need to enter your name!";
                name.style.border = "1px solid red";
            }else{
                name.style.border = "1px solid green";
                document.getElementById("nameError").innerHTML = "";
            }

            var surname = document.getElementById("surname");
            if(surname.value.length == 0){
                slanjeRegister = false;
                document.getElementById("surnameError").innerHTML = "You need to enter your surname!";
                surname.style.border = "1px solid red";
            }else{
                surname.style.border = "1px solid green";
                document.getElementById("surnameError").innerHTML = "";
            }

            var username = document.getElementById("username");
            if(username.value.length == 0){
                slanjeRegister = false;
                document.getElementById("usernameError").innerHTML = "You need to enter your username!";
                username.style.border = "1px solid red";
            }else{
                username.style.border = "1px solid green";
                document.getElementById("usernameError").innerHTML = "";
            }

            var pass = document.getElementById("pass");
            if(pass.value.length == 0){
                slanjeRegister = false;
                document.getElementById("passwordError").innerHTML = "You need to enter your password!";
                pass.style.border = "1px solid red";
            }else{
                pass.style.border = "1px solid green";
                document.getElementById("passwordError").innerHTML = "";
            }

            var repeatedPass = document.getElementById("passRepeat");
            if(repeatedPass.value.length == 0){
                slanjeRegister = false;
                document.getElementById("repeatError").innerHTML = "You need to repeat your password!";
                repeatedPass.style.border = "1px solid red";
            }else{
                if(repeatedPass.value != pass.value){
                    slanjeRegister = false;
                    document.getElementById("repeatError").innerHTML = "Passwords don't match!";
                    repeatedPass.style.border = "1px solid red";
                }else{
                    repeatedPass.style.border = "1px solid red";
                    document.getElementById("repeatError").innerHTML = "";
                }
            }

            if(slanjeRegister == false){
                event.preventDefault();
            }
        }
    </script>
</html>