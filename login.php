<?php
session_start();

// https://chat.openai.com/chat/21840481-72c4-4474-a354-e1ab899b66a9

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = mysqli_connect("localhost", "mysql", "", "test");
    $query = "SELECT role FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["role"] = $row["role"];
        if ($_SESSION["role"] == "admin") {
            header("Location: admin/inventory.php");
        } else {
            header("Location: customer/customer_homepage.php");
        }
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./stylesheets/main_login.css">

        <title>Lab 12</title>
    </head>
    <body>
        <div id = "main-div" class = "container">
            <div id="userpass">

                <form action="" method="post">
                        <br>
                        <h2>LOGIN</h2>
                        <h5 style = "color:slategrey;">Please enter your username and password</h5> 
                        <br><br>
                        <input type="text" placeholder="Username" id="username" name="username" >
                        <br>
                        <input type="password" placeholder="Password" id="password" name="password">
                        <a  style = "color:slategrey; " href="#">Forgot Password?</a>
                        <br>
                        <input type="submit" id="login-button"value="Login">
                        <br><br>
                        <a style = " text-decoration: none;color:slategrey;"href="#" class="fa fa-facebook"></a>
                        <a style = " text-decoration: none;color:slategrey;"href="#" class="fa fa-twitter"></a>
                        <a style = " text-decoration: none;color:slategrey;"href="#" class="fa fa-instagram"></a>

                </form>
            </div>
        </div>

    </body>
</html>
