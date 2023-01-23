<!-- add_vehicle.php -->

<?php
// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');
if (mysqli_connect_errno()) {
  echo "Connect failed: %s\n", mysqli_connect_error();
  exit();
}

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

// Check if the form has been submitted
if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    // Retrieve the form data and sanitize it
        $make = mysqli_real_escape_string($db, $_POST['make']);
        $model = mysqli_real_escape_string($db, $_POST['model']);
        $year = (int) mysqli_real_escape_string($db, $_POST['year']);
        $price = (float) mysqli_real_escape_string($db, $_POST['price']);
        $quantity = (int) mysqli_real_escape_string($db, $_POST['quantity']);

//    jsLogs("${make}, ${model}, ${year}", false);
    // Perform form validation
    if (empty($make) || empty($model) || empty($year) || empty($price) || empty($quantity)) {
        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin-top: 20px; border: 3px solid black;">
                <h1 style="">Empty Fields Not Allowed</h1>
                <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                  </a>
              </div>';
    } else {
        $query = "SELECT * FROM vehicles WHERE make = '$make' AND model = '$model' AND year = $year";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                    <h1 style="">Vehicle already exists</h1>
                    <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                    </a>
                  </div>';
        } else {
            $query = "INSERT INTO vehicles (make, model, year, price, quantity) 
                    VALUES ('$make', '$model', $year, $price, $quantity)";
            $result = mysqli_query($db, $query);

            if ($result) {
                echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                        <h1 style="">Vehicle added successfully</h1>
                        <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                            <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                        </a>
                      </div>';
            } else {
                echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                        <h1 style="">Vehicle could not be added</h1>
                        <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                            <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                        </a>
                      </div>';
            }
        }
    }
}
?>

<html lang="en">
    <head>
        <title>Add Vehicle</title>
        <link rel="stylesheet" href="../stylesheets/edit_vehicles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </head>
</html>