    <!-- customer.php -->
<html lang="en">
<head>
    <title>Customer Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stylesheets/customer_homepage.css">
</head><!-- customer.php -->
<body>
<div id="table-div" class="container">
    <h1>Customer Page</h1>
    <h2><b>Vehicles</b></h2>
    <a href="../login.php" style="position: absolute; top: 25px; left: 80%;">
        <img alt="logout" style="width: 50px;height: 50px;" src="../assets/logout.png">
    </a>
    <a href="profile.php" style="position: absolute; top: 25px; left: 85%;">
        <img alt="logout" style="width: 50px;height: 50px;" src="../assets/account.png">
    </a>
    <table class ="styled-table">
        <tr>
            <thead>
            <th>ID</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
            </thead>
        </tr>
        <tr>
            <tbody>
            <?php
            // Include the code to retrieve the list of vehicles from the database
            include '../db/get_vehicles.php';

            // Iterate through the list of vehicles and display them in a table
            foreach ($vehicles as $vehicle) {
                echo "<tr>";
                echo "<td>#" . $vehicle['id'] . "</td>";
                echo "<td>" . $vehicle['make'] . "</td>";
                echo "<td>" . $vehicle['model'] . "</td>";
                echo "<td>" . $vehicle['year'] . "</td>";
                echo "<td>" . $vehicle['price'] . "$</td>";
                echo "<td>" . $vehicle['quantity'] . "</td>";
                echo "<td>";
                echo "<a href='../db/add_vehicle_cart.php?id=".$vehicle['id']."'>Add</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </tr>
    </table>
</div>

<div class = "container">
    <h2 style="margin-top: 30px; font-weight: bold; background-color: rgb(245, 245, 245,.8);">Parts</h2>
    <table class ="styled-table">
        <tr>
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
            </thead>
        </tr>
        <tr>
            <tbody>
            <?php
            // Include the code to retrieve the list of parts from the database
            include '../db/get_parts.php';

            // Iterate through the list of parts and display them in a table
            foreach ($parts as $part) {
                echo "<tr>";
                echo "<td>#" . $part['id'] . "</td>";
                echo "<td>" . $part['name'] . "</td>";
                echo "<td>" . $part['price'] . "$</td>";
                echo "<td>" . $part['quantity'] . "</td>";
                echo "<td>";
                echo "<a href='../db/add_part_cart.php?id=".$part['id']."'>Add</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </tr>
    </table>
</div>

<div class = "container">
    <h2 style="margin-top: 30px; font-weight: bold; background-color: rgb(245, 245, 245,.8);">Cart</h2>
    <table class ="styled-table">
        <tr>
            <thead><th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
            </thead>
        </tr>
        <tr>
            <tbody>
            <?php
            // Include the code to retrieve the cart items from the session
            include '../db/get_cart_items.php';
            // Iterate through the list of cart items and display them in a table
            foreach ($cart as $item) {

                if (empty($item['name']) && empty($item['price'])) {
                    continue;
                }

                if (!array_key_exists('name', $item)) {
                    $item['name'] = $item['make'] . " " . $item['model'];
                }

                echo "<tr>";
                echo "<td>" . $item['name'] . "</td>";
                echo "<td>" . $item['price'] . "$</td>";
                echo "<td>" . $item['quantity'] . "</td>";
                echo "<td>" . (int) $item['price'] * $item['quantity'] . "$</td>";
                echo "<td>";
                echo "<a href='../db/remove_from_cart.php?id=".$item['id']."&type=".$item['type']."'>Remove</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td><b>Total:</b></td>
            <td><?php echo $cart['total']; ?>$</td>
        </tr>
    </table>

<!--    <div class="container" style="display: flex; justify-content: center; align-items: center;">-->
<!--        <h3 style="margin-right: 18%">Subtotal</h3>-->
<!--        <h3>--><?php //echo $cart['total']; ?><!--$</h3>-->
<!--    </div>-->

    <div class = "container" style="margin-bottom: 5%">
        <a href='checkout.php'>
            <button style="font-weight: bold;border-radius: 50px; background-color: dodgerblue; color: black;"
                    id="login-button">Checkout
            </button>
        </a>
    </div>
</div>
</body>
</html>

</body>
</html>