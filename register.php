<?php
session_start();

include "connect.php";

# Auto login
if(isset($_SESSION["name"]) && isset($_SESSION["password"])){
    header("location:home.php");
}

# Handle register
if (isset($_POST["submit"])) {
    function validate($data){
        $data = trim($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $name = validate($_POST["name"]);
    $password = validate($_POST["password"]);
    

    $sql = "SELECT * FROM `login` WHERE name = '$name'";

    $rows = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($rows);

    if ($count==1) {
        header("location:register.php?error=Username existed");
    } else if(empty($name)){
        header("location:register.php?error=Username is required");
    }else if(empty($password)){
        header("location:register.php?error=Password is required");
    }else {
        $sql = "INSERT INTO `login` (name,password) values('$name','$password')";
        $rows = mysqli_query($conn, $sql); 
        $_SESSION["name"] = $name;
        $_SESSION["password"] = $password;
        header("location:home.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <div class="container">
        <form method="POST" class="form">
            <?php 
            if(isset($_GET["error"])){
                $error = $_GET["error"];
                echo '<p class="error">'.$error.'</p>';
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

            <button type="submit" class="form__btn" name="submit">Register</button>
            <div class="text">
                <p>Have an account?</p>
                <a href="login.php">Login now</a>
            </div>
        </form>
    </div>
</body>

</html>