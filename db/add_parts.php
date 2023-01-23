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
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    // Retrieve the form data and sanitize it
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = (float) mysqli_real_escape_string($db, $_POST['price']);
    $quantity = (int) mysqli_real_escape_string($db, $_POST['quantity']);


//    jsLogs("${make}, ${model}, ${year}", false);
    // Perform form validation
    if (empty($name) || empty($price) || empty($quantity)) {
        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                <h1 style="">Name, Price and Quantity fields are required</h1>
                <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                  </a>
              </div>';
    } else {
        $query = "SELECT * FROM parts WHERE name = '$name' AND price = '$price' AND quantity = $quantity";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                    <h1 style="">Part already exists</h1>
                    <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                    </a>
                  </div>';
        } else {
            $query = "INSERT INTO parts (name, price, quantity) VALUES ('$name', '$price', $quantity)";
            $result = mysqli_query($db, $query);

            if ($result) {
                echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                        <h1 style="">Part added successfully</h1>
                        <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                            <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                        </a>
                      </div>';
            } else {
                echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
                        <h1 style="">Part could not be added</h1>
                        <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
                            <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;">Go Back</button>
                        </a>
                      </div>';
            }
        }
    }
//    if(empty($result)) {
//        $query2 = "CREATE TABLE parts (name varchar(255) NOT NULL, price varchar(255) NOT NULL, quantity int NOT NULL, id mediumint NOT NULL AUTO_INCREMENT, PRIMARY KEY (id));";
//        $result2 = mysqli_query($db, $query2);
//        $query1 = "INSERT INTO vehicles ($, model, year) VALUES ('$make', '$model', $year)";
//        $result1 = mysqli_query($db, $query1);
//        echo '<div class="container" style="display: flex; justify-content: center;width: 60%; height: 60%; margin: auto; border: 3px solid black;">
//                  <h1>Vehicle Added Successfully</h1>
//                  <a style="position: absolute; top: 120px; left: 610px;" href="http://localhost/ShowroomManagementSystem/admin/inventory.php">
//                        <button style="width: 100px;height: 40px; border-radius: 20px; font-weight: bold;>Go Back</button>
//                  </a>
//              </div>';
//    }
}
?>

<html lang="en">
<head>
    <title>Add Part</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
</html>