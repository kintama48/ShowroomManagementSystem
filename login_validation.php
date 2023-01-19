<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username == 'admin'){
        if ($password == 'admin'){
            header("Location: http://localhost/ShowroomManagementSystem/admin/inventory.php");
        }
    }
    if ($username == 'customer'){
        if ($password == 'abcd'){
            echo "2";
            header("Location: http://localhost/ShowroomManagementSystem/customer/customer_homepage.php");
        }
    }
?>  