<?php
session_start();
$conn = mysqli_connect('localhost', 'mysql', '', 'test');
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

jsLogs($_SESSION['cart'], false);


//iterating through cart items and updating their quantity
foreach($_SESSION['cart'] as $item){
    if (gettype($item) == 'double') {
        continue;
    }
    if ($item['type'] == 'vehicle'){
        jsLogs($item['quantity'], false);
        //updating the quantity of vehicle
        $update_query = "UPDATE vehicles SET quantity = quantity - {$item['quantity']} WHERE id = {$item['id']}";
        mysqli_query($conn, $update_query);
    }else if ($item['type'] == 'part') {
        jsLogs($item['quantity'], false);
        //updating the quantity of part
        $update_query = "UPDATE parts SET quantity = quantity - {$item['quantity']} WHERE id = {$item['id']}";
        mysqli_query($conn, $update_query);
    }
}
jsLogs("here after for", false);
//clearing cart
jsLogs($_SESSION['cart'], false);
unset($_SESSION['cart']);
header('Location: ../customer/customer_homepage.php');
?>
