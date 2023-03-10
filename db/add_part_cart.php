<!-- add_part_cart.php -->
<?php
session_start();

$db = mysqli_connect('localhost', 'mysql', '', 'test');

// Check if the id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the id of the item to add to the cart
    $id = $_GET['id'];

    // Connect to the database

    // Retrieve the item from the database
    $query = "SELECT * FROM parts WHERE id = $id";
    $result = mysqli_query($db, $query);
    $item = mysqli_fetch_assoc($result);

    // Check if the item is already in the cart
    $index = -1;
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i]['id'] == $id) {
            $index = $i;
            break;
        }
    }

    // If the item is already in the cart, increment the quantity
    if ($index != -1) {
        $_SESSION['cart'][$index]['quantity']++;
    } else {
        // Otherwise, add a new item to the cart with quantity 1
        $item['quantity'] = 1;
        $item['type'] = 'part';
        array_push($_SESSION['cart'], $item);
    }
    echo json_encode($_SESSION['cart']);
}

// Redirect the user back to the customer page
header('Location: ../customer/customer_homepage.php');
?>