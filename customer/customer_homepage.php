<!-- customer.php -->
<html>
    <head>
        <title>Customer Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../stylesheets/customer_homepage.css">
    </head>
    <body>
        <div id="table-div" class="container">
            <h1>Customer Page</h1>
            <h2>Vehicles</h2>
            <table class="styled-table">
                <tr>
                    <thead>
                        <th>ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                    </thead>
                </tr>

                <tbody>
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
                </tbody>

            </table>

            <h2>Parts</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>

                <tbody>
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
                        
                </tbody>

            </table>

        </div>

        <div id="form-div" class="container">

            <h2>Place an Order</h2>
            <form action="place_order.php" method="post">
                <label for="vehicle_id"><h4>Vehicle</h4></label><br>
                <select id="vehicle_id" name="vehicle_id">

                   
                    <?php
                    // Include the code to retrieve the list of vehicles from the database
                    include 'get_vehicles.php';

                    // Iterate through the list of vehicles and create options for the select element
                    foreach ($vehicles as $vehicle) {
                        echo "<option value='" . $vehicle['id'] . "'>" . $vehicle['make'] . " " . $vehicle['model'] . "</option>";
                    }
                    ?>
                    
                    <label for="quantity">Quantity:</label><br>
                    <input style="width:4%;" type="number" id="quantity-car" name="quantity-car" min="1"><br><br>

                </select><br>
                <label for="part_id"><h4>Part</h4></label><br>
                <select id="part_id" name="part_id">

                    <?php
                    // Include the code to retrieve the list of parts from the database
                    include 'get_parts.php';

                    // Iterate through the list of parts and create options for the select element
                    foreach ($parts as $part) {
                        echo "<option value='" . $part['id'] . "'>" . $part['name'] . "</option>";
                    }
                    ?>
                    
                    <label for="quantity">Quantity:</label><br>
                    <input style="width:4%;" type="number" id="quantity-part" name="quantity-part" min="1"><br><br>

                </select><br>
                <input type="submit" value="Place Order">
            </form>

        </div>
        
    </body>
</html>
