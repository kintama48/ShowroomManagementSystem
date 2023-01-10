<?php
// Connect to the database
$db = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

// Check if the form has been submitted
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    // Retrieve the form data and sanitize it
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);

    // Perform form validation
    if (empty($name) || empty($price) || empty($quantity)) {
        echo "Name, Price and Quantity fields are required";
    } else {
        // Add the part to the database
        $query = "INSERT INTO parts (name, price, quantity) VALUES ('$name', '$price', '$quantity')";
        mysqli_query($db, $query);

        // Redirect the user back to the inventory page
        header("Location: inventory.php");
    }
}
?>
