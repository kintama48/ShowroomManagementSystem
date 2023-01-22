<?php
// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');
if (mysqli_connect_errno()) {
    echo "Connect failed: %s\n", mysqli_connect_error();
    exit();
}

// Check if the form has been submitted
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year'])) {
    // Retrieve the form data and sanitize it
    $make = mysqli_real_escape_string($db, $_POST['make']);
    $model = mysqli_real_escape_string($db, $_POST['model']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $id = mysqli_real_escape_string($db, $_GET['id']);

    if (empty($make) || empty($model) || empty($year) || empty($id)) {
        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                <h1 style="">Make, Model and Year fields are required</h1>
                <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                  </a>
              </div>';
    } else {
        $query = "UPDATE vehicles SET make='$make', model='$model', year='$year' WHERE id='$id'";
        $result = mysqli_query($db, $query) or die(mysql_error());
        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                        <h1 style="">Vehicle Modified Successfully</h1>
                        <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                            <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                        </a>
                      </div>';
    }
}
?>

<html>
<head>
    <title>Edit Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!--    <link rel="stylesheet" href="../stylesheets/edit_vehicles.css">-->
</head>
<body>
<div class="container">
    <h1>Edit Vehicle</h1>
    <form action="edit_vehicle.php" method="post">
<!--        <input type="hidden" name="vehicle_id" value="--><?php //echo $vehicle['id']; ?><!--">-->
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" value="<?php echo $vehicle['make']; ?>">
        <br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $vehicle['model']; ?>">
        <br>
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" value="<?php echo $vehicle['year']; ?>">
        <br>
        <input type="submit" value="Save Changes">
    </form>
</div>
</body>
</html>

