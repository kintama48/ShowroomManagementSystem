<?php
session_start();

// Check if the id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the id of the item to remove
    $id = $_GET['id'];
    $type = $_GET['type'];
    // Iterate through the cart items and remove the item with the matching id
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i]['id'] == $id && $_SESSION['cart'][$i]['type'] == $type){
            array_splice($_SESSION['cart'], $i, 1);
            break;
        }
    }
}

// Redirect the user back to the cart page
header('Location: ../customer/customer_homepage.php');
?>