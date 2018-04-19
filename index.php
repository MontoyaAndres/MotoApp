<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css">
    <title>MotoApp</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['id'])) {
    header('Location: motos.php');
} else {?>
    <div class="container">
        <div class="row">
            <h1>Enter your account to watch the best motos!</h1>
            <form action="index.php" method="POST" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" id="email" name="email" class="validate" required>
                        <label for="email">Enter your email</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="password" id="password" name="password" class="validate" required>
                        <label for="password">Enter your password</label>
                    </div>
                    <div class="input-field col s12">
                        <div class="col s6">
                            <button class="btn waves-effect waves-light" type="submit" name="send">Log in!
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                        <div class="col s6">
                            <a href="signin.php" class="btn waves-effect waves-light right">Sign in!
                                <i class="material-icons right">send</i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/materialize.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['send'])) {
    include_once('connection.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id,email,password FROM users WHERE email = '$email' LIMIT 1";
    $query = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if($query) {
        $row = mysqli_fetch_row($query);
        $userId = $row[0];
        $userEmail = $row[1];
        $userPassword = $row[2];
    }

    if($email == $userEmail && $password == $userPassword) {
        $_SESSION['id'] = $userId;
        header('Location: motos.php');
    } else {
        $error = 'Your email or password are incorrect';
        echo "<script>Materialize.toast('$error', 4000)</script>";
    }
}
// close login
}
?>