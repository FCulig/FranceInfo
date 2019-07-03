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
                $ime = $_POST['name'];
                $prezime = $_POST['surname'];
                $username = $_POST['username'];
                $lozinka = $_POST['pass'];
                $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
                $razina = 0;

                $sql = "SELECT username FROM users WHERE username = ?";
                $stmt = mysqli_stmt_init($dbc);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }

                if(mysqli_stmt_num_rows($stmt) > 0){
                    echo "
                    <div class='alert alert-danger' role='alert'>
                        <h4 class='alert-heading'>ERROR!</h4>
                        <p>This username already exists.</p>
                        <hr>
                        <p class='mb-0'>Please login or use another username.</p>
                    </div>
                    ";
                }else{
                    $sql = "INSERT INTO users (name, surname, username, password,
                        razina)VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($dbc);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username,
                        $hashed_password, $razina);
                        mysqli_stmt_execute($stmt);
                        echo "
                        <div class='alert alert-success' role='alert'>
                            <h4 class='alert-heading'>SUCCESS!</h4>
                            <p>You have successfully registered!</p>
                            <hr>
                            <p class='mb-0'>Now you can login.</p>
                        </div>
                        "; 
                    }
                }
                mysqli_close($dbc);
            ?>
            </div>
        </content>
    </body>
</html>