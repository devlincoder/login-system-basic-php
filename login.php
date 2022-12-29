<?php
session_start();
include "connect.php";

# Auto login
if(isset($_SESSION["name"]) && isset($_SESSION["password"])){
    header("location:home.php");
}

# Handle login
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM `login` WHERE name = '$name' and password = '$password'";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["name"] = $name;
        $_SESSION["password"] = $password;
        header("location:home.php");
    } else {
        header("location:login.php?error=Not exist username or Wrong password");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <div class="container">
        <form method="POST" class="form">
            <?php
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                echo '<p class="error">' . $error . '</p>';
            }
            ?>
            <div class="form__item">
                <label for="name" class="form__label">Name</label>
                <input type="text" class="form__input" name="name" spellcheck="false">
            </div>

            <div class="form__item">
                <label for="password" class="form__label">Password</label>
                <input type="password" class="form__input" name="password" spellcheck="false">
            </div>

            <button type="submit" class="form__btn" name="submit">Log In</button>
            <div class="text">
                <p>Not registed?</p>
                <a href="register.php">Create an account</a>
            </div>
        </form>
    </div>
</body>

</html>