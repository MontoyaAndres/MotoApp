<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css">
    <title>Moto App</title>
</head>
<body>
<?php
include_once('connection.php');
session_start();
if (isset($_SESSION['id'])) { ?>
    <nav>
        <div class="nav-wrapper green">
            <a href="#" class="brand-logo">Moto App</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
                <li><a href="motocreate.php">Create a moto</a></li>
                <li><a href="signout.php">Sing out</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h1>Create one moto!</h1>
            <form action='motocreate.php' method='POST' class='col s12' enctype='multipart/form-data'>
                <div class='row'>
                    <div class='input-field col s6'>
                        <input type='text' name='title' required class='validate' id='title'>
                        <label for='title'>Title</label>
                    </div>
                    
                    <div class='input-field col s6'>
                        <input type='text' name='description' required class='validate' id='description'>
                        <label for='description'>Description</label>
                    </div>
                </div>

                <div class='row'>
                    <div class='file-field input-field'>
                        <div class='btn'>
                            <span>Upload</span>
                            <input type='file' name='file' required>
                        </div>
                        <div class='file-path-wrapper'>
                            <input class='file-path validate' type='text'>
                        </div>
                    </div>
                </div>
                                        
                <div class='row'>
                    <button class='btn waves-effect waves-light' type='submit' name='send'>Create it
                        <i class='material-icons right'>send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php
    if (isset($_POST['send'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $path = 'images/';
        $path = $path.basename($_FILES['file']['name']);

        if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            $sql = "INSERT INTO motos SET title = '$title', description = '$description', route = '$path'";
            $query = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            if ($query) {
                header('location: motos.php');
                exit();
            } else {
                echo mysqli_error($connection);
            }
        } else {
            echo "There was an error uploading the file, please try again!";
        }
    }
// close login
} else {
    header('Location: index.php');
    die();
}
?>
  <script src="js/jquery.min.js"></script>
  <script src="js/materialize.min.js"></script>
</body>
</html>