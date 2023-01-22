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
    header("Location: inventory.php");
    exit();
}
// Close the database connection
mysqli_close($db);
?>

<html lang="en">
<head>
    <title>Delete Part</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h1>Delete Part</h1>
    <form action="delete_part.php" method="post">
        <input type="hidden" name="part_id" value="<?php echo $part['id']; ?>">
        <p>Are you sure you want to delete this part?</p>
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" value="<?php echo $part['make']; ?>" disabled>
        <br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $part['model']; ?>" disabled>
        <br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" value="<?php echo $part['year']; ?>" disabled>
        <br>
        <input type="submit" value="Delete Part">
    </form>
    <br>
    <a href="../admin/inventory.php">Cancel</a>
</div>
</body>
</html>