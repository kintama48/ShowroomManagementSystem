<!-- inventory.php -->
<html>
<head>
    <title>Inventory Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stylesheets/inventory.css">

</head>
<body>

    <div class="container">
        <div style = "background-color: rgb(245, 245, 245,.8);">
            <h1>Inventory Page</h1>
            <h2>Vehicles</h2>
        </div>

        <table class ="styled-table">
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Action</th>
                </thead>

            </tr>

            <tr>
                <tbody>
                    <?php
                    // Include the code to retrieve the list of vehicles from the database
                    include './ShowroomManagementSystem/customer/get_vehicles.php';

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
                </tbody>




        </table>
    </div>


    <div id = "main-div" class = "container">

        <div id = "vehicle-form">
            <form id = "add-vehicle" action="add_vehicles.php" method="post">
                <h2>Add Vehicle</h2>
                <label for="make">Make:</label><br>
                <input type="text" id="make" name="make"><br>
                <label for="model">Model:</label><br>
                <input type="text" id="model" name="model"><br>
                <label for="year">Year:</label><br>
                <input type="number" id="year" name="year" min="1900" max="2050"><br><br>
                <input id = "vehicle-button" type="submit" value="Add Vehicle">
            </form><br><br>
        </div>

        <div id = "part-form">
            <form id = "add-part" action="add_parts.php" method="post">
            <h2>Add Part</h2>
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"><br>
                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price"><br>
                <label for="quantity">Quantity:</label><br>
                <input type="number" id="quantity" name="quantity"><br><br>
                <input id = "part-button" type="submit" value="Add Part">
            </form>

        </div>


    </div>


</body>
</html>
