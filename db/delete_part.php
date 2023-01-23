<?php

$db = mysqli_connect('localhost', 'mysql', '', 'test');
// Check if the form has been submitted
if (isset($_POST['part_id'])) {
// Retrieve the form data
    $part_id = $_POST['part_id'];
    // Delete the part from the database
    $query = "DELETE FROM parts WHERE id='$part_id'";
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
    <title>Delete part</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../stylesheets/edit_vehicles.css">

</head>
<body>
<div class="container">
    <h1>Delete part</h1>
    <?php
    $id = $_GET['id'];
    $db = mysqli_connect('localhost', 'mysql', '', 'test');
    $query = "select * from parts where id='$id'";
    $result = mysqli_query($db, $query);
    $parts=array();
    while ($part = mysqli_fetch_assoc($result)) {
        $parts[] = $part;
    }
    ?>
    <form action="delete_part.php" method="post">
        <input type="hidden" name="part_id" value="<?php echo $parts[0]['id']; ?>">
        <p>Are you sure you want to delete this part?</p>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $parts[0]['name']; ?>" disabled>
        <br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $parts[0]['price']; ?>" disabled>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $parts[0]['quantity']; ?>" disabled>
        <br>
        <input type="submit" value="Delete part">
    </form>
    <br>
    <a href="../admin/inventory.php">Cancel</a>
</div>
</body>
</html>