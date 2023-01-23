<?php

$db = mysqli_connect('localhost', 'mysql', '', 'test');
// Check if the form has been submitted
if (isset($_POST['vehicle_id'])) {
// Retrieve the form data
    $vehicle_id = $_POST['vehicle_id'];
    // Delete the vehicle from the database
    $query = "DELETE FROM vehicles WHERE id='$vehicle_id'";
    $result = mysqli_query($db, $query) or die(mysql_error());

// Redirect the user to the inventory page
    header("Location: ../admin/inventory.php");
    exit();
}

// Close the database connection
mysqli_close($db);
?>
<html>
<head>
    <title>Delete Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stylesheets/edit_vehicles.css">

</head>
<body>
<div class="container">
    <h1>Delete Vehicle</h1>
    <?php
        $id = $_GET['id'];
        $db = mysqli_connect('localhost', 'mysql', '', 'test');
        $query = "select * from vehicles where id='$id'";
        $result = mysqli_query($db, $query);
        $vehicles=array();
        while ($vehicle = mysqli_fetch_assoc($result)) {
            $vehicles[] = $vehicle;
        }
    ?>
    <form action="delete_vehicle.php" method="post">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicles[0]['id']; ?>">
        <p>Are you sure you want to delete this vehicle?</p>
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" value="<?php echo $vehicles[0]['make']; ?>" disabled>
        <br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $vehicles[0]['model']; ?>" disabled>
        <br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" value="<?php echo $vehicles[0]['year']; ?>" disabled>
        <br>
        <input type="submit" value="Delete Vehicle">
    </form>
    <br>
    <a href="../admin/inventory.php">Cancel</a>
</div>
</body>
</html>