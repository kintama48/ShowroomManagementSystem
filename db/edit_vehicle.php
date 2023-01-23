<?php
function jsLogs($data, $isExit) {
    $html = "";
    $coll = '';

    if (is_array($data) || is_object($data)) {
        $coll = json_encode($data);
    } else {
        $coll = $data;
    }

    $html = "<script id='jsLogs'>console.log('PHP: ${coll}');</script>";

    echo($html);

    if ($isExit) exit();
}

// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');
if (mysqli_connect_errno()) {
    echo "Connect failed: %s\n", mysqli_connect_error();
    exit();
}
jsLogs($_POST, false);
// Check if the form has been submitted
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year'])) {
    // Retrieve the form data and sanitize it
    $make = mysqli_real_escape_string($db, $_POST['make']);
    $model = mysqli_real_escape_string($db, $_POST['model']);
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $id = mysqli_real_escape_string($db, $_POST['vehicle_id']);

    if (empty($make) || empty($model) || empty($year) || empty($id)) {
        header("Location: ../admin/invalid_input_edit_vehicles.php");
    } else {
        jsLogs('here2', false);
        $query = "UPDATE vehicles SET make='$make', model='$model', year='$year' WHERE id='$id'";
        $result = mysqli_query($db, $query) or die(mysql_error());
        header("Location: ../admin/success_edit_vehicles.php");

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

    <?php
        $id = $_GET['id'];
        $query = "select * from vehicles where id='$id'";
        $result = mysqli_query($db, $query);
        $vehicles=array();
        while ($vehicle = mysqli_fetch_assoc($result)) {
            $vehicles[] = $vehicle;
        }
    ?>

    <form action="edit_vehicle.php" method="post">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicles[0]['id']; ?>">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" value="<?php echo $vehicles[0]['make']; ?>">
        <br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $vehicles[0]['model']; ?>">
        <br>
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" value="<?php echo $vehicles[0]['year']; ?>">
        <br>
        <input type="submit" value="Save Changes">
    </form>
</div>
</body>
</html>

