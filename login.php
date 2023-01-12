<?php
session_start();

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
    <style>
        body {
            background-color: dodgerblue;
        }

        form {
            width: 300px;
        }

        label, input {
            display: block;
            margin: 5px 0;
        }

        #userpass {
            border: 1px solid black;
            padding: 5%;
            background-color: mediumpurple;
            color: black;
            font-family: "Droid Sans Mono", "DejaVu Sans Mono", "Monospace", monospace;
            margin-top: 25%;
            margin-left: 150%;
            width: 125%;
        }

    </style>
    <title>Lab 12</title>
</head>
<body>
<form action="" method="post">
    <div id="userpass">
        <h1>User Authentication</h1>
        <label for="username" style="font-weight: bold">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password" style="font-weight: bold">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Login">
    </div>
</form>
</body>
</html>
