<html>
<head>
    <title>Profile</title>
</head>
<body>
<div class="profile-box">
    <h2>Profile</h2>
    <table>
        <tr>
            <td>Username:</td>
            <td>
                <?php
                session_start();
                echo $_SESSION['username'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <?php
                echo $_SESSION['password'];
                ?>
            </td>
        </tr>
    </table>
    <br>
    <div class="go-back-button">
        <a href="inventory.php"><button>Go Back</button></a>
    </div>
</div>
</body>
</html>
