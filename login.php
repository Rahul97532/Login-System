<?php
    session_start();
?>
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
            $email=$_POST['email'];
            $pass=$_POST['pass'];

            $email_verify="Select * from users where email='$email'";
            $email_verify_result=mysqli_query($con,$email_verify);

             // Get username of the associated to given email email
            //  $_SESSION['username']=mysqli_fetch_assoc($email_verify_result)['username'];

            if(mysqli_num_rows($email_verify_result)){

            // Get password of the associated to given email email
                $hashed_password=mysqli_fetch_assoc($email_verify_result)['password'];
                // echo "Error ".password_verify($pass,$hashed_password);
                if(password_verify($pass,$hashed_password)){
                   
                    echo "Login Successful";
                    // echo mysqli_fetch_assoc($email_verify_result)['name'];
                    $_SESSION['active']=true;
                    ?>
                    <script>
                        location.replace('home.php');
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert("Password is incorrect");
                    </script>
                    <?php
                }
            }
            else{
                ?>
                    <script>
                        alert("You are not a registered user.");
                    </script>
                    <?php
            }

        }
    ?>
    <div class='container'>
        <div class="main">
            <form  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method='POST'>
                <div class="card">
                    <h1>Log In</h1>

                    <h3>Enter Email</h3>
                    <input type="mail" name='email' />
                    <h3>Enter Password</h3>
                    <input type="password" name="pass" />
                    <div class="forgot_password">
                        <p>
                            <a href="forgotpassword.php">Forgot Password</a>
                        </p>
                    </div>
                    <br/>
                    <button type="submit" class='submit' name='submit'>Log In</button>
                </div>
            </form>
            <div class="account">
                Need an Account?
                <a class='link' href='/Login System/signup.php'>Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>