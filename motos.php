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
            <?php
                $task = mysqli_query($connection, "SELECT * FROM motos") or die(mysqli_error($connection));
                $i = 1; while ($row = mysqli_fetch_array($task)) {?>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo $row['route'] ?>">
                            <a href="motosedit.php?edit=<?php echo $row['id'] ?>" class="btn-floating btn-medium halfway-fab waves-effect waves-light green left"><i class="material-icons">edit</i></a>
                            <a href="motos.php?delete=<?php echo $row['id'] ?>" class="btn-floating btn-medium halfway-fab waves-effect waves-light red"><i class="material-icons">delete</i></a>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title"><?php echo $row['title'] ?></h3>
                            <p><?php echo $row['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php $i++; } ?>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/materialize.min.js"></script>
</body>
</html>

<?php
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM motos WHERE id = '$id'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
        header('location: motos.php');
        exit();
    }
// close login
} else {
    header('Location: index.php');
    die();
}
?>