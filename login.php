<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-7 col-md-7 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
             <!-- <img src="img/desk.jpg"> -->
            <h5 class="card-title text-center">Login</h5>
            <form class="form-signin mx-auto" method="POST"  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
             <?php include('errors.php');
                if(isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
            }
            ?>
              <div class="form-label-group">
                <input type="text" id="inputUsername" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Username" required autofocus>
                <label for="inputUsername">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember Me</label>      
                <div class="forgot_password">
                  <a href="#"><label for="forgot_passowrd">Forgot Password?</label></a>
                </div>          
              </div>
             
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login" value="login">Login</button>
              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit" href="www.facebook.com"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
              <p class="account">Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

