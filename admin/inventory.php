<!-- inventory.php -->
<html>
<head>
    <title>Inventory Page</title>
</head>
<body>
<h1>Inventory Page</h1>
<h2>Vehicles</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Action</th>
    </tr>
    <?php
    // Include the code to retrieve the list of vehicles from the database
    include 'get_vehicles.php';

    // Iterate through the list of vehicles and display them in a table
    foreach ($vehicles as $vehicle) {
        echo "<tr>";
        echo "<td>" . $vehicle['id'] . "</td>";
        echo "<td>" . $vehicle['make'] . "</td>";
        echo "<td>" . $vehicle['model'] . "</td>";
        echo "<td>" . $vehicle['year'] . "</td>";
        echo "<td>";
        echo "<a href='edit_vehicle.php?id=" . $vehicle['id'] . "'>Edit</a> | ";
        echo "<a href='delete_vehicle.php?id=" . $vehicle['id'] . "'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
<h2>Add Vehicle</h2>
<form action="add_vehicle.php" method="post">
    <label for="make">Make:</label><br>
    <input type="text" id="make" name="make"><br>
    <label for="model">Model:</label><br>
    <input type="text" id="model" name="model"><br>
    <label for="year">Year:</label><br>
    <input type="number" id="year" name="year" min="1900" max="2050"><br><br>
    <input type="submit" value="Add Vehicle">
</form>
</body>
</html>
