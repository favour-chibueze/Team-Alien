<?php include('server.php');
// header("location:signup.php");

if (isset($_SESSION['USERNAME'])){
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
    <?php if (isset($_SESSION['success']))?>
<div class="error success">
    <h3>
        <?php
    // echo $_SESSION['success'];
    unset($_SESSION['success']);?>
    </h3>
</div>       
    <?php if(isset($_SESSION['username'])): ?>
    	<p>Welcome <strong> <?php  echo $_SESSION['username']; ?> </strong> </p> 
    	
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
<?php endif ?>    	
   
</div>
<!-- <a href="login.php"><input type="submit"/></a> -->

        <div class="welcome-text text-center">
           <h1>Welcome to Team Alien's Page</h1>
           <h4>Please click the get Started button to sign up or login button if you already have an account</h4>
           <a href="signup.php"><button class="sign-in-btn btn btn-md btn-primary " name="signup">Get Started</button></a>
           <a href="login.php"><button class="log-in-btn btn btn-md btn-primary" name="login" >Login</button></a>
       </div>
		
</body>
</html>