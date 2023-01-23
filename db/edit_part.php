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
    $id = mysqli_real_escape_string($db, $_POST['part_id']);

    if (empty($name) || empty($price) || empty($quantity)) {
        header("Location: ../admin/invalid_input_edit_parts.php");
    } else {
        $query = "UPDATE parts SET name='$name', price='$price', quantity='$quantity' WHERE id='$id'";
        $result = mysqli_query($db, $query) or die(mysql_error());
        header("Location: ../admin/success_edit_parts.php");
    }
}
?>

<html>
    <head>
        <title>Edit Part</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="../stylesheets/edit_vehicles.css">
    </head>
    <body>
        <div class="container">
            <h1>Edit Part</h1>
            <?php
            $id = $_GET['id'];
            $query = "select * from parts where id='$id'";
            $result = mysqli_query($db, $query);
            $parts=array();
            while ($part = mysqli_fetch_assoc($result)) {
                $parts[] = $part;
            }
            ?>
            <form action="edit_part.php" method="post">
                <input type="hidden" name="part_id" value="<?php echo $parts[0]['id']; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $parts[0]['name']; ?>">
                <br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?php echo $parts[0]['price']; ?>">
                <br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $parts[0]['quantity']; ?>">
                <br><br>
                <input type="submit" value="Save Changes">
            </form>
        </div>
    </body>
</html>
