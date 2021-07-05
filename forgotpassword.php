<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>
    <?php 
        include 'dbcon.php';
        if(isset($_POST['submit'])){
            $email=mysqli_real_escape_string($con, $_POST['email']);
            $email_query="Select * from users where email='$email'";
            $email_query_result=mysqli_query($con,$email_query);

            if(mysqli_num_rows($email_query_result)){
                // Get username
                $userdata=mysqli_fetch_array($email_query_result);
                $username=$userdata['name'];

                // Get Token
                $token=$userdata['token'];

                // Email data

                $subject="Password Reset";
                $body="Hi, $username. Click here to reset your password http://localhost/Login System/reset_password.php?token=$token";
                $sender="From: testmailrahul0@gmail.com";

                if(mail($email,$subject,$body,$sender)){
                    $_SESSION['msg']='Check your email to reset your password';
                    header('location:index.php');
                }
            }
            else{
                ?>
                <script>
                    alert('Sorry, you are not registered with us');
                </script>
                <?php
            }

        }
    ?>
    <div class='container'>
        <div class="main">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method='POST'>
                <div class="card">
                    <h1>Forgot Password</h1>
                    <h3>Enter Email</h3>
                    <input type="mail" name='email' />
                    <br/>
                    <button class='submit'type="submit" name='submit'>Send Mail</button>
                </div>
            </form>
            <div class="account">
                Already have account?
                <a class='link' href='/Login System/login.php'>Login</a>
            </div>
            <div class="account">
                Need an Account?
                <a class='link' href='/Login System/signup.php'>Sign Up</a>
            </div>

        </div>
    </div>
</body>

</html>