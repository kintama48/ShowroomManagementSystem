<!-- add_vehicle.php -->
<?php
// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');

// Check if the form has been submitted
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year'])) {
    // Retrieve the form data and sanitize it
    $make = mysqli_real_escape_string($db, $_POST['make']);
    $model = mysqli_real_escape_string($db, $_POST['model']);
    $year = mysqli_real_escape_string($db, $_POST['year']);

    // Perform form validation
    if (empty($make) || empty($model) || empty($year)) {
        echo "Make, Model and Year fields are required";
    } else {
        // Add the vehicle to the database
        $query = "INSERT INTO vehicles (make, model, year) VALUES ('$make', '$model', '$year')";
        mysqli_query($db, $query);

        // Redirect the user back to the inventory page
        header("Location: inventory.php");
    }
}
?>
