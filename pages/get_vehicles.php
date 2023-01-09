<?php
// Connect to the database
$db = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

// Retrieve the list of vehicles from the database
$query = "SELECT * FROM vehicles";
$result = mysqli_query($db, $query);

// Initialize an empty array to store the vehicles
$vehicles = array();

// Iterate through the list of vehicles and add them to the array
while ($vehicle = mysqli_fetch_assoc($result)) {
    $vehicles[] = $vehicle;
}

// Close the database connection
mysqli_close($db);
?>
