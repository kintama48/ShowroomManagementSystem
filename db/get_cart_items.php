<?php
$temp = session_start();
if (!$temp) {
    jsLogs("Session start failed", false);
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


//// Check if the cart session variable exists, if not create an empty cart array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['cart']['total'])) {
    $_SESSION['cart']['total'] = 0;
}

jsLogs($_SESSION['cart'], false);

// Function to retrieve the cart items from the session variable
$total = 0;

// Iterate through the cart items and calculate the total cost
foreach ($_SESSION['cart'] as $item) {
    jsLogs($item, false);
    if (gettype($item) == 'double') {
        continue;
    }
    $total += (float) $item['price'] * (int) $item['quantity'];
}

// Add the total to the cart array
$_SESSION['cart']['total'] = $total;

jsLogs($_SESSION['cart'], false);

$cart = $_SESSION['cart'];
?>