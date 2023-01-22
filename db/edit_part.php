<?php
// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');
if (mysqli_connect_errno()) {
    echo "Connect failed: %s\n", mysqli_connect_error();
    exit();
}

// Check if the form has been submitted
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    // Retrieve the form data and sanitize it
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $id = mysqli_real_escape_string($db, $_GET['id']);

    if (empty($name) || empty($price) || empty($quantity) || empty($id)) {
        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                <h1 style="">Name, Price and Quantity fields are required</h1>
                <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                </a>
                </div>';
    } else {
        $query = "UPDATE parts SET name='$name', price='$price', quantity='$quantity' WHERE id='$id'";
        $result = mysqli_query($db, $query) or die(mysql_error());
        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
            <h1 style="">Part Modified Successfully</h1>
            <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
            <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
            </a>
            </div>';
    }
}
?>

<html>
    <head>
        <title>Edit Part</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!--    <link rel="stylesheet" href="../stylesheets/edit_vehicles.css">-->
    </head>
    <body>
        <div class="container">
            <h1>Edit Part</h1>
            <form action="edit_part.php" method="post">
                <input type="hidden" name="part_id" value="<?php echo $part['id']; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $part['name']; ?>">
                <br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?php echo $part['price']; ?>">
                <br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $part['quantity']; ?>">
                <br><br>
                <input type="submit" value="Save Changes">
            </form>
        </div>
    </body>
</html>
