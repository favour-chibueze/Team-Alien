<?php
// start session
session_start();

// if logged in already, redirect
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $msg = "You are already logged in";
    header("location:welcome.php?message=$msg");
}

// if remeber was set before, login directly
if (isset($_COOKIE["heistuser"])) {
    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents("users.json"));
        $usernames = array_column($users, "username");
        if (in_array($_COOKIE["heistuser"], $usernames)) {
            $user = $users[array_search($_COOKIE["heistuser"], $usernames)];
            // store all vars in session
            $_SESSION['loggedin'] = true;
            $_SESSION['fullname'] = $user->fullname;
            $_SESSION['username'] = $user->username;
            $msg = "Logged in successfully";
            header("location:welcome.php?message=$msg");
        } else {
            $msg = "User does not exist";
            header("location:login.php?message=$msg");
        }
    } else {
        $msg = "Database not present";
        header("location:login.php?message=$msg");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // validation
    // check if username is not empty and password is not empty
    if (isset($_POST["username"]) and isset($_POST['password'])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        // Check that both field are not empty
        if (strlen($username) < 1 || strlen($password) < 1) {
            $msg = "Fill all required fields";
            header("location:login.php?message=$msg");
        }
        // check that the username exist
        if (file_exists('users.json')) {
            $users = json_decode(file_get_contents("users.json"));
            $usernames = array_column($users, "username");
            if (in_array($username, $usernames)) {
                $user = $users[array_search($username, $usernames)];

                if (md5($password) == $user->password) {
                    // if remember me isset
                    if (isset($_POST["remember"])) {
                        setcookie("heistuser", $_POST["username"], time() + (30 * 24 * 60 * 60));
                    } else {
                        if (isset($_COOKIE["heistuser"])) {
                            setcookie("heistuser", "");
                        }
                    }

                    // store all vars in session
                    $_SESSION['loggedin'] = true;
                    $_SESSION['fullname'] = $user->fullname;
                    $_SESSION['username'] = $user->username;
                    $msg = "Logged in successfully";
                    header("location:welcome.php?message=$msg");
                } else {
                    $msg = "Incorrect Password";
                    header("location:login.php?message=$msg");
                }
            } else {
                $msg = "User does not exist";
                header("location:login.php?message=$msg");
            }
        } else {
            $msg = "Error loading database";
            header("location:login.php?message=$msg");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team-Alien | Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <?php if (isset($_GET['message'])): ?>
      <script>alert("<?= $_GET['message'] ?>");</script>
    <?php endif;?>
    
   <!-- This is the LOGIN Form -->

   <section class="form-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm col-md col-lg col-wrapper">
                <!-- <img src="img/desk.jpg"> -->
                <section class=" col-sm-12 col-md-8 col-lg-8 form-section">
                    <header class="header-content">
                        <h1>Login</h1>
                    </header>

                    <!--  form -->
                    <form class="form-signin needs-validation" novalidate method="POST">
                        <section class="form-section">

                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-md-4 col-lg-4 col-form-label"> Username:</label>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
                                    
                                    <div class="invalid-feedback"> <!--form validation-->
                                        <!-- Please choose a username. -->
                                       </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-md-4 col-lg-4 col-form-label">Password</label>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                <input type="password" class="form-control"  name="password" id="inputPassword" placeholder="Enter your password" minlength="5" required>
                                
                                <div class="invalid-feedback">
                                    <!--  Please enter your password. -->
                                    </div>
                            </div>
                            </div>

                            
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember password</label>
                              </div>
                              <button class="sign-in-btn btn btn-lg btn-primary btn-block text-uppercase col-sm-12 col-md-4" name="submit" type="submit">
                                Sign in
                            </button>
                              <hr class="my-4">
                              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit" ><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
                            <hr class="my-4">
                            <p>Create an account <a href="signup.php" class="link-to-signup">SignUp</a></p>
                        </section> <!--form section-->
                    </form> <!--form-->
                </section>
            </div> <!--col-wrapper-->
        </div>
    </div>
</section>

<!-- Bootstrap Javascript -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script> -->


</body>
</html>