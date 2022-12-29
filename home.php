<?php
session_start();
include 'connect.php';
if (isset($_SESSION["name"]) && isset($_SESSION["password"])) {
    $name = $_SESSION["name"];
    $password = $_SESSION["password"];

    $sql = "SELECT * FROM `login` WHERE name='$name' and password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    # Check SESSION if using console
    if($count==1){
        $rows = mysqli_fetch_assoc($result);
    }else{
        header("location:login.php?error=Are you hacker?");
    }
} else {
    header("location:login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Basic</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="container">
        <h1><?php echo "Hello," . $name . "" ?></h1>
        <p>Your password : <?php echo $rows["password"]?></p>
        <p>Your ID : <?php echo $rows["id"]?></p>
        <button class="btn btn-primary my-5">
            <a href="logout.php" class="text-light">Log out</a>
        </button>
    </div>
</body>

</html>