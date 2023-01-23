<?php
// Include the database connection file
include 'db_connect.php';

// Get the search query from the form
$search_query = mysqli_real_escape_string($conn, $_POST['search_query']);

// Build the SQL query for searching vehicles
$sql_vehicles = "SELECT * FROM vehicles WHERE make LIKE '%$search_query%' OR model LIKE '%$search_query%'";

// Execute the query
$result_vehicles = mysqli_query($conn, $sql_vehicles);

// Build the SQL query for searching parts
$sql_parts = "SELECT * FROM parts WHERE name LIKE '%$search_query%'";

// Execute the query
$result_parts = mysqli_query($conn, $sql_parts);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search Results</title>
    </head>
    <body>
    <div id="search-form">
        <form action="search.php" method="post">
            <input type="text" placeholder="Search..." name="search_query">
            <input type="submit" value="Search">
        </form>
    </div>
    <h1>Search Results</h1>


    <h2>Vehicles</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
        </tr>
        <?php
        // Loop through the result set and display the vehicles
        while ($row = mysqli_fetch_assoc($result_vehicles)) {
            echo "<tr>";
            echo "<td>#" . $row['id'] . "</td>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Parts</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        <?php
        // Loop through the result set and display the parts
        while ($row = mysqli_fetch_assoc($result_parts)) {
            echo "<tr>";
            echo "<td>#" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
<style>
    /* Add some basic styling for the search bar */
    #search-form {
        margin: 20px 0;
        text-align: center;
    }
    input[type="text"] {
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        width: 100px;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }
</style>
</html>
