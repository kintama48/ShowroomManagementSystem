<?php
// Include the database connection file
$conn = mysqli_connect('localhost', 'mysql', '', 'test');
// Get the search query from the form

if (!isset($_POST['search_query'])) {
    $search_query = "";
} else {
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);

    // Build the SQL query for searching vehicles
        $sql_vehicles = "SELECT * FROM vehicles WHERE make LIKE '%$search_query%' OR model LIKE '%$search_query%'";

    // Execute the query
        $result_vehicles = mysqli_query($conn, $sql_vehicles);

    // Build the SQL query for searching parts
        $sql_parts = "SELECT * FROM parts WHERE name LIKE '%$search_query%'";

    // Execute the query
        $result_parts = mysqli_query($conn, $sql_parts);

        echo '<div id="search-results">';

        if (mysqli_num_rows($result_vehicles) <= 0 && mysqli_num_rows($result_parts) <= 0) {
            echo '<h2>No results found</h2>';
        }

        if (mysqli_num_rows($result_vehicles) > 0) {
            echo '
            <table class ="styled-table">
            <caption>Vehicles</caption>
            <tr>
                <thead>
                <th>ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Action</th>
                </thead>
            </tr><tr><tbody>';
            while ($row = mysqli_fetch_assoc($result_vehicles)) {
                echo "<tr>";
                echo "<td>#" . $row['id'] . "</td>";
                echo "<td>" . $row['make'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td><a href='../db/add_vehicle_cart.php?id=".$row['id']."'>Add</a></td>";
                echo "</tr>";
            }
            echo '</tbody></tr></table>';

        }
        if (mysqli_num_rows($result_parts) > 0) {
            echo '
                <table class="styled-table">
                <caption>Parts</caption>
                    <tr>
                        <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                        </thead>
                    </tr><tr><tbody>
                ';

            while ($row = mysqli_fetch_assoc($result_parts)) {
                echo "<tr>";
                echo "<td>#" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td><a href='../db/add_part_cart.php?id=".$row['id']."'>Add</a></td>";
                echo "</tr>";
            }
            echo '</tbody></tr></table>';
        }
    echo '</div>';
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
    <body>
    <a href="customer_homepage.php">
        <img style="width: 40px;height: 40px;position: absolute; top: 5%; left: 15%;" alt="home" src="../assets/home.png">
    </a>
    <div id="search-form">
        <form action="search.php" method="post">
            <input type="text" style="width: 50%;" placeholder="Vehicle/Part" name="search_query">
            <input type="submit" value="Search">
        </form>
    </div>
</body>
<style>
    /* Add some basic styling for the search bar */
    body {

        text-align:center;
        /*background-image: url("../assets/bg.jpg");*/

    }
    #search-form {
        margin: 20px 0;
        text-align: center;
    }
    #search-results {
        position: absolute;
        top: 20%;
        left: 35%;
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

    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        margin-left:auto;
        margin-right:auto;
        background-color: white;
    }

    .styled-table thead tr {
        background-color: aquamarine;
        color: black;
        text-align: left;
    }

    .styled-table th,.styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid rgb(78, 156, 131);
    }
</style>
</html>
