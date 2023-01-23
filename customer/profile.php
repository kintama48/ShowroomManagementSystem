<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../stylesheets/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 

</head>
<body>
<div class="container">
    <h2>Profile</h2>



    <div class="container">
        
        <h3>Username:</h3>

        <h5>
                        <?php
                        session_start();
                        echo $_SESSION['username'];
                        // echo "USERNAME";
                        ?> 
        </h5>

        <br>
        <br>


        <h3>Password:</h3>

        <h5>
                        <?php
                        // session_start();
                        echo $_SESSION['username'];
                        // echo "PASSWORD";
                        ?> 
        </h5>


    </div>


    <br>
    <div class="go-back-button">
        <a href="customer_homepage.php"><button>Go Back</button></a>
    </div>
</div>
</body>
</html>
