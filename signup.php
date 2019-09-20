<?php
date_default_timezone_set('Africa/Lagos');

// start session
session_start();
// if logged in already, redirect
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    $msg = "You are already logged in";
    header("location:welcome.php?message=$msg");
    exit;
}

//this is the basic User sign up
if (isset($_POST["submit"])) {
    if (file_exists('users.json')) {
        $current_data = file_get_contents('users.json');
        $array_data = json_decode($current_data, true);

        // validation
        $fullname = trim($_POST["fullname"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $cpassword = (trim($_POST["Cpassword"]));

        // check that all field are valid
        if (strlen($fullname) < 1 || strlen($username) < 1 ||  strlen($password) < 1 || strlen($cpassword) < 1) {
            $msg = "Fill all required fields";
            header("location:signup.php?message=$msg");
            exit;
        }

        // check if email && username doesn't exist
        $emails = array_column($array_data, "email");
        $usernames = array_column($array_data, "username");
        
        if (in_array($username, $usernames)) {
            $msg = "Username has been choosen";
            header("location:signup.php?message=$msg");
            exit;
        }

        // check if password match
        if ($password != $cpassword) {
            $msg = "Passwords do not match";
            header("location:signup.php?message=$msg");
            exit;
        }

        // then store
        $extra = array(
            'fullname' => $fullname,
            'username' => $username,
            'password' => md5($password),
            'created_at' => date("Y-m-d h:i:s a", time()),
        );
        $array_data[] = $extra;
        $final_data = json_encode($array_data);
        $final_data .= "\n";
        if (file_put_contents('users.json', $final_data)) {
            $msg = "Signup Successful";
            header("location:login.php?message=$msg");
            exit;
        }
    } else {
        $msg = 'Error loading database';
        header("location:signup.php?message=$msg");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team-Alien | Sign Up</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
        <?php if (isset($_GET['message'])): ?>
            <script>alert("<?=$_GET['message']?>");</script>
        <?php endif;?>
    
    <!-- This is the SIGNUP Form -->

    <section class="form-wrapper">
        <div class="container">
            <div class="row">
                <div class=".col-xs col-sm col-md col-lg col-wrapper">
                    <!-- <img src="img/desk.jpg"> -->
                    <section class=".col-xs col-sm-12 col-md-8 col-lg-8 form-section">  
                           
                        <!-- new form -->
                        <form class="form-signup needs-validation" novalidate method="POST" name="form">
                                <h5 class="card-title text-center">Sign Up</h5>
                                <label for="msg" class=".col-xs col-sm-4 col-md-4 col-lg-4 col-form-label msg"></label>
                            <section class="form-section">
                                <div class="form-group row">
                                    <label for="fullName" class=".col-xs col-sm-4 col-md-4 col-lg-4 col-form-label">Full Name:</label>
                                    <div class=".col-xs col-sm-8 col-md-8 col-lg-8">
                                        <input type="text" class="form-control" name = 'fullname' id="fullName" placeholder="Enter your full name" required>
                                       
                                        <div class="valid-feedback"> <!--form validation-->
                                          </div>
                                          <div class="invalid-feedback">
                                          <!--  Enter Full Name Here. -->
                                          </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class=".col-xs col-sm-4 col-md-4 col-lg-4 col-form-label"> Username:</label>
                                    <div class=".col-xs col-sm-8 col-md-8 col-lg-8">
                                        <input type="text" class="form-control" name='username' id="username" placeholder="Enter your username" required>
                                        
                                        <div class="invalid-feedback"> <!--form validation-->
                                           <!-- Please choose a username. -->
                                          </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword" class=".col-xs col-sm-4 col-md-4 col-lg-4 col-form-label">Password</label>
                                    <div class=".col-xs col-sm-8 col-md-8 col-lg-8">
                                    <input type="password" name='password' class="form-control" id="inputPassword" placeholder="Enter your password"  minlength="5" required>
                                    
                                    <div class="valid-feedback"><!--form validation-->
                                      </div>
                                      <div class="invalid-feedback">
                                      <!--  Please choose a password. -->
                                      </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirmPassword" class=".col-xs col-sm-4 col-md-4 col-lg-4 col-form-label">Confirm Password</label>
                                    <div class=".col-xs col-sm-8 col-md-8 col-lg-8">
                                        <input type="password" name="Cpassword" class="form-control" id="confirmPassword" placeholder="Confirm your password"  minlength="5" required>
                                        
                                        <div class="invalid-feedback"> <!--form validation-->
                                          <!--  You must confirm password. -->
                                          </div>
                                    </div>
                                </div>
                                

                                <div class="form-checkbox .col-xs col-sm col-md">
                                    <div class="form-group form-checkbox-inner">
                                        <div class="form-check col-sm-12 col-md-12 col-form-label">
                                            <input class="form-check-input was-validated" type="checkbox" id="gridCheck" required>
                                            <label class="form-check-label" for="gridCheck">
                                                By clicking "sign up", you agree to our terms and conditions of use
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="sign-up-btn btn btn-lg btn-primary btn-block" type="submit" name="submit">
                                    Sign up
                                </button>

                                <hr class="my-4">
                                <p>Have an account? <a href="login.php" class="link-to-login">Login</a></p>
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
    <!-- <script src="signup.js"></script> -->
    <script>
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
        </script>

</body>
</html>