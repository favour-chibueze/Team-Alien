<?php
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team-Alien | Welcome</title>

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- font awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    </head>

    <body>
        <?php if (isset($_GET['message'])): ?>
        <script>alert("<?=$_GET['message']?>");</script>
    <?php endif;?>
        <div class="container-fluid" id="wrapper">
                <div class="text-box animated slideInDown 2s slow">
                    <h1>
                        Welcome,
                        <span class="username">
                            <?= isset($_SESSION['fullname'])? $_SESSION['fullname'] : "Alien"?>
                        </span>
                    </h1>
                </div>
                
                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true): ?>
                <a href = 'logout.php' ><button name = 'logout' class="btn btn-outline-secondary btn-md buttonOption">Logout</button></a>
                <?php else:?>
                <a href = 'login.php' ><button name = 'logout' class="btn btn-outline-secondary btn-md buttonOption">Login</button></a>
                <?php endif;?>
        </div>
    </body>


</html>
