<?php    ob_start();
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        if (isset($_SESSION['success'])) {
        ?>
            <script>
                var msg = "<?= $_SESSION['success'] ?>";
                toastr.success(msg);
            </script>
        <?php
            unset($_SESSION['success']);
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
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <?php
                            include 'connection.php';
                            $sql="select * from users where role=1";
                            $query = mysqli_query($con,$sql);
                            if(mysqli_num_rows($query)==0){
                                $ad=" [Admin]";
                            }
                            else{
                                $ad="";
                            }
                        ?>
                        <h2 class="form-title mb-0">Sign up</h2><h3 class="form-title"><?=$ad?></h3>
                        <form  action="save_data.php" method ="post" enctype="multipart/form-data" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" onfocusout="checkmail(this)" required/>
                                <span id="error_msg" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="phone" id="phone" placeholder="Your Mobile Number" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" onfocusout="passmatch()" placeholder="Repeat your password" required/>
                                <span id="passmatch" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="image"><i class="zmdi zmdi-account zmdi-hc-2x"></i></label>
                                <input type="file" name="img" id="img" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/> Or <a href="index.php">Log In</a>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <h6>Already have an account? <i><a href="index.php">Log In</a></i></h6>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        function passmatch(){
            var pass1 = $('#pass').val();
            var pass2 = $('#re_pass').val();
            if(pass1==pass2){
                $('#signup').removeAttr('disabled');
                $('#passmatch').text('Passwords Matched');
                $('#passmatch').removeClass('text-danger').addClass('text-success');
                $('input[type="password"]').removeClass('is-invalid').addClass('is-valid')
            }
            else{
                $('#signup').attr('disabled','disabled');
                $('#passmatch').text("Passwords don't match");
                $('#passmatch').removeClass('text-success').addClass('text-danger');
                $('input[type="password"]').addClass('is-invalid')
            }
        }
        function checkmail(email) {
            var email = email.value;
            let regex = /^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/;
            let result = regex.test(email);
            if (result)
            {
                $.ajax({
                    type:'post',
                    url:'email_verify.php',
                    data:{email:email},
                    success:function(data){
                        
                        if(data==1){
                            $('#signup').attr('disabled','disabled');
                            $('#error_msg').text('Email already exists');
                            $('#error_msg').removeClass('text-success').addClass('text-danger');
                            $('input[type="email"]').addClass('is-invalid')
                        }
                        else{
                            $('#signup').removeAttr('disabled');
                            $('#error_msg').text('Valid E-Mail');
                            $('#error_msg').removeClass('text-danger').addClass('text-success');
                            $('input[type="email"]').removeClass('is-invalid').addClass('is-valid')
                        }
                    }
                });
            }
            else{
                alert('please enter a valid email');
            }
        }
    </script>
</body>
</html>