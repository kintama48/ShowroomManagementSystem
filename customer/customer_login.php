<!-- login.php -->
<html>
<head>
    <title>Customer Login</title>
</head>
<body>
<h1>Customer Login</h1>
<form action="customer_homepage.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>

<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $db = mysqli_connect('localhost', 'mysql', '', 'test');

    // Check if the username and password match a record in the customers table
    $query = "SELECT * FROM customers WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        // The login is successful
        // Redirect the user to the customer page
        header('location: customer_homepage.php');
    } else {
        // The login is unsuccessful
        // Show an error message
        echo "Invalid username or password";
    }
}
?>