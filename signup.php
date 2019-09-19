<?php include('server.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    
<!-- This is the SIGNUP Form -->

  <div class="container">
    <div class="row">
      <div class="col-sm-7 col-md-7 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
             <!-- <img src="img/desk.jpg"> -->
            <h5 class="card-title text-center">Sign Up</h5>
            <form class="form-signin mx-auto" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            
             <?php include('errors.php'); ?>
             
              <div class="form-label-group">
                <input type="text" id="inputFullname" class="form-control" name="name" placeholder="Fullname" value="<?php echo $name; ?>" required autofocus>
                <label for="inputFullname">Full Name</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputUsername" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                <label for="inputUsername">Email</label> 
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                <label for="inputPassword">Password</label>
              </div>
 
              <div class="custom-control custom-checkbox mb-3">
                <!-- <input type="checkbox" class="custom-control-input" id="customCheck1"> -->
                <label >By clicking "sign up", you agree to our terms and conditions of use</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit" value="submit">Sign up</button>
              <hr class="my-4">
              <p>Have an account? <a href="login.php">Login</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>