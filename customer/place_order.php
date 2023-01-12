<?php
// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');

// Check if the form has been submitted
if (isset($_POST['vehicle_id']) && isset($_POST['part_id']) && isset($_POST['quantity'])) {
    // Retrieve the vehicle and part information from the database
    $vehicle_id = mysqli_real_escape_string($db, $_POST['vehicle_id']);
    $part_id = mysqli_real_escape_string($db, $_POST['part_id']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $query = "SELECT * FROM vehicles WHERE id = $vehicle_id";
    $vehicle_result = mysqli_query($db, $query);
    $vehicle = mysqli_fetch_assoc($vehicle_result);
    $query = "SELECT * FROM parts WHERE id = $part_id";
    $part_result = mysqli_query($db, $query);
    $part = mysqli_fetch_assoc($part_result);

    // Calculate the total price for the order
    $total_price = $part['price'] * $quantity;

    // Add the order to the database
    $query = "INSERT INTO orders (vehicle_id, part_id, quantity, total_price) VALUES ($vehicle_id, $part_id, $quantity, $total_price)";
    mysqli_query($db, $query);

    // Generate the invoice
    $invoice = "Invoice:\n\n";
    $invoice .= "Vehicle: " . $vehicle['make'] . " " . $vehicle['model'] . "\n";
    $invoice .= "Part: " . $part['name'] . "\n";
    $invoice .= "Quantity: " . $quantity . "\n";
    $invoice .= "Total Price: $" . $total_price . "\n";

    // Display the invoice to the user
    echo $invoice;
}
?>
