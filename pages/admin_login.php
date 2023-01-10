<?php
// Connect to the database
$db = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

// Check if the form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Retrieve the form data and sanitize it
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Perform form validation
    if (empty($username) || empty($password)) {
        echo "Username and password fields are required";
    } else {
        //Check if user is admin or not
        $query = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            //Successful login
            //Start a session
            session_start();
            $_SESSION['admin'] = true;
            // Redirect the user to the inventory page
            header("Location: inventory.php");
        } else {
            // Invalid username or password
            echo "Invalid username or password";
        }
    }
}
?>
