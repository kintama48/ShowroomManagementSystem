<?php
// Connect to the database
$db = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');

// Retrieve the list of parts from the database
$query = "SELECT * FROM parts";
$result = mysqli_query($db, $query);

// Initialize an empty array to store the parts
$parts = array();

// Iterate through the list of parts and add them to the array
while ($part = mysqli_fetch_assoc($result)) {
    $parts[] = $part;
}

// Close the database connection
mysqli_close($db);
?>
