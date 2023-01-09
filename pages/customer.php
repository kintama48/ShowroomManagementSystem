<!-- customer.php -->
<html>
<head>
    <title>Customer Page</title>
</head>
<body>
<h1>Customer Page</h1>
<h2>Vehicles</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
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
        echo "</tr>";
    }
    ?>
</table>
<h2>Parts</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
    </tr>
    <?php
    // Include the code to retrieve the list of parts from the database
    include 'get_parts.php';

    // Iterate through the list of parts and display them in a table
    foreach ($parts as $part) {
        echo "<tr>";
        echo "<td>" . $part['id'] . "</td>";
        echo "<td>" . $part['name'] . "</td>";
        echo "<td>" . $part['description'] . "</td>";
        echo "<td>" . $part['price'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
<h2>Place an Order</h2>
<form action="place_order.php" method="post">
    <label for="vehicle_id">Vehicle:</label><br>
    <select id="vehicle_id" name="vehicle_id">
        <?php
        // Include the code to retrieve the list of vehicles from the database
        include 'get_vehicles.php';

        // Iterate through the list of vehicles and create options for the select element
        foreach ($vehicles as $vehicle) {
            echo "<option value='" . $vehicle['id'] . "'>" . $vehicle['make'] . " " . $vehicle['model'] . "</option>";
        }
        ?>
    </select><br>
    <label for="part_id">Part:</label><br>
    <select id="part_id" name="part_id">
        <?php
        // Include the code to retrieve the list of parts from the database
        include 'get_parts.php';

        // Iterate through the list of parts and create options for the select element
        foreach ($parts as $part) {
            echo "<option value='" . $part['id'] . "'>" . $part['name'] . "</option>";
        }
        ?>
    </select><br>
    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" min="1"><br><br>
    <input type="submit" value="Place Order">
</form>
</body>
</html>
