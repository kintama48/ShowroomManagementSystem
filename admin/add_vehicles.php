    <!-- add_vehicle.php -->
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
    
    // Perform form validation
    if (empty($make) || empty($model) || empty($year)) {
        echo "Make, Model and Year fields are required";
    } else {
        echo "Here";
        // Add the vehicle to the database
        $query = "INSERT INTO vehicles (make, model, myear) VALUES ($make, $model, $year)";
        echo "Here 0.5";
        $result = mysqli_query($db, $query);
        echo "Here 1";
    }
    if(empty($result)) {
        echo "Here 2";
        $query = "CREATE TABLE vehicles (make varchar(255) NOT NULL, model varchar(255) NOT NULL, myear YEAR NOT NULL,)";
        $result = mysqli_query($db, $query);
        echo "Here 3";
        header("Location: http://localhost/ShowroomManagementSystem/admin/inventory.php");
    }
}
?>
