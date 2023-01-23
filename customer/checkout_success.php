<?php
session_start();
$conn = mysqli_connect('localhost', 'mysql', '', 'test');
if (mysqli_connect_errno()) {
    echo "Connect failed: %s\n", mysqli_connect_error();
    exit();
}

//iterating through cart items and updating their quantity
foreach($_SESSION['cart'] as $item){
    if (gettype($item) == 'double') {
        continue;
    }
    if ($item['type'] == 'vehicle'){
        //updating the quantity of vehicle
        $update_query = "UPDATE vehicles SET quantity = quantity - {$item['quantity']} WHERE id = {$item['id']}";
        mysqli_query($conn, $update_query);
    }else{
        //updating the quantity of part
        $update_query = "UPDATE parts SET quantity = quantity - {$item['quantity']} WHERE id = {$item['id']}";
        mysqli_query($conn, $update_query);
    }
}
//clearing cart
unset($_SESSION['cart']);
header('Location: ../customer/customer_homepage.php');
?>
