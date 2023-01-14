<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
}

// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');

// Retrieve the customer information from the database
$customer_id = $_SESSION['customer_id'];
$query = "SELECT * FROM customers WHERE id = $customer_id";
$result = mysqli_query($db, $query);
$customer = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // Retrieve the form data and sanitize it
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Perform form validation
    if (empty($first_name) || empty($last_name) || empty($email)) {
        echo "First Name, Last Name and Email fields are required";
    } else {
        // Update the customer information in the database
        if (!empty($password)) {
            $password = md5($password);
            $query = "UPDATE customers SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password' WHERE id = $customer_id";
        } else {
            $query = "UPDATE customers SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = $customer_id";
        }
        mysqli_query($db, $query);

        // Redirect the user back to the profile page
        header("Location: profile.php");
    }
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Profile</title>
</head>
<body>
<h1>Customer Profile</h1>
<form action="profile.php" method="post">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $customer['first_name']; ?>">
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $customer['last_name']; ?>">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php
    echo $customer['email']; ?>">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    <br>
    <input type="submit" value="Save Changes">
</form>

</body>
</html>
<?php
// Connect to the database
$db = mysqli_connect('localhost', 'mysql', '', 'test');

// Check if the form has been submitted
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Retrieve the form data and sanitize it
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password_confirmation = mysqli_real_escape_string($db, $_POST['password_confirmation']);
    $customer_id = $_SESSION['customer_id'];

    // Perform form validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($password_confirmation)) {
        echo "All fields are required";
    } elseif ($password != $password_confirmation) {
        echo "Passwords do not match";
    } else {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Update the customer information in the database
        $query = "UPDATE customers SET first_name='$first_name', last_name='$last_name', email='$email', password='$password' WHERE id='$customer_id'";
        mysqli_query($db, $query);

        // Redirect the user back to the customer page
        header("Location: customer.php");
    }
}

// Close the database connection
mysqli_close($db);
?>