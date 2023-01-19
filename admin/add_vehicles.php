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
        // Add the vehicle to the database
        $query1 = "INSERT INTO vehicles (make, model, myear) VALUES ($make, $model, $year)";
        $result1 = mysqli_query($db, $query) or die(mysql_error());
    }
    if(empty($result)) {
        $query2 = "CREATE TABLE vehicles (make varchar(255) NOT NULL, model varchar(255) NOT NULL, myear YEAR NOT NULL,)";
        $result2 = mysqli_query($db, $query2) or die(mysql_error());
        $result3 = mysqli_query($db, $query1) or die(mysql_error());
        header("Location: http://localhost/ShowroomManagementSystem/admin/inventory.php");
    }
}
?>
