<?php

   ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        
        if (isset($_SESSION['login'])) {
        ?>
            <script>
                toastr.success("Successfully Logged Out");
            </script>
        <?php
         session_destroy();
        }

        if (isset($_SESSION['error'])) {
        ?>
            <script>
                var msg = "<?= $_SESSION['error'] ?>";
                toastr.error(msg);
            </script>
        <?php
            unset($_SESSION['error']);
        }

    ?>

    <div class="main">
        <!-- Login  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <h6>Don't have an account?<br><i><a href="regform.php">Create One.</a></i></h6>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form action="login_data.php" method ="post" enctype="multipart/form-data" class="register-form" id="login-form">
                        <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" onfocusout="checkloginmail(this)" required/>
                                <span id="error_msg" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="your_pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/> Or <a href="regform.php">Sign Up</a>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function checkloginmail(email) {
            var email = email.value;
            let regex = /^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/;
            let result = regex.test(email);
            if (result)
            {
                $.ajax({
                    type:'post',
                    url:'loginemail_verify.php',
                    data:{email:email},
                    success:function(data){
                        
                        if(data==1){
                            $('#signin').removeAttr('disabled');
                            $('#error_msg').text('E-Mail Found');
                            $('#error_msg').removeClass('text-danger').addClass('text-success');
                            $('input[type="email"]').removeClass('is-invalid').addClass('is-valid')
                        }
                        else{
                            $('#signin').attr('disabled','disabled');
                            $('#error_msg').text('Email not found');
                            $('#error_msg').removeClass('text-success').addClass('text-danger');
                            $('input[type="email"]').addClass('is-invalid')
                        }
                    }
                });
            }
            // else{
            //     alert('please enter a valid email');
            // }
        }
    </script>
</body>
</html>