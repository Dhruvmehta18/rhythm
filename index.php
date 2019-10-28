<!DOCTYPE html>
<html lang="en">
<?php
    require 'connection.php';
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="login.css"/>
    <script src="js/checker.js"></script>
    
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['login'])){
        require 'login.php';
    }
    elseif(isset($_POST['register'])) 
    {
        require 'register.php';
    }
}
?>
<body>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Have an account ?</h2>
            <p>All your music. Everywhere for free.</p><br>
            <label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Don't have an account ?</h2>
            <p>All your music. Everywhere for free.</p><br>
            <label id="label-login" for="log-login-show">Register</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>
        <div class="white-panel">
            <div class="login-show">
                <form action="index.php" method="POST">
                    <h2>LOGIN</h2>
                    <input type="text" placeholder="E-mail" name="email">
                    <input type="password" placeholder="Password" name="pwd">
                    <input type="submit" value="Log in" name="login">
                </form>
            </div>
            <div class="register-show">
                <form action="index.php" onsubmit="return validateReg(this)" method="POST">
                    <h2>REGISTER</h2>
                    <input type="text" placeholder="First Name" name="fname" onkeypress="return isAlphabet(event)">
                    <input type="text" placeholder="Last Name" name="lname" onkeypress="return isAlphabet(event)">
                    <input type="text" placeholder="E-mail" name="email">
                    <input type="password" placeholder="Password" name="pwd">
                    <input type="submit" value="Register" name="register">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');
        });


        $('.login-reg-panel input[type="radio"]').on('change', function () {
            if ($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut();
                $('.login-info-box').fadeIn();

                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');

            }
            else if ($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();

                $('.white-panel').removeClass('right-log');

                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
</body>

</html>