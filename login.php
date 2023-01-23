<?php
session_start();
$db = mysqli_connect("localhost", "mysql", "", "test");

// initializes all tables
function init_tables() {
    $query = "CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(20) NOT NULL,
            `password` varchar(50) NOT NULL,
            `role` varchar(10) NOT NULL,
            PRIMARY KEY (`id`)
        ) AUTO_INCREMENT=1 ;";
    $query .= "CREATE TABLE IF NOT EXISTS `vehicles` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `make` varchar(255) NOT NULL,
            `model` varchar(255) NOT NULL,
            `year` int(11) NOT NULL,
            PRIMARY KEY (`id`)
        ) AUTO_INCREMENT=1 ;";
    $query .= "CREATE TABLE IF NOT EXISTS `orders` (
                                        `id` int(11) NOT NULL AUTO_INCREMENT,
                                        `vehicle_id` int(11) NOT NULL,
                                        `user_id` int(11) NOT NULL,
                                        `part_id` int(11) NOT NULL,
                                        `total_price` float NOT NULL,
                                        PRIMARY KEY (`id`)
               ) AUTO_INCREMENT=1 ;";

    $query .= "CREATE TABLE IF NOT EXISTS `parts` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL,
            `price` float NOT NULL,
            `quantity` int(11) NOT NULL,
            PRIMARY KEY (`id`)
        ) AUTO_INCREMENT=1 ;";

    $query .= "INSERT INTO `users` (`username`, `password`, `role`) VALUES
                    ('admin', 'admin', 'admin'),
                    ('customer', 'abcd', 'customer');";

    $query .= "INSERT INTO `vehicles` (`make`, `model`, `year`) VALUES
            ('Ford', 'Fusion', 2018),
            ('Ford', 'Mustang', 2018),
            ('Honda', 'Accord', 2018),
            ('Honda', 'Civic', 2018),
            ('Toyota', 'Camry', 2018),
            ('Toyota', 'Corolla', 2018);";
    $query .= "INSERT INTO `parts` (`name`, `price`, `quantity`) VALUES
            ('Tires', 100, 10),
            ('Brakes', 200, 10),
            ('Oil', 50, 10),
            ('Air Filter', 20, 10),
            ('Windshield Wipers', 10, 10);";

    mysqli_multi_query($GLOBALS['db'], $query);
}

//init_tables();

//  https://chat.openai.com/chat/21840481-72c4-4474-a354-e1ab899b66a9

if (isset($_POST["username"]) && isset($_POST["password"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

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
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./stylesheets/main_login.css">

    <title>Course Project</title>
</head>
<body>
<div id = "main-div" class = "container">
    <div id="userpass">
        <form method="post" action="login.php">
            <br>
            <h2>LOGIN</h2>
            <h5 style = "color:slategrey;">Please enter your username and password</h5>
            <br><br>
            <input type="text" placeholder="Username" id="username" name="username" >
            <br>
            <input type="password" placeholder="Password" id="password" name="password">
            <a  style = "color:slategrey; " href="#">Forgot Password?</a>
            <br>
            <input type="submit" style="font-weight: bold;border-radius: 50px; background-color: dodgerblue; color: black;" id="login-button"value="Login">
            <br><br>
            <a style = " text-decoration: none;color:slategrey;"href="#" class="fa fa-facebook"></a>
            <a style = " text-decoration: none;color:slategrey;"href="#" class="fa fa-twitter"></a>
            <a style = " text-decoration: none;color:slategrey;"href="#" class="fa fa-instagram"></a>
        </form>
    </div>
</div>

</body>
</html>
